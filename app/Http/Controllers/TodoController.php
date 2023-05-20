<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {

        $todos = Todo::when($request->has('query'), function($query) use($request) {
            $query->where('task', 'LIKE', '%' . $request->get('query') . '%');
        })
            ->paginate(10);

        return view('todo.index')->with(compact('todos'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        Todo::create($validated);

        return redirect()->back()->with('success', 'Task has been added');
    }

    public function show(Todo $todo)
    {
    }

    public function edit(Todo $todo)
    {
        return view('todo.edit')->with(compact('todo'));
    }

    public function update(UpdateRequest $request, Todo $todo)
    {
        $validated = $request->validated();

        $todo->update([
            'task' => $validated['task'],
            'is_completed' => isset($validated['is_completed']) && $validated['is_completed'] == 1
        ]);

        return redirect()->back()->with('success', 'Task has been updated');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back()->with('success', 'Task has been deleted');
    }
}
