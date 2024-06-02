<?php

namespace App\Http\Controllers;

use App\Models\TodoCrud;
use Illuminate\Http\Request;

class TodoCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todopass = TodoCrud::orderBy('id', 'desc')->get();
        $total = TodoCrud::count();
        return view('todo.index', compact(['todopass', 'total']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $data = TodoCrud::create($validation);
        if ($data) {
            session()->flash('success', ' Add Successfully');
            return redirect(route('todolistindex'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('todolistindex'));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create a new todo item with default status
        $todo = new TodoCrud();
        $todo->title = $validatedData['title'];
        $todo->status = 0; // Set default status
        $todo->description = 'default description';
        $todo->save();

        // Redirect back or do any other response as needed
        return redirect()->back()->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoCrud $todoCrud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoCrud $todoCrud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoCrud $todoCrud ,$id)
    {
        $todo = TodoCrud::findOrFail($id);
        $todo->status = $todo->status == 1 ? 0 : 1;
        $todo->save();
        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoCrud $todoCrud ,$id)
    {
        // dd($id);
        $todo = TodoCrud::findOrFail($id)->delete();
        if ($todo) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('/todolistindex'));
        }
    }
}
