@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-top:65px">

            <div class="card mb-4">
                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/happa.svg') }}" style="width: 20px;">タスク登録</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- バリデーションのエラー表示部分 -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="center-block" style="overflow: scroll;">

                        <table class="task_input" style="margin-bottom:0px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:35%">タスク名</th>
                                    <th scope="col" style="width:25%">既習慣</th>
                                    <th scope="col" style="width:20%">カテゴリー</th>
                                    <th scope="col" style="width:30%">期限日</th>
                                    <th scope="col" style="width:15%">登録</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form class="form-inline rounded border p-3" method="POST" action="{{route('tasks.store')}}" style=" background-color:#F6F2FC;">
                                    @csrf
                                    <tr>
                                        <!-- タスク -->
                                        <td data-label="タスク" class="txt"><input type="text" name="name" class="form-control input-md form-inline" placeholder="タスク名を入力" style="height: 37px;" /></td>
                                        <!-- 既習慣 -->
                                        <td data-label="習慣" class="txt">
                                            <select class="custom-select custom-select-md" name="habit_id">
                                                <option value="">---選択---</option>
                                                @foreach($habits as $value)
                                                    <option value="{{ $value->id }}">{{ $value->habit_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- カテゴリー -->
                                        <td data-label="分類" class="txt">
                                            <select class="custom-select custom-select-md" name="cate_id">
                                                <option value="">---選択---</option>
                                                @foreach($cates as $value)
                                                    <option value="{{ $value->id }}">{{ $value->cate_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- 期限日 -->
                                        <td data-label="期限" class="txt">
                                            <div class="flatpickr form-inline">
                                                <input name="deadline" value="" type="text" class="deadline form-control bg-white text-secondary" placeholder="期限日を記入" data-input style="height:39px; width:90%">
                                                <a class="input-button" style="float:left; width:10%;" title="clear" data-clear><i class="material-icons">clear</i></a><!-- クリアボタン -->
                                            </div>
                                        </td>
                                        <!-- 完了/未完了 -->
                                        <input type="hidden" name="status" value="0">
                                        <!-- ボタン -->
                                        <td data-label="ボタン" class="txt">
                                            <div class="text-center"><input class="btn btn-info" type="submit" value="登録"></div>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    
                        <!-- ボタン -->
                        <table class="task_input" style="width:500px; margin-top:0px; border:0px none;">
                            <tbody>
                                <tr style="border:0px none;">
                                    <!-- 既習慣の編集 -->
                                    <td data-label="既習慣編集" class="txt" style="border:0px none;">
                                        <form method="GET" action="{{ route('habits.index') }}">
                                            <button type="submit" class="btn btn-warning">既習慣編集</button>
                                        </form>
                                    </td>

                                    <!-- カテゴリーの編集 -->
                                    <td data-label="カテゴリー編集" class="txt" style="border:0px none;">
                                        <form method="GET" action="{{ route('cates.index') }}">
                                            <button type="submit" class="btn btn-warning">カテゴリー編集</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    </div>
                </div>
            </div>


            <!-- タスク一覧 -->
            <div class="col-md-12">

                <div class="card mb-4">

                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/donguri.svg') }}" style="width: 20px;">タスク一覧</div>

                    <div class="card-body">

                    <div class="center-block" style="overflow: scroll;">
                        <!--未完了 -->
                        <!-- <div class="border-bottom" style="font-size:14px; color:#858585; padding:20px 0px 10px 30px;">未完了 ToDo</div> -->
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            タスク名
                                            @if($name_order === "desc")
                                                <button type="submit" name="name_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="name_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:20%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            既習慣
                                            @if($habit_order === "desc")
                                                <button type="submit" name="habit_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="habit_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:13%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            カテゴリ-
                                            @if($cate_order === "desc")
                                                <button type="submit" name="cate_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="cate_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:20%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            期限日
                                            @if($order === "desc")
                                                <button type="submit" name="order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:7%">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todo as $value)
                                    <tr>
                                        <!-- <td><a href="{{ route('tasks.store', ['id' => $value->id ]) }}">完了{{ $value->status }}</a></td> -->

                                        <th class="task_name">
                                        <div style="padding-left:10px;"><img class="pb-1 mr-3" alt="どんぐりアイコン" src="{{ asset('/images/donguri_task.svg') }}" style="width:15px;">{{ $value->name }}</div>
                                        </th>

                                        <!-- 習慣 -->
                                        @if($value->habit_name)
                                            <td data-label="習慣" class="txt">{{ $value->habit_name }}</td>
                                        @else
                                            <td data-label="習慣" class="txt">なし</td>
                                        @endif

                                        <!-- カテゴリー -->
                                        @if($value->cate_name)
                                            <td data-label="分類" class="txt"><div style="color:{{ $value->color_code }}">{{ $value->cate_name }}</div></td>
                                        @else
                                            <td data-label="分類" class="txt">なし</td>
                                        @endif

                                        <!-- 期限 -->
                                        @if($value->deadline)
                                            <td data-label="期限" class="txt">{{ date('Y年 n月j日', strtotime($value->deadline)) }}<br>{{ date('G:i', strtotime($value->deadline)) }}</td>
                                        @else
                                            <td data-label="期限" class="txt">なし</td>
                                        @endif

                                        <td data-label="編集" class="txt"><a href="{{ route('tasks.edit', ['id' => $value->id ]) }}">Edit</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                        <!--完了済み -->
                        <div class="border-bottom" style="width:250px; font-size:14px; color:#858585; padding:20px 0px 10px 30px;">完了済み ToDo</div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            タスク名
                                            @if($name_order === "desc")
                                                <button type="submit" name="name_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="name_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:20%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            既習慣
                                            @if($habit_order === "desc")
                                                <button type="submit" name="habit_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="habit_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:13%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            カテゴリ
                                            @if($cate_order === "desc")
                                                <button type="submit" name="cate_order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="cate_order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:20%">
                                        <form method="GET" action="{{ route('tasks.index') }}">
                                            期限日
                                            @if($order === "desc")
                                                <button type="submit" name="order" value="asc">▼</button>
                                            @else
                                                <button type="submit" name="order" value="desc">▲</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th scope="col" style="width:7%">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($done_todo as $value)
                                    <tr>
                                        <!-- <td><a href="{{ route('tasks.store', ['id' => $value->id ]) }}">完了{{ $value->status }}</a></td> -->

                                        <th class="task_name"><div style="padding-left:10px;">
                                        <img class="pb-1 mr-3" alt="どんぐりアイコン" src="{{ asset('/images/donguri_task.svg') }}" style="width:15px;">{{ $value->name }}</div></th>

                                        <!-- 習慣 -->
                                        @if($value->habit_name)
                                            <td data-label="習慣" class="txt">{{ $value->habit_name }}</td>
                                        @else
                                            <td data-label="習慣" class="txt">なし</td>
                                        @endif

                                        <!-- カテゴリー -->
                                        @if($value->cate_name)
                                            <td data-label="分類" class="txt"><div style="color:{{ $value->color_code }}">{{ $value->cate_name }}</div></td>
                                        @else
                                            <td data-label="分類" class="txt">なし</td>
                                        @endif

                                        <!-- 期限 -->
                                        @if($value->deadline)
                                            <td data-label="期限" class="txt">{{ date('Y年 n月j日', strtotime($value->deadline)) }}<br>{{ date('G:i', strtotime($value->deadline)) }}</td>
                                        @else
                                            <td data-label="期限" class="txt">なし</td>
                                        @endif

                                        <td data-label="編集" class="txt"><a href="{{ route('tasks.edit', ['id' => $value->id ]) }}">Edit</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const config = {
    enableTime: true,
    wrap: true,
    dateFormat: "Y-m-d H:i",
    }
    flatpickr('.flatpickr', config);
</script>

@endsection