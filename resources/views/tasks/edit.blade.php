@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-top:65px">

            <div class="card">

                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/donguri.svg') }}" style="width: 20px;">タスク編集</div>

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
                                    <th scope="col" style="width:17%">カテゴリー</th>
                                    <th scope="col" style="width:30%">期限日</th>
                                    <th scope="col" style="width:18%">状態</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form class="form-inline rounded border p-3" method="POST" action="{{ route('tasks.update', ['id' => $task->id ]) }}">
                                    @csrf
                                    <tr>
                                        <!-- タスク -->
                                        <td data-label="タスク" class="txt"><input type="text" name="name" class="form-control input-md form-inline" placeholder="タスク名を入力" style="height: 37px;" value="{{ $task->name }}" /></td>
                                        <!-- 既習慣 -->
                                        <td data-label="習慣" class="txt">
                                            <select class="custom-select custom-select-md" name="habit_id">
                                                @foreach($habit_list as $value)
                                                    @if($value->id === $task->habit_id)
                                                        <option value="{{ $value->id }}" selected>{{ $value->habit_name }}</option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->habit_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- カテゴリー -->
                                        <td data-label="分類" class="txt">
                                            <select class="custom-select custom-select-md" name="cate_id">

                                                @foreach($cate_list as $value)
                                                    @if($value->id === $task->cate_id)
                                                        <option value="{{ $value->id }}" selected>{{ $value->cate_name }}</option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->cate_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- 期限日 -->
                                        <td data-label="期限" class="txt">
                                            <div class="flatpickr form-inline">
                                                <input name="deadline" value="{{ date('Y-m-d\TH:i', strtotime($task->deadline)) }}" type="text" class="deadline form-control bg-white text-secondary" placeholder="期限日を記入" data-input style="height:39px; width:90%">
                                                <a class="input-button" style="float:left; width:10%;" title="clear" data-clear><i class="material-icons">clear</i></a><!-- クリアボタン -->
                                            </div>
                                        </td>
                                        <!-- 状態 -->
                                        <td data-label="状態" class="txt">
                                            <select class="custom-select custom-select-md" name="status">
                                                <option value="0" @if($task->status === "0") selected @endif>未完了</option>
                                                <option value="1" @if($task->status === "1") selected @endif>完了</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- ボタン -->
                            <table class="task_input" style="width:500px; margin-top:0px; border:0px none;">
                                <tbody>
                                    <tr style="border:0px none;">
                                        <!-- 登録 -->
                                        <td data-label="登録" class="txt" style="border:0px none;">
                                            <input class="btn btn-info" type="submit" value="更新する">
                                        </td>
                                    </form>
                                        <!-- 削除 -->
                                        <td data-label="削除" class="txt" style="border:0px none;">
                                            <form method="POST" action="{{ route('tasks.destroy', ['id' => $task->id ]) }}" id="delete_{{ $task->id }}">
                                                @csrf
                                                <a href="#" class="btn btn-danger" data-id="{{ $task->id }}" onclick="deletePost(this);">削除する</a>
                                            </form>
                                        </td>
                                        <!-- 戻る -->
                                        <td data-label="戻る" class="txt" style="border:0px none;">
                                            <input class="btn btn-primary" type="submit" onClick="history.back()" value="戻る">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// 確認
function deletePost(e) {
    'use strict';
    if(confirm('本当に削除してもよろしいですか？')){
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}
</script>

<script>
    const config = {
    enableTime: true,
    wrap: true,
    dateFormat: "Y-m-d H:i",
    }
    flatpickr('.flatpickr', config);
</script>

@endsection
