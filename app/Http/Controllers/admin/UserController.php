<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        // Trova l'utente autenticato
        $user = $request->user();

        // Validazione dei dati
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Aggiorna i dati dell'utente
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->surname = $request->input('surname');
        $user->address = $request->input('address');

        // Solo se viene fornita una nuova password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->update();

        return redirect()->route('admin.profiles.show', $user->profile);
    }

    public function edit(Request $request)
    {
        return view('auth.passwords.edit');
    }
}
