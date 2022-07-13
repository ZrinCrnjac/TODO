@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gotovi zadaci
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Naziv zadatka</th>
                            <th>Opis</th>
                            <th>Obriši</th>
                            <th>Poništi</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if($task->done == 'true')
                                <tr>
                                    <td class="table-text"><div>{{$task->name}}</div></td>
                                    <td class="table-text"><div>{{$task->description}}</div></td>

                                    <td>
                                        <form action="{{url('task/' . $task->id)}}" method="POST">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE')}}

                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Obriši
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{url('task/undone/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fa fa-btn fa-edit"></i>Poništi
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</div>
@endsection