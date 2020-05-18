@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <!--  -->
        <div class="col-md-12" style="padding-top:65px">
            <div class="card mb-4">
                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/happa.svg') }}" style="width: 20px;">既習慣登録</div>

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

                        <table class="task_input" style="margin-top:30px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:70%">既習慣</th>
                                    <th scope="col" style="width:30%">登録</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form class="form-inline rounded border p-3" method="POST" action="{{route('habits.store')}}" style=" background-color:#F6F2FC;">
                                    @csrf
                                    <tr>
                                        <!-- 既習慣 -->
                                        <td data-label="習慣" class="txt"><input type="text" name="habit_name" class="form-control input-md form-inline" placeholder="習慣名を入力" style="height: 37px;" /></td>
                                        <!-- ボタン -->
                                        <td data-label="ボタン" class="txt">
                                            <div class="text-center"><input class="btn btn-info" type="submit" value="登録する"></div>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


        <!-- タスク一覧 -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header"><img class="pb-1 mr-2" alt="どんぐりアイコン" src="{{ asset('/images/donguri.svg') }}" style="width: 20px;">既習慣一覧</div>

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
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:70%">既習慣名</th>
                                    <th scope="col" style="width:30%">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($habits as $value)
                                    <tr>
                                        <th class="task_name"><div style="padding-left:10px;">{{ $value->habit_name }}</div></th>
                                        <td data-label="編集" class="txt"><a href="{{ route('habits.edit', ['id' => $value->id ]) }}">Edit</a></td>
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


@endsection