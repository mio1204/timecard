<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Timecard extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    protected $dates = ['date', 'work_start', 'work_finish'];

    // リレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function rests()
    {
        return $this->hasMany('App\Models\Rest');
    }

    // 休憩時間を合算
    private function getsumRestTime()
    {
        $rests = $this->rests;
        $sum_rest_time = 0;
        foreach ($rests as $rest) {
            $rest_start = new Carbon($rest->rest_start);
            $rest_finish = new Carbon($rest->rest_finish);
            $rest_time = $rest_finish->diffInSeconds($rest_start);
            $sum_rest_time = $sum_rest_time + $rest_time;
        }
        return $sum_rest_time;
    }

    // 時間の表示形式を整える
    private function formatTime($time)
    {
        $time_hour = sprintf('%02d', floor($time / 3600));
        $time_minute = sprintf('%02d', floor(($time / 60) % 60));
        $time_second = sprintf('%02d', $time % 60);
        return "${time_hour}:${time_minute}:${time_second}";
    }

    // 休憩時間
    public function getRestTime()
    {
        $sum_rest_time = $this->getsumRestTime();
        return $this->formatTime($sum_rest_time);
    }

    // 勤務時間
    public function getWorkTime()
    {
        $work_start = new Carbon($this->work_start);
        $work_finish = new Carbon($this->work_finish);
        $work_time = $work_finish->diffInSeconds($work_start);
        $sum_rest_time = $this->getsumRestTime();
        $sum_work_time = $work_time - $sum_rest_time;
        return $this->formatTime($sum_work_time);
    }
}
