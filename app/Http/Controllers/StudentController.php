<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetcing Data in the Array Formate and Dispalying it in student.index with refernece variable compact('students')
        $students = Student::all()->toArray();
        return view('student.index' , compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required'
        ]);
        $student = new Student([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name')
        ]);
        $student->save();
        return redirect()->route('student.index')->with('success', 'Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //getting the id from reference url index.blade.php
        //<a href="{{action('StudentController@edit' , $row['id'])}}">Edit</a>
        
        $student = Student::find($id);
        return view('student.edit' , compact('student' , 'id'));

        //Sending Data to student.edit with specific Id
        //return view('student.edit' , compact('student' , 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // 'first_name' => 'required',   Input Fields Validations
       //    'last_name' => 'required'

        $this->validate($request , [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        //  $student = Student::find($id); Find student with specific id
        
        //Store Updated Info into input fields
        //  $student->first_name = $request->get('first_name'); 
       // $student->last_name = $request->get('last_name');

        $student = Student::find($id);
        $student->first_name = $request->get('first_name');
        $student->last_name = $request->get('last_name');
        $student->save();
        return redirect()->route('student.index')->with('success' , 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('student.index')->with('success' , 'Data Deleted');
    }
}
