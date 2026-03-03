<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    public function index() { $employees = Employee::paginate(10); return view('admin.employees.index', compact('employees')); }
    public function store(Request $r) { Employee::create($r->all()); return back()->with('success', 'Employee added'); }
    public function destroy(Employee $employee) { $employee->delete(); return back()->with('success', 'Employee deleted'); }
}
