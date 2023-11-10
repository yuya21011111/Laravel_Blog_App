<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(10);
        $trashed_users = User::onlyTrashed()->paginate(10);
        return view('admin.users',compact('users','trashed_users'));
    }

    public function trashed_users(){
        $users = User::latest()->paginate(10);
        // ソフトデリート数
        $trashed_users = User::onlyTrashed()->paginate(10);
        
        return view('admin.trashed_users',compact('users', 'trashed_users'));
    }
    
   
    public function promote($id){
        // IDを使って指定されたユーザーをデータベースから取得する
        $user = User::find($id);
        
        // ユーザーを管理者に昇格させるため、is_adminプロパティを1に設定する
        $user->is_admin = 1;
        
        // ユーザーの変更をデータベースに保存する
        $user->save();
        
        // フラッシュメッセージをセッションに格納し、後で表示するようにする
        session()->flash('message','管理者に昇格しました。');
        
        // 直前のページにリダイレクトする
        return back();
    }

    
    public function demote($id){
        // IDを使って指定されたユーザーをデータベースから取得する
        $user = User::find($id);
        
        // ユーザーの管理者権限を解除するため、is_adminプロパティを0に設定する
        $user->is_admin = 0;
        
        // ユーザーの変更をデータベースに保存する
        $user->save();
        
        // フラッシュメッセージをセッションに格納し、後で表示するようにする
        session()->flash('message','ユーザーは降格されました。');
        
        // 直前のページにリダイレクトする
        return back();
    }
    

     
    public function profile(){
        // admin.profileビューを表示する
        return view('admin.profile');
     }
     
     // プロフィールの更新を処理する関数
     public function update(Request $request, $id){
         // IDを使って指定されたユーザーをデータベースから取得する
         $user = User::find($id);
         
         // リクエストから受け取ったデータを使ってユーザー情報を更新する
         $user->update($request->all());
         
         // フラッシュメッセージをセッションに格納し、後で表示するようにする
         session()->flash('message', '正常に更新されました');
         
         // 直前のページにリダイレクトする
         return back();  
     }
     
    
    
     public function user_profile($id){
        // IDを使って指定されたユーザーをデータベースから取得する
        $user = User::find($id);
        
        // 'admin.user_profile'ビューにユーザー情報を渡して表示する
        return view('admin.user_profile', compact('user'));
    }
    
    // ユーザーの削除を処理する関数
    public function destroy($id){
        // IDを使って指定されたユーザーをデータベースから取得する
        $user = User::find($id);
        
        // ユーザーを削除する
        $user->delete();
        
        // フラッシュメッセージをセッションに格納し、後で表示するようにする
        session()->flash('message','正常に削除されました。');
        
        // 直前のページにリダイレクトする
        return back();
    }
    

     // 復元
     public function restore($id){
        $post = User::onlyTrashed()->find($id);
        $post->restore();
        session()->flash('message', 'ユーザーは正常に復元されました。');
        return back();
    }
    // 完全に削除
    public function remove($id){
        $post = User::onlyTrashed()->find($id);
        $post->forceDelete();
        session()->flash('message', 'ユーザーは正常に削除されました。');
        return back();
    }
}
