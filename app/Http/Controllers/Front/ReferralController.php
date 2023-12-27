<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_representer;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{

    function generateReferralCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $referralCode = '';
        for ($i = 0; $i < 10; $i++) {
          $referralCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $referralCode;
      }
      
    public function user_create(Request $request)
    {
        $validatedData = $request->validate([
            'referral_code' => 'required|exists:users,referral_code',
        ]);

        $referral = new Referral;
        $referral->referrer_id = Auth::id();
        $referredUser = User::where('referral_code', $validatedData['referral_code'])->first();
        $referral->referred_id = $referredUser->id;
        $referral->save();

        return response()->json(['message' => 'Referral created successfully']);
    }
}
