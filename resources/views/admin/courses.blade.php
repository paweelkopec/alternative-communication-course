@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-header">
        <h1>Kursy  </h1>
        <p></p>
        <table class="table table-striped curse-table">
                    <thead>
                    <th>id</th>
                    <th>Nazwa</th>
                    <th>Użytkownik</th>
                    <th>Kategoria</th>
                    <th>Obrazki</th>
                    <th> Edytowany</th>
                    <th>Utworzony</th>
                    <th>Akcja</th>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <td class="table-text">{{ $course->id }}</td>
                            <td class="table-text">{{ $course->name }}</td>
                            <td class="table-text">{{ $course->user()->email}}</td>
                            <td class="table-text">{{ $course->category()->name}}</td>
                            <td class="table-text">{{ $course->countFiles()}}</td>
                            <td class="table-text">{{ $course->updated_at }}</td>
                            <td class="table-text">{{ $course->created_at }}</td>
                          {{--  <td class="table-text">{{ $course->countCourses() }}</td> --}}
                            <td>
                                <form action="/admin/account/{{ $course->id }}" method="POST" style="display:inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                    <button type="submit" id="delete-curse-{{ $course->id }}" class="btn btn-danger"   >
                                        <i class="fa fa-btn fa-trash"></i>Usuń
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
       
    </div>
</div>
@endsection
