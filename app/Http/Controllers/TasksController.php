<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')->where('user_id', session('user_id'))->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(TasksRequest $request){
        $validateData = $request->validated();

        DB::table('tasks')->insert([
            'user_id'       => session('user_id'),
            'title'         => $validateData['title'],
            'description'   => $validateData['description'],
            'status'        => 'Pending',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->back()->with('success', 'Task berhasil ditambahkan');
    }

    public function show(string $id){
        $task = DB::table('tasks')->where('id', $id)->where('user_id', session('user_id'))->first();

        if(!$task){
            return response()->json([
                'success'   => false,
                'message'   => 'Task tidak ditemukan'
            ]);
        }

        return response()->json([
            'success'   => true,
            'data'      => $task
        ], 200);
    }
}
