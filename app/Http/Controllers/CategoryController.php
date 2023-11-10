<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        // 最新の5つのカテゴリーをクエリし、ページネーションを適用する
        $categories = Category::latest()->paginate(5);
        
        // ゴミ箱にあるカテゴリーを取得する
        $trashed = Category::onlyTrashed()->get();
        
        // 'admin.categories'ビューに以下の変数を渡して返す:
        // - categories: 最新の5つのカテゴリー（ページネーションが適用されている）
        // - trashed: ゴミ箱にあるカテゴリー
        return view('admin.categories',compact('categories','trashed'));
    }
    
    public function trashed() {
        // すべてのカテゴリーをクエリする
        $categories = Category::all();
        
        // ゴミ箱にあるカテゴリーを取得し、ページネーションを適用する
        $trashed = Category::onlyTrashed()->paginate(10);
        
        // 'admin.trashed'ビューに以下の変数を渡して返す:
        // - categories: すべてのカテゴリー
        // - trashed: ゴミ箱にあるカテゴリー（ページネーションが適用されている）
        return view('admin.trashed',compact('categories','trashed'));
    }
    
    public function create(){
        // 'admin.create_category'ビューを返す
        return view('admin.create_category');
    }
    
    public function store(Request $request){
        // リクエストからデータを取得し、新しいカテゴリーを作成する
        Category::create($request->all());
        
        // セッションにフラッシュメッセージを設定する
        \session()->flash('message', 'カテゴリーを設定しました。');
        
        // 前のページにリダイレクトする
        return back();
    }
    
    public function edit($id) {
        // 指定されたIDに基づいてカテゴリーを検索する
        $category = Category::findOrFail($id);
        
        // 'admin.edit_category'ビューに以下の変数を渡して返す:
        // - category: 編集するカテゴリー
        return view('admin.edit_category',compact('category'));
    }
    
    public function update(Request $request, $id){
        // 指定されたIDに基づいてカテゴリーを検索する
        $category = Category::findOrFail($id);
        
        // リクエストからデータを取得し、カテゴリーを更新する
        $category->update($request->all());
        
        // セッションにフラッシュメッセージを設定する
        session()->flash('message', 'Category' .$category->name.'を設定しました。');
        
        // 'admin.categories.index'へリダイレクトする
        return redirect()->route('admin.categories.index');
    }
    
    public function destroy($id){
        // 指定されたIDに基づいてカテゴリーを検索する
        $category = Category::findOrFail($id);
        
        // カテゴリーをソフトデリート（ゴミ箱に移動）する
        $category->delete();
        
        // セッションにフラッシュメッセージを設定する
        session()->flash('message', 'カテゴリーは正常に削除されました');
        
        // 'admin.categories.index'へリダイレクトする
        return redirect()->route('admin.categories.index');
    }
    
    public function retrieve($id){
        // 指定されたIDに基づいてカテゴリーを取得する（ゴミ箱も含む）
        $category = Category::withTrashed()->find($id);
        
        // カテゴリーを復元する
        $category->restore();
        
        // セッションにフラッシュメッセージを設定する
        session()->flash('message', 'カテゴリーは正常に取得されました。');
        
        // 'admin.categories.index'へリダイレクトする
        return redirect()->route('admin.categories.index');
    }
    
    public function remove($id){
        // 指定されたIDに基づいてカテゴリーを取得する（ゴミ箱も含む）
        $category = Category::withTrashed()->find($id);
        
        // カテゴリーを完全に削除する
        $category->forceDelete();
        
        // セッションにフラッシュメッセージを設定する
        session()->flash('message', 'カテゴリーは正常に削除されました。');
        
        // 'admin.categories.index'へリダイレクトする
        return redirect()->route('admin.categories.index');
    }
    
}
