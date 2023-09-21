<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    use ImageUploadTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::latest()->paginate(5);

        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//    save image

    public function create()
    {
        $schools = school::all();
        return view('users.create', compact('schools'));

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
            'email' => 'required|unique:user',
            'password' => 'required|min:6',
            'image' => 'nullable|image',
            'degree' => 'required|numeric|between:0,100',
            'school_id' => 'required',

        ]);

        // Hash the password
        $data['password'] = Hash::make($request->password);


        $degree = $request->degree;
        $school_id = $request->school_id;

        $minimum_admission_school = School::find($school_id)->minimum_admission;

        if ($degree >= $minimum_admission_school) {
            // create($data);
        } else {
            return redirect()->back()->withErrors(['error' => 'مجموع الطلاب أقل من الحد الادنى للقبول.']);        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data ['image'] = $this->saveImages($file, 'images');
        }

        user::create($data);

        return redirect()->route('users.index')
            ->with('success','User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $schools = school::all();

        return view('users.edit',compact('schools', 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request ->validate([
            'name' => 'required',
            'email' => 'required|unique:user,email,'.$user->id,
            'image' => 'nullable|image',
            'degree' => 'required|numeric|between:0,100',
            'school_id' => 'required',
        ]);

        $degree = $request->degree;
        $school_id = $request->school_id;

        $minimum_admission_school = School::find($school_id)->minimum_admission;

        if ($degree >= $minimum_admission_school) {
            // create($data);
        } else {
            return redirect()->back()->withErrors(['error' => 'مجموع الطلاب أقل من الحد الادنى للقبول.']);        }
          //image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->saveImages($file, 'images');
        }


         //password
        if ($request-> has('password') && $request->password)   {
            $request->validate([
                'password'=> 'min:6',
                ]);
            $data ['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (file_exists($user->image)) {
            unlink($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
