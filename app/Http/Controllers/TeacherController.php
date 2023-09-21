<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Teacher;
use App\Models\TeacherAttachment;
use App\Models\User;

use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    use ImageUploadTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(5);

        return view('teachers.index',compact('teachers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = school::all();
        return view('teachers.create', compact('schools'));

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
            'attachments.*' => 'required|file',
            'school_id' => 'required|array',
        ]);
        // Get the selected school IDs from the request
        $selectedSchoolIds = $request->input('school_id');

        foreach ($selectedSchoolIds as $selectedSchoolId) {
            $selectedSchool = School::find($selectedSchoolId);

            // Get the number of teachers in the selected school
            $teachersNumber = $selectedSchool->teachers_number;

            // Get the current count of teachers in the selected school
            $currentTeachersCount = $selectedSchool->teachers()->count();

            // Check if the current teachers count exceeds or equals the teachers number limit
            if ($currentTeachersCount >= $teachersNumber) {
                return redirect()->back()->withErrors(['error' => 'عدد المدرسين في المدرسة ' . $selectedSchool->name . ' مكتمل.']);
            }
        }

//        $fileName= $this->saveImages($request->image, 'images');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data ['image'] = $this->saveImages($file, 'images');
        }
        unset($data['school_id']);
        unset($data['attachments']);

        $teacher = Teacher::create($data);

        $teacher->schools()->attach($request->school_id);

        if ($request->attachments != null){
            foreach ($request->attachments as $attach){
                // كداالمتغير اللي اسمه $attach بقي مفرد زيه زي الصورة
                $file_name = $this->saveImages($attach, 'attachments');
                TeacherAttachment::create([
                    'file_name' => $file_name,
                    'teacher_id' => $teacher->id
                ]);
            }
        }

        return redirect()->route('teachers.index')
            ->with('success','Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show',compact('teacher'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        return view('teachers.edit',compact('teacher'));

        $teacher = Teacher::findOrFail($id);

        $schools = school::all();

        return view('teachers.edit',compact('schools', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request ->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'attachments.*' => 'required|file',
            'school_id' => 'required|array',
        ]);

        // Get the selected school IDs from the request
        $selectedSchoolIds = $request->input('school_id');

        foreach ($selectedSchoolIds as $selectedSchoolId) {
            $selectedSchool = School::find($selectedSchoolId);

            // Get the number of teachers in the selected school
            $teachersNumber = $selectedSchool->teachers_number;

            // Get the current count of teachers in the selected school
            $currentTeachersCount = $selectedSchool->teachers()->count();

            // Check if the current teachers count exceeds or equals the teachers number limit
            if ($currentTeachersCount >= $teachersNumber) {
                return redirect()->back()->withErrors(['error' => 'عدد المدرسين في المدرسة ' . $selectedSchool->name . ' مكتمل.']);
            }
        }


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data ['image'] = $this->saveImages($file, 'images');
        }
        unset($data['school_id']);
        unset($data['attachments']);

        $teacher->update($data);
        $teacher->schools()->sync($request->school_id);

        if ($request->attachments != null) {

            TeacherAttachment::where('teacher_id', $teacher->id)->delete();

            foreach ($request->attachments as $attach) {
                $file_name = $this->saveImages($attach, 'attachments');

                TeacherAttachment::create([
                    'file_name' => $file_name,
                    'teacher_id' => $teacher->id
                ]);
            }
        }


        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        if (file_exists($teacher->image)) {
            unlink($teacher->image);
        }

        foreach ($teacher->attachments as $attachment) {
            if (file_exists($attachment->file_name)) {
                unlink($attachment->file_name);
            }
        }

        // Find and delete the existing TeacherAttachment records
        TeacherAttachment::where('teacher_id', $teacher->id)->delete();

        $teacher->delete();

        $teacher->schools()->detach(); // Detach associated schools

        return redirect()->route('teachers.index')
            ->with('success','teacher deleted successfully');
    }

}
