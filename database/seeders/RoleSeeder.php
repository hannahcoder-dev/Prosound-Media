<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $superAdmin = Role::create(['name' => 'Super Admin', 'slug' => 'super_admin', 'description' => 'Full system access']);
        $admin = Role::create(['name' => 'Admin', 'slug' => 'admin', 'description' => 'Manage all content and users']);
        $staff = Role::create(['name' => 'Staff', 'slug' => 'staff', 'description' => 'Handle bookings and projects']);
        $client = Role::create(['name' => 'Client', 'slug' => 'client', 'description' => 'Book services and manage projects']);

        // Permission Groups
        $groups = [
            'users' => ['view', 'create', 'edit', 'delete', 'assign-roles'],
            'bookings' => ['view', 'create', 'edit', 'delete', 'change-status'],
            'services' => ['view', 'create', 'edit', 'delete'],
            'portfolio' => ['view', 'create', 'edit', 'delete'],
            'blog' => ['view', 'create', 'edit', 'delete'],
            'payments' => ['view', 'create', 'verify'],
            'invoices' => ['view', 'create', 'edit', 'download'],
            'messages' => ['view', 'reply', 'delete'],
            'testimonials' => ['view', 'create', 'edit', 'delete'],
            'settings' => ['view', 'edit'],
            'activity-logs' => ['view'],
        ];

        $allPermissions = [];
        foreach ($groups as $group => $actions) {
            foreach ($actions as $action) {
                $slug = "{$group}.{$action}";
                $permission = Permission::create([
                    'name' => ucfirst($action) . ' ' . ucfirst(str_replace('-', ' ', $group)),
                    'slug' => $slug,
                    'group' => $group,
                ]);
                $allPermissions[$slug] = $permission;
            }
        }

        // Assign all permissions to Super Admin
        $superAdmin->permissions()->attach(array_column(array_values($allPermissions), 'id'));

        // Admin gets everything except system settings
        $adminPerms = collect($allPermissions)->filter(fn($p) => !str_starts_with($p->slug, 'settings.') && $p->slug !== 'activity-logs.view');
        $admin->permissions()->attach($adminPerms->pluck('id'));

        // Staff gets limited permissions
        $staffPerms = collect($allPermissions)->filter(fn($p) =>
            in_array($p->slug, [
                'bookings.view', 'bookings.edit', 'bookings.change-status',
                'services.view', 'portfolio.view', 'blog.view', 'blog.create', 'blog.edit',
                'messages.view', 'messages.reply',
            ])
        );
        $staff->permissions()->attach($staffPerms->pluck('id'));

        // Client gets minimal permissions
        $clientPerms = collect($allPermissions)->filter(fn($p) =>
            in_array($p->slug, ['bookings.view', 'bookings.create', 'payments.view', 'invoices.view', 'invoices.download'])
        );
        $client->permissions()->attach($clientPerms->pluck('id'));
    }
}
