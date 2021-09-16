<?php

namespace App\Http\Controllers;

use App\Models\Timecard;
use App\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TimecardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $timecard = Timecard::where('user_id', $user->id)->where('date', $today)->first();

        // 勤務開始前？
        $isWorkingBefore = $timecard === null;
        // 勤務時間内？
        $isWorkingTime = false;
        // 休憩中？
        $isBreakTime = false;

        if (!$isWorkingBefore) {
            $isWorkingTime = $timecard->work_finish === null;
            $isBreakTime = !Rest::where('timecard_id', $timecard->id)->whereNull('rest_finish')->get()->isEmpty();
        }
        // bladeのボタン制御
        $workBeginEnable = $isWorkingBefore;
        $workFinishEnable = $isWorkingTime && !$isBreakTime;
        $restBeginEnable = $workFinishEnable;
        $restEndEnable = $isWorkingTime && $isBreakTime;

        return view(
            'index',
            compact(
                'user',
                'workBeginEnable',
                'workFinishEnable',
                'restBeginEnable',
                'restEndEnable'
            )
        );
    }

    // 勤務開始ボタン++++++++++++++++++++++++++++++++++++
    public function workStart()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $timecard = Timecard::where('user_id', $user->id)->where('date', $today)->latest()->first();
        if ($timecard === null) {
            $timecard = Timecard::create([
                'user_id' => $user->id,
                'date' => $today,
                'work_start' => Carbon::now(),
            ]);
            return redirect('/');
        }
    }

    // 勤務終了ボタン++++++++++++++++++++++++++++++++++++
    public function workFinish()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $timecard = Timecard::where('user_id', $user->id)->where('date', $today)->latest()->first();
        $timecard->update([
            'work_finish' => Carbon::now(),
        ]);
        return redirect()->action([TimecardController::class, 'index']);
    }

    // 休憩開始ボタン++++++++++++++++++++++++++++++++++++
    public function restStart()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $timecard = Timecard::where('user_id', $user->id)->where('date', $today)->latest()->first();
        $rest = Rest::where('timecard_id', $timecard->id)->latest()->first();
        $rest = Rest::create([
            'timecard_id' => $timecard->id,
            'rest_start' => Carbon::now(),
        ]);
        return redirect()->action([TimecardController::class, 'index']);
    }

    // 休憩終了ボタン++++++++++++++++++++++++++++++++++++
    public function restFinish()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $timecard = Timecard::where('user_id', $user->id)->where('date', $today)->latest()->first();
        $rest = Rest::where('timecard_id', $timecard->id)->latest()->first();
        $rest->update([
            'rest_finish' => Carbon::now(),
        ]);
        return redirect()->action([TimecardController::class, 'index']);
    }

    // ログアウト+++++++++++++++++++++++++++++++++++++++
    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
