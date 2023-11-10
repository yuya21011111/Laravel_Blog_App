<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class AdminController extends Controller
{
    public function home(){

        // 全投稿の件数を取得する
        $postsCount = Post::all()->count();
    
        // 全カテゴリーの件数を取得する
        $categoriesCount = Category::all()->count();
    
        // 全ユーザーの件数を取得する
        $usersCount = User::all()->count();
    
        // 最新の5つの投稿を取得する
        $recentPosts = Post::latest()->take(5)->get();
    
        // 最新の5つのカテゴリーを取得する
        $recentCategories = Category::latest()->take(5)->get();
        
        // 'admin.home'ビューに以下の変数を渡して返す:
        // - postsCount: 全投稿の件数
        // - categoriesCount: 全カテゴリーの件数
        // - usersCount: 全ユーザーの件数
        // - recentPosts: 最新の5つの投稿
        // - recentCategories: 最新の5つのカテゴリー
        return view('admin.home',compact('postsCount','categoriesCount','usersCount','recentPosts','recentCategories'));
    }
    
}
