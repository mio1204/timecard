<?php

namespace App\Http\Controllers;

use App\Models\Timecard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // 日付一覧
    public function attendance(Request $request)
    {
        $date = $request->date;
        if ($date === null) {
            $day = Carbon::today();
        } else {
            $day = new Carbon($date);
        }

        $items = Timecard::where('date', $day)->whereNotNull('work_finish')->paginate(3);

        return view(
            'attendance',
            compact(
                'items',
                'day',
            )
        );
    }

    // ユーザー一覧
    public function users()
    {
        $users = User::get();

        // $day = Carbon::today();
        // $items = Timecard::where('date', $day)->where('user_id', $users->id)->get();
        $text = '退勤済み';

        return view(
            'users',
            compact(
                'users',
                'text',
            )
        );
    }

    // ユーザー別勤怠
    public function user_attendance(Request $request)
    {
        $user = $request->get('id');
        $name = $request->get('name');

        $items = Timecard::where('user_id', $user)->whereNotNull('work_finish')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('Y' . "年" . 'n' . "月");
            });

        return view(
            'user_attendance',
            compact(
                'name',
                'items',
            )
        );
    }
}
