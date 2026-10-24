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
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;

            $user = User::find($id);
            $amout = Amout::where('user_id', $id)->first();
            $holidings = Holiding::where('user_id', $id)->get();
            return view('front.main', compact('user','amout','holidings'));
        }else{
            return redirect()->route('login');
        }
    }

    public function claim($id, $user_id, $amount) {
        $holiding = Holiding::find($id);
        $holiding->delete();

        Amout::where('user_id', $user_id)->update(['amout' => $amount]);

        return redirect()->route('main');
    }

    // DEPOSIT
    public function deposit() {
        if(isset(Auth::user()->id)){
            return view('front.deposit');
        }else{
            return redirect()->route('login');
        }
    }

    public function new_deposit(Request $request) {
        if(isset(Auth::user()->id)){
            // dd($request);
            $user = Auth::user();
            Deposit::create([
                'user_id' => $user->id,
                'amout' => $request->amout,
                'payment_ss' => $request->payment_ss,
                'status' => 'Pending',
            ]);

            // file upload
            $file_name = time().'.'.$request->payment_ss->extension();//2242143142.jpg

            $upload = $request->payment_ss->move(public_path('images/post/'), $file_name); // folder upload

            if ($upload) {
                $request->payment_ss = "/images/post/".$file_name;
            }

            return redirect()->route('history');
        }else{
            return redirect()->route('login');
        }
    }

    // WITHDRAWAL
    public function withdrawal() {
        if(isset(Auth::user()->id)){
            $amout = Amout::where('user_id', Auth::user()->id)->first();
            return view('front.withdrawal', compact('amout'));
        }else{
            return redirect()->route('login');
        }
    }

    public function new_withdrawal(Request $request) {
        if(isset(Auth::user()->id)){
            // dd('REQUEST ရောက်ပြီ', $request->all());
            $user = Auth::user();
            Withdrawal::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'amout' => $request->amout,
                'status' => 'Pending',
            ]);

            return redirect()->route('history');
        }else{
            return redirect()->route('login');
        }
    }

    // HOLIDING
    public function holiding() {
        if(isset(Auth::user()->id)){
            $amout = Amout::where('user_id', Auth::user()->id)->first();
            return view('front.holiding', compact('amout'));
        }else{
            return redirect()->route('login');
        }
    }

    public function new_holiding(Request $request) {
        if(isset(Auth::user()->id)){
            // dd('REQUEST ရောက်ပြီ', $request->all());
            $user = Auth::user();
            Holiding::create([
                'user_id' => $user->id,
                'coin_id' => 1,
                'amout' => $request->amout,
                'times' => $request->times,
            ]);

            $firstBalance = Amout::where('user_id', $user->id)->first();
            $balance = $firstBalance->amout - $request->amout ;
            Amout::where('user_id', $user->id)->update(['amout' => $balance]);

            return redirect()->route('main');
        }else{
            return redirect()->route('login');
        }
    }

    // HISTORY
    public function history() {
        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
            $deposit_times = Deposit::where('user_id', $user_id)->count();
            $withdrawal_times = Withdrawal::where('user_id', $user_id)->count();

            $deposits = Deposit::where('user_id', $user_id)->orderBy('created_at','DESC')->get();
            $deposit_amount = 0;
            foreach($deposits as $deposit){
                $deposit_amount += $deposit->amout;
            }

            $withdrawals = Withdrawal::where('user_id', $user_id)->orderBy('created_at','DESC')->get();
            $withdrawal_amount = 0;
            foreach($withdrawals as $withdrawal){
                $withdrawal_amount += $withdrawal->amout;
            }

            return view('front.history', compact(
                'deposit_amount',
                'withdrawal_amount',
                'deposit_times',
                'withdrawal_times',
                'deposits',
                'withdrawals',
                ));
        }else{
            return redirect()->route('login');
        }
    }
}
