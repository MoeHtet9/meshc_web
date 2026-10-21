<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Amout;
use App\Models\Holiding;
use App\Models\Deposit;
use App\Models\Withdrawal;
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

    // DEPOSIT
    public function deposit() {
        return view('front.deposit');
    }

    public function new_deposit(Request $request)
    {
        // dd($request);
        $newDeposit = Deposit::create($request->all());

        // file upload
        $file_name = time().'.'.$request->payment_ss->extension();//2242143142.jpg

        $upload = $request->payment_ss->move(public_path('images/post/'), $file_name); // folder upload

        if ($upload) {
            $newDeposit->payment_ss = "/images/post/".$file_name;
        }

        $newDeposit->save();

        return redirect()->route('history');
    }

    // WITHDRAWAL
    public function withdrawal() {
        $amout = Amout::where('user_id', Auth::user()->id)->first();
        return view('front.withdrawal', compact('amout'));
    }

    public function new_withdrawal(Request $request) {
        // dd('REQUEST ရောက်ပြီ', $request->all());
        $user = Auth::user();
        Withdrawal::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'amout' => $request->amout,
        ]);

        return redirect()->route('history');
    }

    public function holiding() {
        $amout = Amout::where('user_id', Auth::user()->id)->first();
        return view('front.holiding', compact('amout'));
    }

    public function history() {
        return view('front.history');
    }
}
