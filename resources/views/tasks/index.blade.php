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

                        <table class="task_input">
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
                                                <option value="">既習慣を選択</option>
                                                @foreach($habits as $value)
                                                    <option value="{{ $value->id }}">{{ $value->habit_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- カテゴリー -->
                                        <td data-label="分類" class="txt">
                                            <select class="custom-select custom-select-md" name="cate_id">
                                                <option value="">カテゴリーを選択</option>
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

                    </div>

                </div>
            </div>



            <!-- タスク一覧 -->
            <div class="col-md-12">

                <div class="card mb-4">

                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/donguri.svg') }}" style="width: 20px;">タスク一覧</div>

                    <!-- 既習慣の編集 -->
                    <form method="GET" action="{{ route('habits.index') }}">
                        <button type="submit" class="btn btn-warning">既習慣編集</button>
                    </form>

                    <!-- カテゴリーの編集 -->
                    <form method="GET" action="{{ route('cates.index') }}">
                        <button type="submit" class="btn btn-warning">カテゴリー編集</button>
                    </form>


                    <div class="center-block" style="overflow: scroll;">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">タスク名</th>
                                    <th scope="col" style="width:20%">既習慣</th>
                                    <th scope="col" style="width:13%">カテゴリー</th>
                                    <th scope="col" style="width:20%">期限日</th>
                                    <th scope="col" style="width:7%">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todo as $value)
                                    <tr>
                                        <!-- <td><a href="{{ route('tasks.store', ['id' => $value->id ]) }}">完了{{ $value->status }}</a></td> -->

                                        <th class="task_name"><div class="">{{ $value->name }}</div></th>
                                        <td data-label="習慣" class="txt">{{ $value->habit_name }}</td>
                                        <td data-label="分類" class="txt"><div style="color:{{ $value->color_code }}">{{ $value->cate_name }}</div></td>

                                        @if($value->deadline)
                                            <td data-label="期限" class="txt">{{ $value->deadline }}</td>
                                        @else
                                            <td data-label="期限" class="txt">なし</td>
                                        @endif

                                        <td data-label="編集" class="txt"><a href="{{ route('tasks.edit', ['id' => $value->id ]) }}">Edit</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">完了済みタスク名</th>
                                    <th scope="col" style="width:20%">既習慣</th>
                                    <th scope="col" style="width:13%">カテゴリー</th>
                                    <th scope="col" style="width:20%">期限日</th>
                                    <th scope="col" style="width:7%">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($done_todo as $value)
                                    <tr>
                                        <!-- <td><a href="{{ route('tasks.store', ['id' => $value->id ]) }}">完了{{ $value->status }}</a></td> -->

                                        <th class="task_name"><div class="">{{ $value->name }}</div></th>
                                        <td data-label="習慣" class="txt">{{ $value->habit_name }}</td>
                                        <td data-label="分類" class="txt"><div style="color:{{ $value->color_code }}">{{ $value->cate_name }}</div></td>

                                        @if($value->deadline)
                                            <td data-label="期限" class="txt">{{ $value->deadline }}</td>
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