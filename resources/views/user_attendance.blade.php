@extends('layouts.layout')
@section('title', '日付ページ')

<style>
  th, td {
    border-top: 1px solid gray;
    line-height: 50px;
    text-align: center;
  }

/* 各月タイトル用 */
  .title-month {
    background-color: #fff;
    line-height: unset;
    color: #db7093;
  }
</style>

@section('content')
<div class="content-title mb-20">
  <h3 class="content-title">{{$name}}さんの出勤簿</h3>
</div>

<table class="attendance-table">
  <tr>
    <th>出勤日</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>

  @foreach($items as $month => $group)
    <tr>
      <td colspan="5" class="title-month">{{$month}}</td>
    </tr>

    @foreach ($group as $item)
      <tr>
        <td>{{$item->date->format('Ymd')}}</td>
        <td>{{$item->work_start->format('H:i:s')}}</td>
        <td>{{$item->work_finish->format('H:i:s')}}</td>
        <td>{{$item->getRestTime()}}</td>
        <td>{{$item->getWorkTime()}}</td>
      </tr>
    @endforeach
  @endforeach

</table>
{{-- {{$items->appends(request()->input())->links()}} --}}
@endsection