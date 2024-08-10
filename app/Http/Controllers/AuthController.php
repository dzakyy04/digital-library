<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $title = 'Daftar';
        return view('auth.register', compact('title'));
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                ],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Selamat datang!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())
                ->with('error', 'Terjadi kesalahan dalam validasi. Silakan periksa data yang Anda masukkan.')
                ->withInput();
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mendaftarkan akun. Silakan coba lagi.')->withInput();
        }
    }

    public function showLoginForm()
    {
        $title = 'Masuk';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'))->with('success', 'Selamat datang kembali!');
            }

            return back()->with('error', 'Email atau password tidak sesuai.')->withInput();
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())
                ->with('error', 'Terjadi kesalahan dalam validasi. Silakan periksa data yang Anda masukkan.')
                ->withInput();
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat login. Silakan coba lagi.')->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Sampai jumpa lagi!');
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat logout. Silakan coba lagi.');
        }
    }
}
