@extends('layouts.layout')
@section('title', '打刻ページ')

@section('content')

<h3 class="content-title mb-20">{{$user->name}}さんお疲れ様です！</h3>

<div class="timecard-container">
  <form action="{{ route('workstart') }}" method="post" class="form-timecard">
    @csrf
    <button type="submit" class="button-timecard" @if(!$workBeginEnable) disabled @endif>勤務開始</button>
  </form>

  <form action="{{ route('workfinish') }}" method="post" class="form-timecard">
    @csrf
    <button type="submit" class="button-timecard" @if(!$workFinishEnable) disabled @endif>勤務終了</button>
  </form>
</div>

<div class="timecard-container">
  <form action="{{ route('reststart') }}" method="post" class="form-timecard">
    @csrf
    <button type="submit" class="button-timecard" @if(!$restBeginEnable) disabled @endif>休憩開始</button>
  </form>

  <form action="{{ route('restfinish') }}" method="post" class="form-timecard">
    @csrf
    <button type="submit" class="button-timecard" @if(!$restEndEnable) disabled @endif>休憩終了</button>
  </form>
</div>

@endsection