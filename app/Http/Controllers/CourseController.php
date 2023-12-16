<?php

namespace App\Http\Controllers;

use App\Services\CourseServices;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $courseService;

    public function __construct(CourseServices $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json($courses);
    }

    public function show($id)
    {
        $course = $this->courseService->getCourse($id);
        return response()->json($course);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        $createdCourse = $this->courseService->createCourse($data);

        return response()->json($createdCourse, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        $updatedCourse = $this->courseService->updateCourse($id, $data);

        return response()->json($updatedCourse);
    }

    public function destroy($id)
    {
        $this->courseService->deleteCourse($id);
        return response()->json(['message' => 'Course deleted successfully']);
    }
    public function getEnrolledStudents($courseId)
    {
        $enrolledCourses = $this->courseService->getEnrolledStudents($courseId);

        return response()->json($enrolledCourses);
    }
}