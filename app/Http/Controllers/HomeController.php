<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = auth()->user()->tasks->sortby('execution_time');
        return view('home', compact('tasks'));
    }

    public function store(AddTaskRequest $addTaskRequest)
    {
        $attr = $addTaskRequest->all();
        auth()->user()->tasks()->create($attr);

        request()->session()->flash('success', 'Task added successfully');
        return redirect(route('home'));
    }

    public function edit(Task $task)
    {
        $task->execution_time = date('Y-m-d\TH:i:s', strtotime($task->execution_time));
        return json_encode($task);
    }

    public function update(Request $request, Task $task)
    {
        $attr = $request->all();

        $task->update($attr);

        request()->session()->flash('success', 'Task updated successfully');

        return redirect(route('home'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        request()->session()->flash('success', 'Task deleted successfully');
        return redirect(route('home'));
    }
}
