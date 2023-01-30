<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property User|null user
 * @property string link_code
 * @property int id
 */
class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'link_code',
    ];

    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }
}
