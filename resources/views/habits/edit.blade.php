@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('habits.update', ['id' => $habit->id ]) }}">
                        @csrf

                        タスク名
                        <input type="text" name="habit_name" value="{{ $habit->habit_name }}">
                        <br>

                        <input class="btn btn-info" type="submit" value="更新する">
                    </form>

                    <form method="POST" action="{{ route('habits.destroy', ['id' => $habit->id ]) }}" id="delete_{{ $habit->id }}">
                        @csrf
                        <a href="#" class="btn btn-danger" data-id="{{ $habit->id }}" onclick="deletePost(this);">削除</a>
                    </form>

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
