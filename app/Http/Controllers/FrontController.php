<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Amout;
use App\Models\Holiding;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function signin() {
        return view('auth.login');
    }

    public function main() {
        $id = Auth::user()->id;

        $user = User::find($id);
        $amout = Amout::where('user_id', $id)->first();
        $holidings = Holiding::where('user_id', $id)->get();
        return view('front.main', compact('user','amout','holidings'));
    }

    public function deposit() {
        return view('front.deposit');
    }

    public function withdrawal() {
        $amout = Amout::where('user_id', Auth::user()->id)->first();
        return view('front.withdrawal', compact('amout'));
    }

    public function holiding() {
        $amout = Amout::where('user_id', Auth::user()->id)->first();
        return view('front.holiding', compact('amout'));
    }

    public function history() {
        return view('front.history');
    }
}
