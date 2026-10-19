<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Coin;
class Holiding extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'holidings';
    protected $fillable = [
        'user_id',
        'coin_id',
        'amout',
        'times',
    ];

    public function coin(){
        return $this->belongsTo(Coin::class);
    }
}
