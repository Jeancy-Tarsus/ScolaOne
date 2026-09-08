<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Réinitialiser le cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // ==========================================
            // UTILISATEURS
            // ==========================================

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',


            // ==========================================
            // RÔLES
            // ==========================================

            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',


            // ==========================================
            // PERMISSIONS
            // ==========================================

            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',


            // ==========================================
            // ORGANISATIONS
            // ==========================================

            'organisations.view',
            'organisations.create',
            'organisations.edit',
            'organisations.delete',


            // ==========================================
            // SITES
            // ==========================================

            'sites.view',
            'sites.create',
            'sites.edit',
            'sites.delete',


            // ==========================================
            // ANNÉES SCOLAIRES
            // ==========================================

            'annees_scolaires.view',
            'annees_scolaires.create',
            'annees_scolaires.edit',
            'annees_scolaires.delete',


            // ==========================================
            // PÉRIODES SCOLAIRES
            // ==========================================

            'periodes_scolaires.view',
            'periodes_scolaires.create',
            'periodes_scolaires.edit',
            'periodes_scolaires.delete',


            // ==========================================
            // CYCLES
            // ==========================================

            'cycles.view',
            'cycles.create',
            'cycles.edit',
            'cycles.delete',


            // ==========================================
            // NIVEAUX
            // ==========================================

            'niveaux.view',
            'niveaux.create',
            'niveaux.edit',
            'niveaux.delete',


            // ==========================================
            // GROUPES
            // ==========================================

            'groupes.view',
            'groupes.create',
            'groupes.edit',
            'groupes.delete',


            // ==========================================
            // SALLES
            // ==========================================

            'salles.view',
            'salles.create',
            'salles.edit',
            'salles.delete',


            // ==========================================
            // CLASSES
            // ==========================================

            'classes.view',
            'classes.create',
            'classes.edit',
            'classes.delete',
        ];


        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);

        }


        // Réinitialiser le cache après création
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
