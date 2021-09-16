@extends('layouts.layout')
@section('title', 'ログイン')

@section('content')
  <h3 class="content-title mb-20">{{$text}}</h3>
  @if(session()->has('text'))
    <p class="error-msg">{{session()->get('text')}}</p>
  @endif

  <form action="/login" class="form" method="post">
    <div>
      @csrf
      <input type="text" name="email" placeholder="メールアドレス" value="{{old('email')}}" class="input-content mb-20">
      <input type="password" name="password" placeholder="パスワード" class="input-content mb-20">
      <input type="submit" value="ログイン" class="button mb-20">
    </div>
  </form>

  <div>
    <p class="msg-alter">アカウントをお持ちでない方はこちらから</p>
    <a href="/register" class="link-alter">{{ __('会員登録') }}</a>
  </div>

@endsection