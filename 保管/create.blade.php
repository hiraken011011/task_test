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

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    createです
                    <form method="POST" action="{{route('habits.store')}}">
                        @csrf

                        既習慣名
                        <input type="text" name="habit_name">
                        <br>

                        <input class="btn btn-info" type="submit" value="登録する">
                    </form>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">既習慣</th>
                            <th scope="col">編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- コレクション型で複数を持ってきているため -->
                        @foreach($habits as $value)
                            <tr>
                                <td>{{ $value->habit_name }}</td>
                                <td><a href="{{ route('habits.edit', ['id' => $value->id ]) }}">{{ $value->id }}Editボタン</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
