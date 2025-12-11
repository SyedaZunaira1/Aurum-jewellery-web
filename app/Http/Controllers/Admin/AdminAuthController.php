<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view('admin.auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // We just create the account but DO NOT auto-login the admin for security reasons.
        // Instead, we redirect them to the dashboard (or login page).

        return redirect()->route('admin.dashboard')->with('success', 'New Admin account created successfully!');
    }

    // Show login form
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Enforce Single Session: Logout user if logged in to prevent conflict
            if (Auth::guard('web')->check()) {
                Auth::guard('web')->logout();
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout - redirects to home page
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

    // Show Profile Edit Form
    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }

    // Show dashboard
    public function dashboard()
    {
        $totalProducts = \App\Models\Product::count();

        // Get all unique categories with their counts dynamically
        $categoryCounts = \App\Models\Product::select('category', \DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category')
            ->toArray();

        return view('admin.dashboard', compact('totalProducts', 'categoryCounts'));
    }
}
