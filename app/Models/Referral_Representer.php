<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral_Representer extends Model
{
    use HasFactory;
    protected $table = 'representer_referrals';

    public function referred()
    {
        return $this->belongsTo(user_representer::class, 'referred_id');
    }
}
