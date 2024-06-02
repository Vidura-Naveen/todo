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
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $data = TodoCrud::create($validation);
        if ($data) {
            session()->flash('success', 'Product Add Successfully');
            return redirect(route('/todolist'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('/todolist'));
        }
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
            return redirect(route('/todolist'));
        }
    }
}
