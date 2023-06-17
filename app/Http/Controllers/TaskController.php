<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    use SearchTrait;

    private const SUCCESS_REDIRECT_ROUTE_NAME = "tasks.index"; 

    public function index()
    {
        $tasks      = Task::paginate(20);
        $employees  = auth()->user()->employees;
        return view('tasks.index', compact('tasks', 'employees'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'title'         => ['required', Rule::unique('tasks','title')],
            'description'   => 'nullable',
            'employee_id'   => 'required',
        ]);

        try{
            Task::create($validatedData);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Task Created Successfully');
        }catch(\Exception $e){
            // throw new \Exception('Error in storing.');
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request, Task $task )
    {
        $validatedData = $request->validate([
            'title'         => ['required', Rule::unique('tasks','title')->ignore($task->id)],
            'description'   => 'nullable',
            'status'        => 'required',
        ]);

        try{
            
            if($validatedData['status'] == 0){
                $validatedData['status'] = 'active';
            }

            $task->update($validatedData);
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME)->with('success', 'Task Updated Successfully');
        }catch(\Exception $e){
            throw new \Exception('Error in updating.');
        }
    }

    public function destroy(Task $task)
    {
        try{
            $task->delete();
            session()->flash('success', 'Deleted sucessfully!'); 
        }catch(\Exception $e){
            session()->flash('error', 'Error in deleting.');
        }
    }

    public function search(Request $request)
    {
        $this->searchModel = "Task";
        $this->searchCol = "title";
        $this->searchKey = $request->input('search_key');

        try{
            $tasks = $this->getSearchResult('employee')->get();
            $html = view('tasks.search-result', compact('tasks'))->render();
            return response()->json([
                'html' => $html
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
