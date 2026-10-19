<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Models\User;
use App\Http\Models\Coin;
class Withdrawal extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'withdrawals';
    protected $fillable = [
        'user_id',
        'coin_id',
        'amout',
        'address',
    ];
}
