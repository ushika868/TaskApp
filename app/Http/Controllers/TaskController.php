<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller {

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**     
     ** Fetch data for tasks list view
     ** @return \Illuminate\Http\Response     
    */
    public function index($sortingParam=null, $sortingValue=null) {
        try {
            $tasks = $this->taskService->getAllTasks($sortingParam, $sortingValue);
            return Inertia::render('Tasks/Index', ['tasks' => $tasks]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to render the tasks index page.'], 500);
        }
    }

    /**     
     ** Show the form for creating a new task.     
     ** @return \Illuminate\Http\Response   
    */
    public function create() {
        try {
            return Inertia::render('Tasks/Create');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to render the create page.'], 500);
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:255',Rule::unique('tasks'), ],
                'description' => ['required', 'string'],
            ]);            
            // Create a new task with the validated data
            Task::create($validatedData);
            return Redirect::route('tasks.index')->with('success', 'Task created successfully!');
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the task.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
    */
    public function edit(Task $task) {
        try {
            return Inertia::render('Tasks/Edit', ['task' => $task]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to render the edit page.'], 500);
        }
        
    }
    
    /**
     * Update the given task
     *
     * @param  int  $id The ID of the task to update.
     * @param  \Illuminate\Http\Request  $request The HTTP request containing the updated task data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the task index page after updating the task.
     */
    public function update($id, Request $request) {
        try {
            Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:255', Rule::unique('tasks')->ignore($id),], 
                'description' => ['required'], 
                'status' =>  ['required', Rule::in(['pending', 'in_progress', 'completed'])],
                'priority' =>  ['required','numeric'],
                ])->validate();
        
            Task::find($id)->update($request->all());
            return redirect()->route('tasks.index');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating the task.');
        }

    }


    /**
     * Remove the given task
     *
     * @param  int  $id The ID of the task to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the task index page after deleting the task.
     */
    public function destroy($id) {
        try {
            Task::find($id)->delete();
            return redirect()->route('tasks.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the task.');
        }
    }
}