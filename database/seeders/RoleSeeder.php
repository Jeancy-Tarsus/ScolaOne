<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ==========================================
        // RÉCUPÉRATION DES PERMISSIONS
        // ==========================================

        $permissions = Permission::where('guard_name', 'web')
            ->get();


        // ==========================================
        // SUPER ADMIN
        // ==========================================

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        // Le Super Admin possède toutes les permissions
        $superAdmin->syncPermissions($permissions);


        // ==========================================
        // ADMIN D'ÉCOLE
        // ==========================================

        $adminEcole = Role::firstOrCreate([
            'name' => "Admin d'école",
            'guard_name' => 'web',
        ]);


        // Permissions autorisées pour l'Admin d'école
        $permissionsAdminEcole = [

            // Utilisateurs
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Rôles
            'roles.view',
            'roles.create',
            'roles.edit',

            // Permissions
            'permissions.view',

            // Sites
            'sites.view',
            'sites.create',
            'sites.edit',
            'sites.delete',

            // Années scolaires
            'annees_scolaires.view',
            'annees_scolaires.create',
            'annees_scolaires.edit',
            'annees_scolaires.delete',

            // Périodes scolaires
            'periodes_scolaires.view',
            'periodes_scolaires.create',
            'periodes_scolaires.edit',
            'periodes_scolaires.delete',

            // Cycles
            'cycles.view',
            'cycles.create',
            'cycles.edit',
            'cycles.delete',

            // Niveaux
            'niveaux.view',
            'niveaux.create',
            'niveaux.edit',
            'niveaux.delete',

            // Groupes
            'groupes.view',
            'groupes.create',
            'groupes.edit',
            'groupes.delete',

            // Salles
            'salles.view',
            'salles.create',
            'salles.edit',
            'salles.delete',

            // Classes
            'classes.view',
            'classes.create',
            'classes.edit',
            'classes.delete',
        ];


        $adminEcole->syncPermissions(
            Permission::whereIn('name', $permissionsAdminEcole)
                ->where('guard_name', 'web')
                ->get()
        );


        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
