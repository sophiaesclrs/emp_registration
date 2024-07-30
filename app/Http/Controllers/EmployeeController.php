<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function registerEmp(Request $request)
    {
        $validatedData = $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:150', // Assuming maximum age is 150
            'birth' => 'required|date',
            'phone' => 'nullable|digits_between:10,15', // Assuming phone number can be between 10 to 15 digits
            'email' => 'required|email|unique:employees,email',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'work_position' => 'required|string|max:255',
            'type_of_work' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        // Handle the file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');
        } else {
            return redirect()->back()->withErrors(['profile_picture' => 'File upload failed']);
        }

        $employee = new Employee();
        $employee->profile_picture = $filePath;
        $employee->full_name = $validatedData['full_name'];
        $employee->age = $validatedData['age'];
        $employee->birth = $validatedData['birth'];
        $employee->phone = $validatedData['phone'];
        $employee->email = $validatedData['email'];
        $employee->gender = $validatedData['gender'];
        $employee->status = $validatedData['status'];
        $employee->work = $validatedData['work'];
        $employee->type = $validatedData['type'];
        $employee->address = $validatedData['address'];
        $employee->save();

    }

    public function getEmployees(){
        $employees = Employee::all();
        return response()->json(['employees'=>$employees]);
    }

    public function updateEmployee($id){
        $emp = Employee::where('id', $id)->get();
        return view('update-emp', ['emp'=>$emp]);
    }

    public function updateEmp(Request $request){
        $emp = Employee::find($request->id);
        $emp->full_name = $request->full_name;
        $emp->email = $request->email;

        if($request->file('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName = time().''.$file->getClientOriginalName();
            $filePath = $file->storeAs('updated_pictures', $fileName, 'public');

            $emp->profile_picture = $filePath;
        }
        
        $emp->save();
    }

    public function deleteEmp($id){
        Employee::where('id',$id)->delete();
    }
}