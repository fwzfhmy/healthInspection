<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

// use App\Models\Timetable;
use App\Models\Client;
use App\Models\Report;
use App\Models\Symptom;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CounselorAppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusLabels = [
            0 => 'Scheduled',
            1 => 'Confirmed',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Cancelled',
        ];
        $user = auth()->user();
        $appointments = Appointment::with('counselor')
            ->where('counselorId', '=', $user->id)
            ->get();

        return view('counselor.appointment.index', compact('appointments', 'statusLabels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $clients = User::where('role', 0)->get();
        $symptoms = Symptom::all();

        return view('counselor.appointment.create', compact('clients', 'symptoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'clientId' => 'required|exists:users,id',
            'method' => 'required',
            // 'symptoms' => 'array',
        ]);

        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['date'] . ' ' . $validatedData['time'] . ":00");

        $appointment = new Appointment();
        $appointment->clientId = $validatedData['clientId'];
        $appointment->method = $validatedData['method'];
        $appointment->counselorId = Auth::user()->id;
        $appointment->appointmentDateTime = $datetime;

        $client = Client::where('counselorId', $appointment->counselorId)
            ->where('clientId', $appointment->clientId)
            ->first();

        if (!$client) {
            $newClient = new Client();
            $newClient->clientId = $validatedData['clientId'];
            $newClient->counselorId = Auth::user()->id;
            $newClient->save();
        }
        $appointment->save();

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment created successfully.')->with('appointment', $appointment);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $reports = Report::with('appointment')
            ->where('appointmentId', $appointment->id)
            ->get();

        return view('counselor.appointment.show', compact('appointment', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $clients = User::where('role', 0)->get();
        $symptoms = Symptom::all();

        return view('counselor.appointment.edit', compact('clients', 'appointment', 'symptoms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'clientId' => 'required|exists:users,id',
            'method' => 'required',
            'status' => 'required|in:0,1,2,3,4',

            // 'symptoms' => 'array',
        ]);

        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['date'] . ' ' . $validatedData['time'] . ":00");

        $appointment->update([
            'clientId' => $validatedData['clientId'],
            'method' => $validatedData['method'],
            'counselorId' => Auth::user()->id,
            'appointmentDateTime' => $datetime,
            'status' => $validatedData['status'],
        ]);
        // $inspection->update($request->all());

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment updated successfully');
    }
    public function changeStatus($appointmentId, $status)
    {
        $counselor = Auth::user();
        $appointment = Appointment::where('id', $appointmentId)
            ->where('counselorId', $counselor->id)
            ->first();

        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        $appointment->status = $status;
        $appointment->save();

        return redirect()->back()
            ->with('success', 'Appointment status updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment deleted successfully');
    }

}
