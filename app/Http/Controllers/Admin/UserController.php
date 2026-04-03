<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin cannot be deleted!');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }
}