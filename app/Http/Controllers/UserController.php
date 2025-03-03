<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.user.index');
    }
    public function getAll(){
        $users=User::get();
        // foreach($users as $data){
        //     dump($data);
        // }
        $response=[
            'data'=>$users,
            'recordsFiltered'=>count($users),
            'recordsTotal'=>count($users),
        ];
        return $response;
    }
    public function store(Request $request)
    {
        // dd(Rules\Password::defaults());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required',Rules\Password::defaults()],
        ]);
        
        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return true;
    }

    public function update(Request $request)
    {
        // $users=User::select('password')
        // ->where('id','=',$request->id)
        // ->get();
        
        // dd(Hash::check($request->password,$users[0]->password));
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required',Rules\Password::defaults()],
        ]);
        $users = User::update([
            'name' => $request->name,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
        ])
        ->where('id','=',$request->id);
        return $users;
    }

    public function destroy(User $user,$id)
    {
        $user = User::find($id);
        $user->delete();
        return true;
    }
}
