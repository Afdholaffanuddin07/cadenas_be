<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $fillable = [
        'user_id',
        'jam',
        'tanggal',
        'foto',
    ];
    protected $append = ['foto','created_at'];

    public function getImageAttribute(){
        return asset('storage/' . $this->attribute['foto']);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
