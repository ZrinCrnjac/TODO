<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    protected $casts = [
        'user_id' => 'int',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
