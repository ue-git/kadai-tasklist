@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>
                        {!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}
                    </td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    {{-- タスクがない場合 --}}
    @else
        <p>現在、タスクの登録はございません。</p>
        
    @endif
    
    {{-- タスク新規作成ページへのリンク --}}
    {!! link_to_route('tasks.create', 'タスクの新規作成', [], ['class' => 'btn btn-primary']) !!}

@endsection