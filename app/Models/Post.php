<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    use HasFactory,SoftDeletes;

     protected $dates = ['deleted_at'];
     
    // Categoryから取得
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    // Userから取得
    public function user(){
        return $this->belongsTo(User::class);
    }
}
