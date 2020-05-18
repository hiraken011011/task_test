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

                    <form method="POST" action="{{ route('cates.update', ['id' => $cate->id ]) }}">
                        @csrf

                        カテゴリー名
                        <input type="text" name="cate_name" value="{{ $cate->cate_name }}">
                        <br>

                        カテゴリーカラー
                        <select name="color_id">
                            @foreach($color_list as $value)

                                @if($value->id === $cate->color_id)
                                    <option value="{{ $value->id }}" selected>{{ $value->color_name }}</option>
                                @else
                                    <option value="{{ $value->id }}">{{ $value->color_name }}</option>
                                @endif

                            @endforeach
                        </select>

                        <input class="btn btn-info" type="submit" value="更新する">
                    </form>

                    <form method="POST" action="{{ route('cates.destroy', ['id' => $cate->id ]) }}" id="delete_{{ $cate->id }}">
                        @csrf
                        <a href="#" class="btn btn-danger" data-id="{{ $cate->id }}" onclick="deletePost(this);">削除</a>
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
