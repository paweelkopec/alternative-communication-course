@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-header">
        <h1>Moje kursy  </h1>
        <p>Zarządzaj swoimi kursami.</p>
        <table class="table table-striped curse-table">
                    <thead>
                    <th>Nazwa</th>
                    <th>Akcje</th>
                    </thead>
                    <tbody>
                        @foreach ($curses as $curse)
                        <tr>
                            <td class="table-text">
                                <div>
                                    <a href="{{ url('/study/') }}/{{ $curse->id }}">{{ $curse->name }}</a> 
                                </div>
                            </td>

                            <!-- Task Delete Button -->
                            <td>
                                <form action="/course/{{ $curse->id }}" method="POST" style="display:inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-curse-{{ $curse->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Usuń
                                    </button>
                                </form>
                                
                                <button type="submit" data-target="{{ $curse->id }}" class="btn btn-warning edit-curse">
                                        <i class="fa fa-btn glyphicon-pencil"></i>Edycja
                                </button>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Dodaj »
        </button>
    </div>
</div>
<!-- Modal Add -->
<form action="/course" method="POST" enctype="multipart/form-data">
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
                            <label for="curse-name" class="col-sm-3 control-label">Nazwa</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="curse-name" class="form-control" value="{{ old('name') }}" required="">
                            </div>
                        </div>

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

                        <legend>Pliki Kursu</legend>

                        <div class="entry">

                            <div class="form-group">
                                <label for="curse-name" class="col-sm-3 control-label">Plik</label>

                                <input type="file" name="images[file][]"  accept="image/*" required="">
                            </div>

                            <div class="form-group">
                                <label for="curse-name" class="col-sm-3 control-label">Nazwa</label>

                                <div class="input-group col-sm-6">
                                    <input type="text" name="images[name][]" id="curse-name" class="form-control" value="{{ old('name') }}" required="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-add" type="button">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
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
<!-- Modal Edit -->
<form id="form-edit"  action="/course/"  method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal fade" id="modal-course-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edycja  Kursu</h4>
                </div>
                <div class="modal-body">
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
