@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id ]) }}">
                        @csrf

                        タスク名
                        <input type="text" name="name" value="{{ $task->name }}">
                        <br>
                        既習慣
                        <select name="habit_id">
                            @foreach($habit_list as $value)

                                @if($value->id === $task->habit_id)
                                    <option value="{{ $value->id }}" selected>{{ $value->habit_name }}</option>
                                @else
                                    <option value="{{ $value->id }}">{{ $value->habit_name }}</option>
                                @endif

                            @endforeach
                        </select>
                        <br>
                        カテゴリー
                        <select name="cate_id">
                            @foreach($cate_list as $value)

                                @if($value->id === $task->cate_id)
                                    <option value="{{ $value->id }}" selected>{{ $value->cate_name }}</option>
                                @else
                                    <option value="{{ $value->id }}">{{ $value->cate_name }}</option>
                                @endif

                            @endforeach
                        </select>
                        <br>
                        期限日
                        <input type="datetime-local" name="deadline" value="{{ date('Y-m-d\TH:i', strtotime($task->deadline)) }}">
                        <br>
                        状態
                        <select name="status">
                            <option value="0" @if($task->status === "0") selected @endif>未完了</option>
                            <option value="1" @if($task->status === "1") selected @endif>完了</option>
                        </select>



                        <input class="btn btn-info" type="submit" value="更新する">
                    </form>

                    <form method="POST" action="{{ route('tasks.destroy', ['id' => $task->id ]) }}" id="delete_{{ $task->id }}">
                        @csrf
                        <a href="#" class="btn btn-danger" data-id="{{ $task->id }}" onclick="deletePost(this);">削除</a>
                    </form>




                    <button id="square_btn" onClick="history.back()">戻る</button>

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

@endsection
