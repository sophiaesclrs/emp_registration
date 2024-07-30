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
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employee',
            'profile_picture' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');
        } else {
            return redirect()->back()->withErrors(['profile_picture' => 'File upload failed']);
        }

        $employee = new Employee();
        $employee->full_name = $validatedData['full_name'];
        $employee->email = $validatedData['email'];
        $employee->profile_picture = $filePath;
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
