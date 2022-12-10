<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class ProfileController extends Controller
{
    public function index ()
    {
        return Inertia::render('Admin/ProfileView');
    }

    public function edit (Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return Redirect::route('profile')
            ->with('success', __('admin.notifications.profile.editedSuccess'));
    }
}
