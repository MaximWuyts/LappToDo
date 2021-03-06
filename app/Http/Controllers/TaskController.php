<?php

namespace App\Http\Controllers;

/** add class **/
use App\Task;
use Session;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id','desc')->get();
        return view('tasks.index')->with('createdTasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* error handling */
        $this->validate($request, [
            'newTaskName' => 'required|min:5|max:255',
            'newDeadline' => 'required',
        ]);

        $task = new Task;
        $task->name = $request->newTaskName;
        $task->deadline = $request->newDeadline;
        $task->save();

        Session::flash('success','Your task has been successfully added!');
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('currentTaskEdit',$task);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'editedTaskName' => 'required|min:5|max:255',
            'editedTaskDate' => 'required',
        ]);
        
        $task = Task::find($id);
        $task->name = $request->editedTaskName;
        $task->deadline = $request->editedTaskDate;
        $task->save();

        Session::flash('success', 'Your task has been succesfully edited!');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        Session::flash('success', 'Your tasks has been succesfully removed!');
        
        return redirect()->back();
    }

    public function taskDone($id)
    {
        $task = Task::find($id);
        $task->done = true;
        $task->save();

        Session::flash('success','Your task has been successfully completed!');

        return redirect()->back();
    }
}
