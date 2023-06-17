<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    use SearchTrait;

    private const SUCCESS_REDIRECT_ROUTE_NAME = "departments.index"; 

    public function index()
    {
        $departments = Department::withCount('employees')->withSum('employees','salary')->paginate(20);
        return view('departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', Rule::unique('departments','title')],
            'description' => 'nullable',
        ]);

        try{
            Department::create($validatedData);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Department Created Successfully');
        }catch(\Exception $e){
            // throw new \Exception('Error in storing.');
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request, Department $department )
    {
        $validatedData = $request->validate([
            'title' => ['required', Rule::unique('departments','title')->ignore($department->id)],
            'description' => 'nullable',
        ]);

        try{
            $department->update($validatedData);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Department Created Successfully');
        }catch(\Exception $e){
            throw new \Exception('Error in updating.');
        }
    }

    public function destroy(Department $department)
    {
        try{
            $department->delete();
            session()->flash('success', 'Deleted sucessfully!'); 
        }catch(\Exception $e){
            session()->flash('error', 'Error in deleting.');
        }
    }

    public function search(Request $request)
    {
        $this->searchModel = "Department";
        $this->searchCol = "title";
        $this->searchKey = $request->input('search_key');

        try{
            $departments = $this->getSearchResult();
            $departments = $departments->withCount('employees')->withSum('employees','salary')->get();
            $html = view('departments.search-result', compact('departments'))->render();
            return response()->json([
                'html' => $html
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    
}
