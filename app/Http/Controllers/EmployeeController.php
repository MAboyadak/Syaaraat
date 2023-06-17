<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Repository\EmployeeRepository;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use SearchTrait;

    private const SUCCESS_REDIRECT_ROUTE_NAME = "employees.index"; 
    private $empRepo;

    public function __construct(EmployeeRepository $empRepo)
    {
        $this->empRepo = $empRepo;
    }

    public function index()
    {
        $employees   = Employee::where('role', 'employee')->paginate(20);
        $managers    = Employee::where('role', 'manager')->get();
        $departments = Department::get();
        return view('employees.index', compact('employees', 'managers', 'departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        try{
            $this->empRepo->store($validatedData);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Employee Created Successfully');
        }catch(\Exception $e){
            if(isset($validatedData['image'])){
                unlink(public_path('uploads/' . $validatedData['first_name'] . $validatedData['phone'] . '.' . $validatedData['image']->extension()));
            }
            // throw new \Exception('Error in storing.');
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        try{
            $this->empRepo->update($validatedData, $employee);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Employee Updated Successfully');
        }catch(\Exception $e){
            if(isset($validatedData['image'])){
                unlink(public_path('uploads/' . $validatedData['first_name'] . $validatedData['phone'] . '.' . $validatedData['image']->extension()));
            }
            // throw new \Exception($e->getMessage());

            throw new \Exception('Error in updating.');
        }
    }

    public function destroy(Employee $employee)
    {
        try{
            $this->empRepo->destroy($employee);
            session()->flash('success', 'Deleted sucessfully!'); 
        }catch(\Exception $e){
            session()->flash('error', 'Error in deleting.');
        }
    }

    public function search(Request $request)
    {
        $this->searchModel = "Employee";
        $this->searchCol = "first_name";
        $this->searchKey = $request->input('search_key');

        try{
            $employees = $this->getSearchResult('manager')->get();
            $html = view('employees.search-result', compact('employees'))->render();
            return response()->json([
                'html' => $html
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
