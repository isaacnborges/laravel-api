<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0){
            $data = [
                'status' => 200,
                'students' => $students
            ];
    
            return response()->json($data, 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'No records'
        ], 200);
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
                'status' => 201,
                'message' => "Successfully"
            ], 201);
        }

        return response()->json([
            'status' => 500,
            'message' => "Something went wrong"
        ], 500);
    }

    public function getById($id)
    {
        $student = Student::find($id);

        if ($student)
        {
            return response()->json([
                'status' => 200,
                'message' => $student
            ], 500);
        }

        return response()->json([
            'status' => 404,
            'message' => "Not found"
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
}
