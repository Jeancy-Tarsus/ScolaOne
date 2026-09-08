<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Liste des permissions.
     */
    public function index(Request $request)
    {
        $query = Permission::where('guard_name', 'web');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('name', 'like', "%{$search}%");
        }

        $permissions = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Création via modale.
     */
    public function create()
    {
        return redirect()->route('permissions.index');
    }

    /**
     * Enregistrer une permission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name',
            ],
        ], [
            'name.required' => 'Le nom de la permission est obligatoire.',
            'name.string' => 'Le nom de la permission doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la permission ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Cette permission existe déjà.',
        ]);

        try {
            Permission::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            return redirect()
                ->route('permissions.index')
                ->with('success', 'La permission a été créée avec succès.');

        } catch (\Exception $e) {
            return redirect()
                ->route('permissions.index')
                ->with('error', 'Une erreur est survenue lors de la création de la permission.');
        }
    }

    /**
     * Afficher une permission.
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');

        return view('permissions.index', compact('permission'));
    }

    /**
     * Modification via modale.
     */
    public function edit(Permission $permission)
    {
        return redirect()->route('permissions.index');
    }

    /**
     * Modifier une permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')
                    ->ignore($permission->id),
            ],
        ], [
            'name.required' => 'Le nom de la permission est obligatoire.',
            'name.string' => 'Le nom de la permission doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la permission ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Cette permission existe déjà.',
        ]);

        try {
            $permission->update([
                'name' => $validated['name'],
            ]);

            return redirect()
                ->route('permissions.index')
                ->with('success', 'La permission a été modifiée avec succès.');

        } catch (\Exception $e) {
            return redirect()
                ->route('permissions.index')
                ->with('error', 'Une erreur est survenue lors de la modification de la permission.');
        }
    }

    /**
     * Supprimer une permission.
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();

            return redirect()
                ->route('permissions.index')
                ->with('success', 'La permission a été supprimée avec succès.');

        } catch (QueryException $e) {
            return redirect()
                ->route('permissions.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette permission car elle est encore utilisée.'
                );

        } catch (\Exception $e) {
            return redirect()
                ->route('permissions.index')
                ->with(
                    'error',
                    'Une erreur est survenue lors de la suppression de la permission.'
                );
        }
    }
}
