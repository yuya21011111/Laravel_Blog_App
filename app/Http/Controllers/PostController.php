<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Str;

class PostController extends Controller
{
    // 画像保存処理、ファイル名をランダム化
    public function uploadImages($image,$path){
        $imageName = $image->getClientOriginalName();
        $string = Str::random();
        $new_image_name = $string.time().$imageName;
        $image->move($path,$new_image_name);
        return $new_image_name;
    }
    // 投稿を表示
    public function index(){
        $posts = Post::latest()->paginate(10);
        // ソフトデリート数
        $trashed_posts = Post::onlyTrashed()->paginate(10);
        return view('admin.posts',compact('posts', 'trashed_posts'));
    }
    
    // ソフトデリートを表示
    public function trashed_posts(){
        $posts = Post::latest()->paginate(10);
        // ソフトデリート数
        $trashed_posts = Post::onlyTrashed()->paginate(10);
        return view('admin.trashed_posts',compact('posts', 'trashed_posts'));
    }
    
    // 投稿を作成
    public function create(){
        
        $categories = Category::all();
        return view('admin.create_post',compact('categories'));
    }

     // posts DBに登録
     public function store(Request $request){
        
        $imageName = null;
        $request->validate([
            'title' => ['required'],
            'desc' => ['required'],
            'user_id' => ['required'],
            'category_id' => ['required'],
            // 'image' => ['required']
        ]);

        // 画像があるか、ないかの判定
        if($request->has('image')){
            $image = $request->image;
            $path = "storage/posts/";
            $imageName = $this->uploadImages($image,$path);
            
        }
        // 無ければno_image.pngで登録
        else {
            $imageName = "no_image.jpg";
        }
        $post = new Post;
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->image = $imageName;
        $post->save();

        session()->flash('message', '正常に投稿されました。');
        return back();
    }

    public function edit($id) {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.edit_post',compact('post','categories'));
    }
    
    public function update(Request $request, $id){
        $post =  Post::find($id);
        $imageName = $post->image;;
        $request->validate([
            'title' => ['required'],
            'desc' => ['required'],
            'user_id' => ['required'],
            'category_id' => ['required'],
        ]);

         // 画像があるか、ないかの判定
         if($request->has('image')){
            $image = $request->image;
            $path = "storage/posts/";
            $imageName = $this->uploadImages($image,$path);
            
        }
        
        // post DBの更新処理
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->image = $imageName;
        $post->save();
        session()->flash('message', 'Post updated successfull!');
        return back();
    }
    
    // 検索ワードサーチ
    public function search(Request $request){
        $search = $request->search;
        $trashed_posts = Post::onlyTrashed()->where('title','LIKE',"%{$search}%")->paginate(5);
        $posts = Post::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->paginate(5);
        return view('admin.searches',compact('posts','trashed_posts'));
        
    }
    // ソフト削除処理
    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        session()->flash('message', '正常に投稿が削除されました。');
        return back();
    }
    // 復元
    public function restore($id){
        $post = Post::onlyTrashed()->find($id);
        $post->restore();
        session()->flash('message', '投稿が復元されました。');
        return back();
    }
    // 完全に削除
    public function remove($id){
        $post = Post::onlyTrashed()->find($id);
        $post->forceDelete();
        session()->flash('message', '投稿は正常に削除されました。');
        return back();
    }

}
