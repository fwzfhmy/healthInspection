<?php

namespace App\Http\Controllers;
use DB;
use Hash; 
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();

        return view('subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
            
        ]);

        DB::table('subjects')->insert([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);
  
        // User::create($request->all());
   
        return redirect()->route('subjects.index')
                        ->with('success','Subject created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subjects.show',compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
        ]);

        DB::table('subjects')->where('id',$request->id)->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);
  
        // $subject->update($request->all());
  
        return redirect()->route('subjects.index')
                        ->with('success','Subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
  
        return redirect()->route('subjects.index')
                        ->with('success','Subject deleted successfully');
    }
}
