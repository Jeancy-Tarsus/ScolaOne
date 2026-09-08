<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\Site;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['organisation', 'site', 'roles']);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtre organisation
        if ($request->filled('organisation_id')) {
            $query->where('organisation_id', $request->organisation_id);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $organisations = Organisation::where('statut', true)
            ->orderBy('nom')
            ->get();

        $sites = Site::where('statut', true)
            ->orderBy('nom')
            ->get();

        $roles = Role::orderBy('name')
            ->get();

        return view('users.index', compact(
            'users',
            'organisations',
            'sites',
            'roles'
        ));
    }

    
    public function create()
    {
        $organisations = Organisation::where('statut', true)
            ->orderBy('nom')
            ->get();

        $sites = Site::where('statut', true)
            ->orderBy('nom')
            ->get();

        $roles = Role::orderBy('name')
            ->get();

        return view('users.index', compact(
            'organisations',
            'sites',
            'roles'
        ));
    }
}
