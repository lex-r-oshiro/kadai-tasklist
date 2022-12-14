@extends("layouts.app")

@section("content")

    <h1>タスク一覧</h1>
    
    @if (count($tasks) >0 )
        <table class="table table-striped">
            <thead>
                <!--<th>id</th>-->
                <th>status</th>
                <th>タスク</th>
            </thead>
            
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        {{-- タスク詳細ページへのリンク--}}
                        <!--<td>{!! link_to_route("tasks.show", $task->id, ["task" => $task->id]) !!}</td>-->
                        <td>{!! link_to_route("tasks.show", $task->status, ["task" => $task->id]) !!}</td>
                        <td>{{ $task->content }}</td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    @endif
    
    
    {{-- ページネーションのリンク --}}
    {{ $tasks->links() }}

@endsection