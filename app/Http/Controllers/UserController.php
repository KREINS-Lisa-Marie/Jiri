<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController
{
    use PasswordValidationRules;


    public function index(Request $request)
    {

        $user = \Auth::user();
        return View('users.index', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        // validation
        $validated_data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                    Rule::unique('users')->ignore($user->id),
                    // email aus tabelle contacts ausser bei diesem kontakt mit contact-id
                    //Gibt es schon jemanden mit der E-Mail ... aber nicht den mit der id $contact->id?

                'max:255',
            ],
            'password' =>$this->updatePasswordRules(),
        ]);

        // update et insert
        $user->upsert(
            [
                [
                    'id'=>$user->id,
                    'name' => $validated_data['name'],
                    'email' => $validated_data['email'],
                    'password' => Hash::make($validated_data['password']?? $user->password),
                ],
            ],
            'id',
            ['name', 'email', 'password']);

        return redirect(route('users.index', $user));
    }

    public function destroy()
    {
        $user= Auth::user();
        $user->delete();

        return redirect(route('login'));
    }

}
