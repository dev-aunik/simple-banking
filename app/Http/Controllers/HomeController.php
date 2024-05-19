<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index()
    {
        $userTransactions = auth()->user()->transactions;
        $despositAmount = auth()->user()->transactions->where('transaction_type', 'DEPOSIT')->sum("amount");
        $withdrwalAmount = auth()->user()->transactions->where('transaction_type', 'WITHDRAWAL')->sum("amount");
        $withdrwalAmountFee = auth()->user()->transactions->where('transaction_type', 'WITHDRAWAL')->sum("fee");
        $withdrwalAmount = $withdrwalAmount + $withdrwalAmountFee;
        $userTransactions = auth()->user()->transactions()->paginate(10);
        return view('pages.home', compact('userTransactions', 'despositAmount', 'withdrwalAmount'));
    }

    public function deposit()
    {
        $userDeposits = auth()->user()->transactions()->where('transaction_type', 'DEPOSIT')->paginate(10);
        return view('pages.deposit', compact('userDeposits'));
    }

    public function depositPost(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($user_id);
        if (!$user) {
            return redirect()->back()->with('failed', 'User not exists');
        }
        $deposit = Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => 'DEPOSIT',
            'amount' => $request->amount
        ]);
        $user->balance += $deposit->amount;
        $user->save();

        return redirect()->back()->with('success', '$' . $request->amount . ' has been deposited successfully to your account');
    }

    public function withdrawal()
    {
        $userWithdrawns = auth()->user()->transactions()->where('transaction_type', 'WITHDRAWAL')->paginate(10);
        return view('pages.withdrawal', compact('userWithdrawns'));
    }

    public function withdrawalPost(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($value > auth()->user()->balance) {
                        $fail('The ' . $attribute . ' must not exceed your current balance.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($user_id);
        if (!$user) {
            return redirect()->back()->with('failed', 'User not exists');
        }

        $fee = 0;
        $amount = $request->amount;
        $accountType = $user->account_type;

        if ($accountType == 'INDIVIDUAL') {
            $today = Carbon::today();
            $isFriday = $today->isFriday();
            if (!$isFriday) {
                $firstOfMonth = $today->copy()->startOfMonth();
                $totalMonthlyWithdrawals = $user->transactions->where('transaction_type', 'WITHDRAWAL')
                    ->where('date', '>=', $firstOfMonth)
                    ->sum('amount');
                if ($totalMonthlyWithdrawals + $amount > 5000) {
                    $chargeableAmount = max(0, $amount - max(0, 5000 - $totalMonthlyWithdrawals));
                } else {
                    $chargeableAmount = max(0, $amount - 1000);
                }
                $fee = $chargeableAmount * 0.00015;
            }
        } elseif ($accountType == 'BUSINESS') {
            $totalWithdrawals = $user->transactions->where('transaction_type', 'WITHDRAWAL')->sum('amount');
            $newTotalWithdrawals = $totalWithdrawals + $amount;
            if ($newTotalWithdrawals > 50000) {
                if ($totalWithdrawals > 50000) {
                    $fee = $amount * 0.00015;
                } else {
                    $remainingToDiscount = 50000 - $totalWithdrawals;
                    $fee = ($remainingToDiscount * 0.00025) + (($amount - $remainingToDiscount) * 0.00015);
                }
            } else {
                $fee = $amount * 0.00025;
            }
        }

        $withdraw = Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => 'WITHDRAWAL',
            'amount' => $request->amount,
            'fee' => $fee
        ]);
        $user->balance -= ($withdraw->amount + $withdraw->fee);
        $user->save();

        return redirect()->back()->with('success', '$' . $request->amount . ' has been withdrawn successfully from your account');
    }
}
