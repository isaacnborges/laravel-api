<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
    
        $this->applyFilters($query, $request);
    
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
    
        $perPage = max(1, min((int)$perPage, 100));
        $page = max(1, (int)$page);
    
        $students = $query->paginate($perPage, ['*'], 'page', $page);
    
        if ($students->count() > 0) {
            $formattedStudents = $this->formatStudents($students);
    
            $data = $this->formatResponseData($students, $formattedStudents);
    
            return response()->json($data, 200);
        }
    
        return response()->json([
            'status' => 404,
            'message' => 'No records'
        ], 200);
    }

    public function getById($id)
    {
        $student = Student::find($id);

        if ($student) {
            $formattedStudent = $this->formatStudent($student);

            return response()->json([
                'status' => 200,
                'student' => $formattedStudent,
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => "Not found"
        ], 500);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $student = Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if ($student) {
            return response()->json([
                'status' => 201
            ], 201);
        }

        return response()->json([
            'status' => 500,
            'message' => "Something went wrong"
        ], 500);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $student = Student::find($id);

        if ($student) {
            $student->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            return response()->json([
                'status' => 204,
            ], 204);
        }

        return response()->json([
            'status' => 500,
            'message' => "Something went wrong"
        ], 500);
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if ($student)
        {
            $student->delete();

            return response()->json([
                'status' => 204,
            ], 204);
        }

        return response()->json([
            'status' => 404,
            'message' => "Not found"
        ], 500);
    }

    private function applyFilters($query, $request)
    {
        if ($request->has('name')) {
            $query->where('name', $request->input('name'));
        }
    
        if ($request->has('course')) {
            $query->where('course', $request->input('course'));
        }

        if ($request->has('email')) {
            $query->where('email', $request->input('email'));
        }

        if ($request->has('phone')) {
            $query->where('phone', $request->input('phone'));
        }
    }
    
    private function formatStudents($students)
    {
        return $students->map(function ($student) {
            return $this->formatStudent($student);
        });
    }

    private function formatStudent($student)
    {
        return [
            'id' => $student->id,
            'name' => $student->name,
            'course' => $student->course,
            'email' => $student->email,
            'phone' => $student->phone,
        ];
    }
    
    private function formatResponseData($students, $formattedStudents)
    {
        return [
            'status' => 200,
            'students' => [
                'current_page' => $students->currentPage(),
                'data' => $formattedStudents,
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
            ]
        ];
    }
}
