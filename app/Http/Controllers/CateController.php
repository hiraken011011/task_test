<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
use App\Http\Requests\StoreCate;

use App\Models\Habit;
use App\Models\Cate;
use App\Models\Task;
use App\Models\Color;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cates = DB::table('cates')->get();
        
        $colors = Color::all(); // DBのデータを全て持ってこれる
        
        $cates = DB::table('cates')
        ->leftJoin('colors', 'cates.color_id', '=', 'colors.id')
        ->select(
            'cates.id as id',
            'cate_name',
            'color_id',
            'colors.id as color_table_id',
            'color_code',
            'color_name')
        ->get();

        return view('cates.index', compact('cates', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCate $request)
    {
        //
        $cate = new Cate;

        $cate->cate_name = $request->input('cate_name');
        $cate->color_id = $request->input('color_id');

        $cate->save(); // saveというメソッドで保存
        return redirect('cates/index'); // 最初の画面に戻す
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
        $cate = Cate::find($id);

        $color_list = Color::all();

        return view('cates.edit', compact('cate', 'color_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCate $request, $id)
    {
        //
        $cate = Cate::find($id);

        $cate->cate_name = $request->input('cate_name');
        $cate->color_id = $request->input('color_id');
        $cate->save(); // saveというメソッドで保存

        return redirect('cates/index'); // 最初の画面に戻す
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
        $cate = Cate::find($id);
        $cate->delete();

        return redirect('cates/index'); // 最初の画面に戻す
    }
}
