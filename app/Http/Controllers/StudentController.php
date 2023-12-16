<?php

namespace App\Http\Controllers;

use App\Services\StudentServices;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentService;

    public function __construct(StudentServices $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students);
    }

    public function show($id)
    {
        $student = $this->studentService->getStudent($id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|integer',
            'email' => 'required',
        ]);

        $createdStudent = $this->studentService->createStudent($data);

        return response()->json($createdStudent, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|integer',
            'email' => 'required',
        ]);

        $updatedStudent = $this->studentService->updateStudent($id, $data);

        return response()->json($updatedStudent);
    }

    public function destroy($id)
    {
        $this->studentService->deleteStudent($id);
        return response()->json(['message' => 'Student deleted successfully']);
    }
    public function enroll($studentId, $courseId)
    {
        $this->studentService->enrollStudent($studentId, $courseId);
        return response()->json(['message' => 'Student enrolled successfully']);
    }
    public function getEnrolledCourses($studentId)
    {
        $enrolledCourses = $this->studentService->getEnrolledCourses($studentId);

        return response()->json($enrolledCourses);
    }
}