@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{-- タスク一覧画面 --}}
        @include('tasks.index')
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the TaskList</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>

        <div class="center jumbotron">
            <h1>Log in</h1>
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
        
                    {!! Form::open(['route' => 'login.post']) !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                        </div>
        
                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
        
                        {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection