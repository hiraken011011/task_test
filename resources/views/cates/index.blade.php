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

                    <!-- createです -->
                    <form method="POST" action="{{route('cates.store')}}">
                        @csrf

                        カテゴリー名
                        <input type="text" name="cate_name">
                        <br>

                        カテゴリーカラー
                        <select name="color_id">
                            <option value="">選択してください</option>
                            @foreach($colors as $value)
                                <option value="{{ $value->id }}">{{ $value->color_name }}</option>
                            @endforeach
                        </select>

                        <input class="btn btn-info" type="submit" value="登録する">
                    </form>
                    <br>


                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">カテゴリー名</th>
                                <th scope="col">カテゴリーカラー</th>
                                <th scope="col">編集</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- コレクション型で複数を持ってきているため -->
                            @foreach($cates as $value)
                                <tr>
                                    <td>{{ $value->cate_name }}</td>
                                    <td style="background-color:{{ $value->color_code }}; color:white;">{{ $value->color_name }}</td>
                                    <td><a href="{{ route('cates.edit', ['id' => $value->id ]) }}">Editボタン</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection