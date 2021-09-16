@extends('layouts.layout')
@section('title', '日付ページ')

<style>
  th, td {
    border-top: 1px solid gray;
    line-height: 50px;
    text-align: center;
  }
</style>

@section('content')
<div class="content-title mb-20">
  <h3 class="content-title">社員一覧</h3>
</div>

<table class="attendance-table">
  <tr>
    <th>名前</th>
    <th>本日の勤務状況</th>
  </tr>

@foreach ($users as $user)
  <tr>
    <td>
      <a href="{{ route('user_attendance', "id=$user->id&name=$user->name") }}">
        {{$user->name}}
      </a>
    </td>
    <td>
      {{$text}}
    </td>
  </tr>
@endforeach

</table>
{{-- {{$user->appends(request()->input())->links()}} --}}
@endsection