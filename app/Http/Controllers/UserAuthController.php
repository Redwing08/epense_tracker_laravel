<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255', // Added validation for Last Name
            'email' => 'required|email|unique:user_accounts,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|max:2048',
        ]);

        $binaryImage = null;
        if ($request->hasFile('image')) {
            $binaryImage = file_get_contents($request->file('image')->getRealPath());
        }

        UserAccount::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname, // Save Last Name
            'email' => $request->email,
            'md5password' => md5($request->password),
            'image' => $binaryImage,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please sign in.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = UserAccount::where('email', $request->email)->first();

        if ($user && $user->md5password === md5($request->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->firstname . ' ' . $user->lastname); // Store full name
            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->firstname . '!');
        }

        return back()->withErrors(['email' => 'Invalid email or password credentials provided.'])->withInput();
    }

    public function logout()
    {
        Session::forget(['user_id', 'user_name']);
        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }

    public function index()
    {
        $users = UserAccount::all();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = UserAccount::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255', // Validate Last Name
            'email' => 'required|email|unique:user_accounts,email,' . $id,
        ]);

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname, // Update Last Name
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['md5password'] = md5($request->password);
        }

        if ($request->hasFile('image')) {
            $data['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Personnel record updated successfully!');
    }

    public function destroy($id)
    {
        UserAccount::destroy($id);
        return redirect()->route('users.index')->with('success', 'Personnel account deleted successfully!');
    }


    public function getAvatarBlob($id)
    {
        $user = UserAccount::findOrFail($id);

        if (!$user->image) {
            return response()->json(['message' => 'No image found'], 404);
        }

        // Stream the binary data back with the correct image header
        return response($user->image)
            ->header('Content-Type', 'image/jpeg'); 
    }


    // for mobile

            public function apiLogin(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = \App\Models\UserAccount::where('email', $request->email)->first();

            if ($user && $user->md5password === md5($request->password)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Authenticated successfully',
                    'user' => [
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'avatar_url' => url("/api/users/{$user->id}/avatar")
                    ]
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid government credentials provided.'
            ], 401);
        }
}