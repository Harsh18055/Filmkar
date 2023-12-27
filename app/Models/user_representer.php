<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_representer extends Model
{
    use HasFactory;
    protected $table = 'user_representers';

    public function referrals()
    {
        return $this->hasMany(Referral_Representer::class, 'referrer_id');
    }
}
