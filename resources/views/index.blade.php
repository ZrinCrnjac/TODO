@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dodaj novi zadatak
            </div>

                <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Naziv zadatka</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control" value="{{old('name')}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="task-description" class="col-sm-3 control-label">Opis zadatka</label>
                        <div class="col-sm-6">
                            <input type="text" name="description" id="task-description" class="form-control" value="{{old('description')}}">
                        </div>
                    </div>

                    <input type="hidden" name="done" id="task-done" class="form-control" value="false">

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i>Dodaj zadatak
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Trenutni zadaci
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Naziv zadatka</th>
                            <th>Opis</th>
                            <th>Uredi</th>
                            <th>Obri??i</th>
                            <th>Odra??en</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if($task->done == 'false')
                                <tr>
                                    <td class="table-text"><div>{{$task->name}}</div></td>
                                    <td class="table-text"><div>{{$task->description}}</div></td>

                                    <td>
                                        <form action="{{url('task/edit/' . $task->id)}}" method="GET" style="display: inline-block;">
                                            {{csrf_field()}}
                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-warning">
                                                <i class="fa fa-btn fa-edit"></i>Uredi
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{url('task/' . $task->id)}}" method="POST">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE')}}

                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Obri??i
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{url('task/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-btn fa-plus"></i>Odra??en
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{url('task/done')}}">Gotovi</a>
                </div>
            </div>

    </div>
</div>
@endsection