@extends('layouts.layout')
@section('title', '会員登録')

@section('content')
  <h3 class="content-title mb-20">{{$text}}</h3>

      @if(count($errors) > 0)
        <p class="error-msg">入力に問題があります。</p>
      @endif

  <form action="/register" class="form" method="post">
    <div>
      @csrf

      @if($errors->has('name'))
        <p class="error-msg">{{$errors->first('name')}}</p>
      @endif
      <input type="text" name="name" placeholder="名前" value="{{old('name')}}" class="input-content mb-20">

      @if($errors->has('email'))
        <p class="error-msg">{{$errors->first('email')}}</p>
      @endif
      <input type="text" name="email" placeholder="メールアドレス" value="{{old('email')}}" class="input-content mb-20">

      @if($errors->has('password'))
        <p class="error-msg">{{$errors->first('password')}}</p>
      @endif
      <input type="password" name="password" placeholder="パスワード" class="input-content mb-20">

      <input type="password" name="password_confirmation" placeholder="確認用パスワード" class="input-content mb-20">

      <input type="submit" value="会員登録" class="button mb-20">

    </div>
  </form>

  <div>
    <p class="msg-alter">アカウントをお持ちの方はこちらから</p>
    <a href="/login" class="link-alter">{{ __('ログイン') }}</a>
  </div>

@endsection

