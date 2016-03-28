@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-header">
        <h1>Moje kursy  </h1>
        <p>Zarządzaj swoimi kursami.</p>

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Dodaj »
        </button>
    </div>
</div>


<!-- Modal Add -->
<form action="/course" method="POST">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nowy Kurs</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="curse-category" class="col-sm-3 control-label">Kategoria</label>

                            <div class="col-sm-6">
                                <select name="category_id" id="curse-category" class="form-control" required="">
                                    <option value="" ></option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="curse-name" class="col-sm-3 control-label">Nazwa</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="curse-name" class="form-control" value="{{ old('name') }}" required="">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Task
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                <form action="/curse" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="curse-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="curse-name" class="form-control" value="{{ old('curse') }}">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Tasks -->
        @if (count($curses) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped curse-table">
                    <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($curses as $curse)
                        <tr>
                            <td class="table-text"><div>{{ $curse->name }}</div></td>

                            <!-- Task Delete Button -->
                            <td>
                                <form action="/course/{{ $curse->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-curse-{{ $curse->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
