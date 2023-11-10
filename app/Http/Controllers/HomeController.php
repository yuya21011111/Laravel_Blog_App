<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function welcome() { // 「welcome」という名前のパブリック関数です

        $posts = Post::latest()->paginate(10); // 「Post」モデルから最新の投稿を取得し、1ページに10件ずつ表示するようにページネーションします
    
        return view('welcome', compact('posts')); // 取得した投稿を'welcome'ビューに渡すために、compact()関数を使用して変数を作成します
    }


    public function show($id) { // 'show'という名前のパブリック関数。$idパラメータを受け取る。

        $post = Post::find($id); // 'Post'モデルの'find'メソッドを使用して、指定された$idに基づいてデータベースから投稿を取得し、$post変数に代入する。
    
        return view('show',compact('post')); // 'show'ビューに$post変数を渡し、(コンパクト関数を使用して)ビュー内でデータを利用できるようにする。
    }
}
