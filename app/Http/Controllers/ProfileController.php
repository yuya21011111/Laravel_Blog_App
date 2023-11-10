<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
   
    public function edit(Request $request): View
    {
        // リクエストから認証済みユーザーを取得し、'profile.edit' ビューに渡す
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // バリデート済みのデータでユーザーモデルを埋める
        $request->user()->fill($request->validated());
    
        // もし 'email' フィールドが変更されている場合は、'email_verified_at' フィールドを null に設定する
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        // 更新されたユーザーモデルを保存する
        $request->user()->save();
    
        // 'profile.edit' ルートに成功メッセージと共にリダイレクトする
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    public function destroy(Request $request): RedirectResponse
    {
        // リクエストから入力されたパスワードを検証する。エラーメッセージを 'userDeletion' エラーバッグに格納する
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        // 認証済みのユーザーを取得する
        $user = $request->user();
    
        // 現在のユーザーをログアウトする
        Auth::logout();
    
        // ユーザーモデルを削除する
        $user->delete();
    
        // セッションを無効化し、新しいトークンを生成する
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // '/' ルートにリダイレクトする
        return Redirect::to('/');
    }
    
}
