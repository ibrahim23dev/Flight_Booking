<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AttendanceController extends Controller
{
    public function index(Request $request)
  {
  
    $user = Auth::user();
    $attendances = Attendance::query();

    if (!$user->hasPermissionTo('view all attendance')) {
        $attendances->where('user_id', $user->id);
    }

    if ($request->has('daterange')) {
        $dateArr=explode('to',$request->daterange);
  
        $start_date = Carbon::createFromFormat('Y-m-d', trim($dateArr[0]))->startOfDay();
        $end_date = Carbon::createFromFormat('Y-m-d', trim($dateArr[1]))->endOfDay();
        $attendances->whereBetween('date', [$start_date, $end_date]);
    } else {
        $attendances->where('date', Carbon::today());
    }

    $attendances = $attendances->with(['user', 'createdBy', 'updatedBy'])->get();

    return view('attendance.index', compact('attendances'));
  }

    

   // create attendance form 
   public function create(){
        return view('attendance.create');
   }

   // storing the user attendance 

public function store(Request $request)
{
    $user = Auth::user();
    $now = Carbon::now();
    
     // Check if attendance already marked for today
     $todayAttendance = Attendance::where('user_id', $user->id)
     ->whereDate('date', Carbon::now()->format('Y-m-d'))
     ->first();
     if ($todayAttendance) {
        return redirect()->route('Accounts/attendance.index')->with('error', 'Attendance already marked for today.');
     }
   
    // Validate if the selected time is not in future
    $request->validate([
                    'clock_in_time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) {
                        $currentTime = Carbon::now();
                        $inputTime = Carbon::createFromFormat('H:i', $value);
        
                        if ($inputTime->gt($currentTime)) {
                            $fail($attribute.' must not be a future time.');
                        }
                    }],
                ]);
    
    $attendance = new Attendance();
    $attendance->user_id = $user->id;
    $attendance->clock_in=$request->clock_in_time;
    $attendance->date = $now->format('Y-m-d');
    $attendance->created_by=$user->id;
    $attendance->updated_by=$user->id;
    $attendance->save();

    return redirect()->route('Accounts/attendance.index')->with('success', 'Attendance marked successfully.');
  }
    // ending shift 
    public function endShift(Request $request, $id)
  {
    $attendance = Attendance::find($id);

    if ($attendance->clock_out) {
        return redirect()->back()->with('error', 'Shift end already marked!');
    }

    $now = Carbon::now();
   $outTimearr =explode(' ',$now);
   $attendance->clock_out=trim($outTimearr[1]);

    // Calculate total working hours for the day
    $total_minutes = $now->diffInMinutes($attendance->clock_in);
    $total_hours = floor($total_minutes / 60);
    $total_minutes = $total_minutes % 60;
    
    if ($attendance->break_start && $attendance->break_end) {
        $break_minutes = $attendance->break_end->diffInMinutes($attendance->break_start);
        $total_minutes -= $break_minutes;
    }
    
    $attendance->total_hours = $total_hours . ':' . str_pad($total_minutes, 2, '0', STR_PAD_LEFT);

    if ($attendance->save()) {
        return redirect()->back()->with('success', 'Shift end marked successfully!');
    } else {
        return redirect()->back()->with('error', 'Error marking shift end!');
    }
  }

}
