<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct() {

    }

    public function browse() {
        $users = User::all();
        return $users;
    }

    public function get($id) {
        $user = User::find($id);
        return $user;
    }

    public function create(Request $request) {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = new \Datetime("now");
        $user->name = $request->input('name');
        $user->desc = $request->input('desc');

        $r = $user->save();

        return [
            'id' => $user->id,
            'success' => $r
        ];
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = new \Datetime("now");
        $user->name = $request->input('name');
        $user->desc = $request->input('desc');
        $r = $user->save();

        return ['success' => $r];
    }

    public function delete($id) {
        $user = User::find($id);

        $r = $user->delete();

        return ['success' => $r];
    }

    public function postimg(Request $request) {
        if ($request->file('picture')->isValid()) {
            
        }
        return ['success' => false];
    }
}
