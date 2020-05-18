<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
use App\Http\Requests\StoreHabit;

use App\Models\Habit;
use App\Models\Cate;
use App\Models\Task;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $task_name = Habit::find(1)->task->name;
        // dd($task_name);

        $habits = DB::table('habits')->get();
        
        $habits = Habit::all(); // DBのデータを全て持ってこれる

        return view('habits.index', compact('habits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('habits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHabit $request)
    {
        //
        $habit = new Habit;

        $habit->habit_name = $request->input('habit_name');

        $habit->save(); // saveというメソッドで保存
        return redirect('habits/index'); // 最初の画面に戻す
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
        $habit = Habit::find($id);

        // $habit_id = DB::table('habits')
        // ->where('habit_id', $id)
        // ->get();

        // $habit_id = Task::find($id)->habit->habit_id;

        // $habit = Habit::find($habit_id);
        // dd($id);

        return view('habits.edit', compact('habit'));
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
        $habit = Habit::find($id);

        $habit->habit_name = $request->input('habit_name');
        $habit->save(); // saveというメソッドで保存

        return redirect('habits/index'); // 最初の画面に戻す
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
        $habit = Habit::find($id);
        $habit->delete();

        return redirect('habits/index'); // 最初の画面に戻す
    }
}
