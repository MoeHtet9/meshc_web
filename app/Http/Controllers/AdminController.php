<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Holiding;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Amout;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard() {
        $users = User::where('role', 'user')->get();
        $holiding_amounts = Holiding::all()->sum('amout');
        $total_transactions = Deposit::where('status', 'pending')->count() + Withdrawal::where('status', 'pending')->count();
        return view('admin.dashboard', compact('users', 'holiding_amounts', 'total_transactions'),);
    }

    // USER MANAGEMENT
    // public function user() {
    //     $users = User::all();
    //     return view('admin.user', compact('users'));
    // }

    // TRANSACTION
    public function transaction() {
        $deposits = Deposit::get();

        $withdrawals = Withdrawal::get();

        $transactions = $deposits
            ->concat($withdrawals)
            ->sortByDesc('created_at')
            ->values();

        return view('admin.transaction', compact('transactions'));
    }

    public function deposit_comp($id, $user_id) {
        Deposit::find($id)->update(['status' => 'completed']);
        $amout = Amout::where('user_id', $user_id)->first();
        $user = User::find($user_id);
        if ($amout) {
            $amout->amout += Deposit::find($id)->amout;
            $amout->save();
        } else {
            Amout::create([
                'user_id' => $user_id,
                'amout' => Deposit::find($id)->amout,
            ]);
        }

        Mail::raw(
            "Your deposit has been completed successfully. Thank you for using our service.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Deposit Completed');
            }
        );

        return redirect()->route('admin.transaction');
    }

    public function deposit_fail($id, $user_id) {
        Deposit::find($id)->update(['status' => 'failed']);
        $user = User::find($user_id);

        Mail::raw(
            "Your deposit has failed. Please contact support for assistance.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Deposit Failed');
            }
        );

        return redirect()->route('admin.transaction');
    }

    public function withdrawal_comp($id, $user_id) {
        Withdrawal::find($id)->update(['status' => 'completed']);
        $user = User::find($user_id);

        Mail::raw(
            "Your withdrawal has been completed successfully. Thank you for using our service.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Withdrawal Completed');
            }
        );

        return redirect()->route('admin.transaction');
    }

    public function withdrawal_fail($id, $user_id) {
        $withdrawal = Withdrawal::find($id)->update(['status' => 'failed']);
        $user = User::find($user_id);

        if ($withdrawal) {
            $amout = Amout::where('user_id', $user_id)->first();
            if ($amout) {
                $amout->amout += Withdrawal::find($id)->amout;
                $amout->save();
            }
        }

        Mail::raw(
            "Your withdrawal has failed. Please contact support for assistance.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Withdrawal Failed');
            }
        );
        
        return redirect()->route('admin.transaction');
    }
}
