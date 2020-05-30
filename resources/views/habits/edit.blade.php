@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-top:65px">
            <div class="card">

                <div class="card-header"><img class="pb-1 mr-2" src="{{ asset('/images/donguri.svg') }}" style="width: 20px;">既習慣編集</div>

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

                <div class="center-block" style="overflow:scroll;">
                    
                    <table class="habit_input" style="margin-bottom:0px;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:70%">既習慣名</th>
                                <th scope="col" style="width:30%">編集</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form class="form-inline rounded border p-3" method="POST" action="{{ route('habits.update', ['id' => $habit->id ]) }}">
                                @csrf
                                <tr>
                                    <!-- 既習慣名 -->
                                    <td data-label="習慣" class="txt"><input type="text" name="habit_name" class="form-control input-md form-inline" placeholder="既習慣名を入力" style="height: 37px;" value="{{ $habit->habit_name }}" /></td>
                                    <!-- 登録 -->
                                    <td data-label="登録" class="txt" style="border:0px none;">
                                        <input class="btn btn-info" type="submit" value="更新する">
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>

                    <!-- ボタン -->
                    <table class="habit_input" style="width:500px; margin-top:0px; border:0px none;">
                        <tbody>
                            <tr style="border:0px none;">

                                <!-- 削除 -->
                                <td data-label="削除" class="txt" style="border:0px none;">
                                    <form method="POST" action="{{ route('habits.destroy', ['id' => $habit->id ]) }}" id="delete_{{ $habit->id }}">
                                        @csrf
                                        <a href="#" class="btn btn-danger" data-id="{{ $habit->id }}" onclick="deletePost(this);">削除する</a>
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
