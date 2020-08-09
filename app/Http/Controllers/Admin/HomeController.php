<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{

    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Role::create(["name" => "Administrator"]);
        // Permission::create(["name" => "Create users"]);

        $permission = Permission::find(2);

        $user = Auth::user();
        $user->givePermissionTo($permission);

        return view('admin.home');
    }
}
