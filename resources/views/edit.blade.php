@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel heading">
                    Uredi zadatak
                </div>

                <div class="panel-body">

                    <form action="{{url('task/' . $task->id)}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Naziv zadatka</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') ? old('task') : $task->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Opis zadatka</label>

                            <div class="col-sm-6">
                                <input type="text" name="description" id="task-description" class="form-control" value="{{ old('task') ? old('task') : $task->description }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i>Spremi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection