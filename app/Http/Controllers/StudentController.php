<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students (JSON or HTML)
    public function index(Request $request)
    {
        $students = Student::all();

        if ($request->wantsJson()) {
            return response()->json($students);
        }

        return view('students.index', compact('students'));
    }

    // Show form to create a student
    public function create()
    {
        return view('students.create');
    }

    // Show form to edit a student
    public function edit($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect('/students')->with('error', 'Student not found');
        }

        return view('students.edit', compact('student'));
    }

    // Store a new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'borrowed_books' => 'nullable|string',
        ]);

        $books = [];
        if (!empty($validatedData['borrowed_books'])) {
            $books = array_filter(array_map('trim', explode(',', $validatedData['borrowed_books'])));
        }

        $student = Student::create([
            'name' => $validatedData['name'],
            'class' => $validatedData['class'],
            'borrowed_books' => $books,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student created successfully', 'student' => $student]);
        }

        return redirect('/students')->with('success', 'Student created successfully');
    }

    // Update an existing student
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'borrowed_books' => 'nullable|string',
        ]);

        $student = Student::find($id);

        if (!$student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student not found'], 404);
            }
            return redirect('/students')->with('error', 'Student not found');
        }

        $books = [];
        if (!empty($validatedData['borrowed_books'])) {
            $books = array_filter(array_map('trim', explode(',', $validatedData['borrowed_books'])));
        }

        $student->update([
            'name' => $validatedData['name'],
            'class' => $validatedData['class'],
            'borrowed_books' => $books,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
        }

        return redirect('/students')->with('success', 'Student updated successfully');
    }

    // Delete a student
    public function destroy(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student not found'], 404);
            }
            return redirect('/students')->with('error', 'Student not found');
        }

        $student->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student deleted successfully']);
        }

        return redirect('/students')->with('success', 'Student deleted successfully');
    }
}