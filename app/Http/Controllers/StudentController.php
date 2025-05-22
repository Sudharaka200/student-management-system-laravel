<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Fetch all students and search
    public function index(Request $request)
{
    $query = Student::query();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('id', $search) // Exact match for ID
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    $students = $query->get();
    return view('index', compact('students'));
}


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }


    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('update', compact('student'));
    }

    // Store new student
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'course' => 'required|string|max:255',
        ];

        $messages = [
            'name.required' => 'Need first name',
            'email.required' => 'Need email address',
            'course.required' => 'Please select a course',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Student::create($request->only(['name', 'email', 'course']));

        return redirect()->back()->with('success', 'Student saved successfully!');
    }

    // Update student
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'course' => 'required|string|max:255',
        ];

        $messages = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'course.required' => 'Course is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::findOrFail($id);
        $student->update($request->only(['name', 'email', 'course']));

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }



}