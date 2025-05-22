<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Log;

class manageEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emp = Employee::paginate(4);
        return view('employeelist')->with('emp', $emp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $totalEmp = Employee::all()->count();
        return view('addemployee', compact('totalEmp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->employeeID = $request->input('employeeID');
        $employee->firstname = $request->input('firstname');
        $employee->middlename = $request->input('middlename') ?? null; // Default to null if not provided
        $employee->lastname = $request->input('lastname');
        $employee->address = $request->input('address');
        $employee->contact_no = $request->input('contact_no');
        
        if ($request->hasFile('employee_picture')) {
            $image = $request->file('employee_picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $filename);
            $employee->image_path = 'images/' . $filename;
        }
        
        $employee->save();

        $msg = "Employee " . $employee->employeeID . ":" . $employee->firstname . " " . $employee->lastname . " is Added!";
        Log::info($msg);

        return redirect()->route('employeelist')->with('success', 'Employee ' . $employee->employeeID . ' added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employeeinfo')->with('emp', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);

        // Return the edit view with the employee data
        return view('editemployee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'employeeID' => 'required|string|max:255',
            'firstname' => 'string|max:255|min:2',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255|min:2',
            'address' => 'required|string',
            'contact_no' => 'required|string|max:15',
        ]);


        $employee->fill($validatedData);

        // Check if any fields were actually changed
        if (!$employee->isDirty()) {
            return redirect()
                ->route('employeelist')
                ->with('info', 'No changes were made.');
        }

        // 'employees.edit', $employee->id

        // Save changes
        $employee->save();

        $msg = "Employee " . $employee->employeeID . " is Updated!";
        Log::notice($msg);

        return redirect()
            ->route('employeelist', $employee->id)
            ->with('success', 'Employee ' . $employee->employeeID . ' updated successfully!');
    }

    // Use validated data for mass assignment
    // $employee->update($validatedData);

    // return redirect()->route('employeelist')->with('success', 'Employee with ID ' . $employee->employeeID . ' updated successfully.');

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the employee by ID
        $employee = Employee::find($id);
        if ($employee) {
            // Delete the employee
            $employee->delete();
            $msg = "Employee " . $employee->employeeID . " is Deleted!";
            Log::alert($msg);
            // Redirect to the employee list with a success message
            return redirect()->route('employeelist')->with('success', 'Employee ' . $employee->employeeID . ' deleted successfully.');
        } else {
            // If employee not found, redirect back with an error message
            return redirect()->route('employeelist')->with('error', 'Employee not found.');
        }
    }

}
