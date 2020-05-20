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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="習慣" class="txt">
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
</div>


@endsection