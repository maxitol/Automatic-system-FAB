<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminPanelController extends Controller
{
    /** @var User $user */ // PHPDoc комментарий для свойства $auth
    protected $user;
    /** @var News $news */ // PHPDoc комментарий для свойства $auth
    protected $news;
    public function addNews(){
         return view('adminPanel.addNews');

    }
    public function userPanel(){

        $users = User::get()->toArray();
        return view('adminPanel.userPanel', ['users' => $users]);
    }
    public function newUser(){
        return view('adminPanel.newUser');

    }
    public function addUser(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $users = User::get()->toArray();
        return view('adminPanel.userPanel', ['users' => $users]);

    }
    public function addNewNews(Request $request){

        $text = $request['text'];
        $news = new News();
        $news->news = $text;
        $news->save();
        return true;
    }
}
