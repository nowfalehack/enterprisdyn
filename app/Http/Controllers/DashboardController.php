<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Form;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $forms = Form::count();
        $submissions = Submission::count();

        $recentSubmissions = Submission::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'users',
            'forms',
            'submissions',
            'recentSubmissions'
        ));
    }
}
