<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];
    protected $date = ['deleted_at'];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
