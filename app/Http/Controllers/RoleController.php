<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Liste des rôles et des permissions disponibles.
     */
    public function index(Request $request)
    {
        $query = Role::with('permissions');

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('name', 'like', "%{$search}%");
        }

        $roles = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Toutes les permissions disponibles
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('roles.index', compact(
            'roles',
            'permissions'
        ));
    }

    /**
     * Le formulaire de création est dans une modale.
     */
    public function create()
    {
        return redirect()->route('roles.index');
    }

    /**
     * Création d'un rôle avec ses permissions.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name',
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ], [
            'name.required' => 'Le nom du rôle est obligatoire.',
            'name.string' => 'Le nom du rôle doit être une chaîne de caractères.',
            'name.max' => 'Le nom du rôle ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Ce rôle existe déjà.',

            'permissions.array' => 'Les permissions sélectionnées sont invalides.',
            'permissions.*.integer' => 'Une permission sélectionnée est invalide.',
            'permissions.*.exists' => 'Une permission sélectionnée n’existe pas.',
        ]);

        try {

            // Création du rôle
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            // Attribution des permissions
            if (!empty($validated['permissions'])) {

                $permissions = Permission::whereIn(
                    'id',
                    $validated['permissions']
                )
                    ->where('guard_name', 'web')
                    ->get();

                $role->syncPermissions($permissions);
            }

            return redirect()
                ->route('roles.index')
                ->with('success', 'Le rôle a été créé avec succès.');

        } catch (\Exception $e) {

            return redirect()
                ->route('roles.index')
                ->with('error', 'Une erreur est survenue lors de la création du rôle.');
        }
    }

    /**
     * Affichage d'un rôle.
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('roles.index', compact(
            'role',
            'permissions'
        ));
    }

    /**
     * Le formulaire de modification est dans une modale.
     */
    public function edit(Role $role)
    {
        return redirect()->route('roles.index');
    }

    /**
     * Modification d'un rôle et de ses permissions.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ], [
            'name.required' => 'Le nom du rôle est obligatoire.',
            'name.string' => 'Le nom du rôle doit être une chaîne de caractères.',
            'name.max' => 'Le nom du rôle ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Ce rôle existe déjà.',

            'permissions.array' => 'Les permissions sélectionnées sont invalides.',
            'permissions.*.integer' => 'Une permission sélectionnée est invalide.',
            'permissions.*.exists' => 'Une permission sélectionnée n’existe pas.',
        ]);

        try {

            // Modification du nom
            $role->update([
                'name' => $validated['name'],
            ]);

            // Synchronisation des permissions
            $permissions = Permission::whereIn(
                'id',
                $validated['permissions'] ?? []
            )
                ->where('guard_name', 'web')
                ->get();

            $role->syncPermissions($permissions);

            return redirect()
                ->route('roles.index')
                ->with('success', 'Le rôle et ses permissions ont été modifiés avec succès.');

        } catch (\Exception $e) {

            return redirect()
                ->route('roles.index')
                ->with('error', 'Une erreur est survenue lors de la modification du rôle.');
        }
    }

    /**
     * Suppression d'un rôle.
     */
    public function destroy(Role $role)
    {
        try {

            $role->delete();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Le rôle a été supprimé avec succès.');

        } catch (QueryException $e) {

            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce rôle car il est encore utilisé.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'Une erreur est survenue lors de la suppression du rôle.'
                );
        }
    }
}
