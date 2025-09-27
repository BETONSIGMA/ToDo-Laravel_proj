<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if($request->has('status_filter')){
            if($request->status_filter == 'completed'){
                $query->where('completed', true);
            } elseif($request->status_filter == 'active'){
                $query->where('completed', false);
            }
        }
        
        if($request->has('date_filter') && $request->date_filter == 'asc'){
            $query->orderBy('created_at','asc');
        } else {
            $query->orderBy('created_at','desc');
        }

        $tasks=$query->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'completed'=> false,
        ]);

        return redirect()->route('tasks.index')
                        ->with('success','Задача создана ;)');
                        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if($task->user_id !== Auth::id()){
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if($task->user_id !== Auth::id()){
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
        return redirect()->route('tasks.index')
                ->with('success','Задача обновлена :)))');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача удалена :0');
    }

    public function toggle(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect()->route('tasks.index')->with('success', 'Статус обновлен :)');
    }
}
