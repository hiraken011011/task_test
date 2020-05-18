<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
use App\Http\Requests\StoreTask;

use App\Models\Habit;
use App\Models\Cate;
use App\Models\Task;
use App\Models\Color;

class TaskController extends Controller
{
    public function index()
    {
        // $habit_id = Task::all()->habit->id;
        // $cate_id = Task::find($id)->cate->id;

        $habits = DB::table('habits')->get();
        $cates = DB::table('cates')->get();

        // // 状態が "1" のタスクを取得。
        $todo = DB::table('tasks')
        ->where('status', '0')
        ->leftJoin('habits', 'tasks.habit_id', '=', 'habits.id')
        ->leftJoin('cates', 'tasks.cate_id', '=', 'cates.id')
        ->leftJoin('colors', 'cates.color_id', '=', 'colors.id')
        ->select(
            'tasks.id as id',
            'name',
            'deadline',
            'status',
            'habit_id',
            'cate_id',
            'tasks.created_at as created_at',
            'habits.id as habits_table_id',
            'habit_name',
            'cates.id as cate_table_id',
            'cate_name',
            'cates.color_id',
            'color_code')
        ->get();

        // // 状態が "1" のタスクを取得。
        $done_todo = DB::table('tasks')
        ->where('status', '1')
        ->leftJoin('habits', 'tasks.habit_id', '=', 'habits.id')
        ->leftJoin('cates', 'tasks.cate_id', '=', 'cates.id')
        ->leftJoin('colors', 'cates.color_id', '=', 'colors.id')
        ->select(
            'tasks.id as id',
            'name',
            'deadline',
            'status',
            'habit_id',
            'cate_id',
            'tasks.created_at as created_at',
            'habits.id as habits_table_id',
            'habit_name',
            'cates.id as cate_table_id',
            'cate_name',
            'cates.color_id',
            'color_code')
        ->get();
        
        return view('tasks.index', compact('habits','cates','todo','done_todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create'); // .の前がフォルダ、.の後がファイル名。つまり contact/create.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        //
        // $habit_id = Task::find($id)->habit->id;
        // $cate_id = Task::find($id)->cate->id;


        $task = new Task;

        $task->status = $request->input('status');
        $task->name = $request->input('name');
        $task->habit_id = $request->input('habit_id');
        $task->cate_id = $request->input('cate_id');
        $task->deadline = $request->input('deadline');

        $task->save(); // saveというメソッドで保存
        return redirect('tasks/index'); // 最初の画面に戻す
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        // {{ $task->habit_id }}と一致する名前

        $habit_list = Habit::all();
        $cate_list = Cate::all();

        return view('tasks.edit', compact('task', 'habit_list', 'cate_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::find($id);

        $task->name = $request->input('name');
        $task->deadline = $request->input('deadline');
        $task->status = $request->input('status'); // formのデータを持ってくる
        $task->habit_id = $request->input('habit_id');
        $task->cate_id = $request->input('cate_id');

        $task->save(); // saveというメソッドで保存


        return redirect('tasks/index'); // 最初の画面に戻す
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
        $task = Task::find($id);
        $task->delete();

        return redirect('tasks/index'); // 最初の画面に戻す
    }
}
