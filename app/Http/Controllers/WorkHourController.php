<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkHour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WorkHourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $workHours = WorkHour::all();

        return view('admin.work-hour', compact('admin', 'workHours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Auth::guard('admin')->user();

        $workHour = WorkHour::findOrFail($id);

        $workHour->clock_in = \Carbon\Carbon::parse($workHour->clock_in)->format('H:i');
        $workHour->clock_out = \Carbon\Carbon::parse($workHour->clock_out)->format('H:i');

        return view('admin.edit-work-hour', compact('admin', 'workHour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i|after:clock_in',
        ]);

        $workHour = WorkHour::findOrFail($id);

        $workHour->clock_in = $request->input('clock_in');
        $workHour->clock_out = $request->input('clock_out');

        $workHour->save();

        return redirect()->route('admin.work-hour.index')->with('success', 'Jam Kerja berhasil diupdate');
    }
}
