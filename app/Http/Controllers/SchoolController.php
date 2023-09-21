<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class SchoolController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::latest()->paginate(5);

        return view('schools.index',compact('schools'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request ->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'teachers_number' => 'required|numeric|min:1|max:5',
            'minimum_admission' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data ['image'] = $this->saveImages($file, 'images');
        }

        School::create($data);

        return redirect()->route('schools.index')
            ->with('success','School created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('schools.show',compact('school'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.edit',compact('school'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $data = $request ->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'teachers_number' => 'required|numeric|min:1|max:5',
            'minimum_admission' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->saveImages($file, 'images');
        }
        $school->update($data);

        return redirect()->route('schools.index')
            ->with('success','School updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        if (file_exists($school->image)) {
            unlink($school->image);
        }
        $school->delete();
        return redirect()->route('schools.index')
            ->with('success','School deleted successfully');
    }
}
