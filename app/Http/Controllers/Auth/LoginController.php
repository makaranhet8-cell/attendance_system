<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        // ១. Validate ទិន្នន័យ
        $request->validate([
            'id'       => 'required|numeric',
            'password' => 'required',
        ]);

        // ២. រកមើល User តាម ID
        $user = User::find($request->id);

        // ៣. ពិនិត្យ Password (ទទួលយកទាំង Hash និង Plain Text)
        if ($user && (Hash::check($request->password, $user->password) || $request->password === $user->password)) {

            // ៤. Login ចូលប្រព័ន្ធដោយផ្ទាល់
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // ៥. បង្ហាញ Error ប្រសិនបើខុស
        return back()->withErrors(['id' => 'ID ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
