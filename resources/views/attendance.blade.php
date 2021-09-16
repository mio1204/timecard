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

  <a class="button-date" href="?date={{$day->copy()->subDay()->format('Ymd')}}">＜</a>
  <h3 class="content-title">{{$day->format('Y-m-d')}}</h3>
  <a class="button-date" href="?date={{$day->copy()->addDay()->format('Ymd')}}">＞</a>

</div>

<table class="attendance-table">
  <tr>
    <th>名前</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>

  @foreach ($items as $item)
  <tr>
    <td>{{$item->user->name}}</td>
    <td>{{$item->work_start->format('H:i:s')}}</td>
    <td>{{$item->work_finish->format('H:i:s')}}</td>
    <td>{{$item->getRestTime()}}</td>
    <td>{{$item->getWorkTime()}}</td>
  </tr>
@endforeach
</table>

{{$items->appends(request()->input())->links()}}
@endsection