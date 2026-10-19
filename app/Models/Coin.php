<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Holiding;
class Coin extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'coins';
    protected $fillable = [
        'name',
    ];

    public function holidings() {
        return $this->hasMany(Holiding::class);
    }
}
