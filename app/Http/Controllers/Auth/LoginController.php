<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // This method handles showing the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // This method handles the login logic
    public function login(Request $request)
{
    // Trim the input values before validation
    $request->merge([
        'email' => trim($request->input('email')),
        'password' => trim($request->input('password')),
    ]);

    // Validate the input data
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->filled('remember'))) {
        $user = Auth::user();

        // // Redirect based on role
        // if ($user->hasRole('Admin')) {
        //     return redirect()->intended(route('filament.admin.pages.dashboard'));
        // } elseif ($user->hasRole('User')) {
            return redirect()->intended(route('filament.user.pages.dashboard'));
       //}

        // Optional: Redirect to a default page if no specific role is found
        return redirect()->intended(route('home'));
    }

    // Return error message if authentication fails
    return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
}

    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     if (Auth::attempt($validated, $request->filled('remember'))) {
    //         return redirect()->route('filament.pages.dashboard'); // Clean redirect
    //     }

    //     return redirect()->route('login')->with('error', 'Invalid credentials.');
    // }
        // If the controller is invoked directly (Filament expects this)
    public function __invoke(Request $request)
    {
        return $this->login($request); // Calls the login method
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}