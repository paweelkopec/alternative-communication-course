@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-header">
        <h1>Użytkownicy  </h1>
        <p></p>
        <table class="table table-striped curse-table">
                    <thead>
                    <th>id</th>
                    <th>Email</th>
                    <th> Edytowany</th>
                    <th>Utworzony</th>
                    <th>Kursy</th>
                    <th>Akcja</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="table-text">{{ $user->id }}</td>
                            <td class="table-text">{{ $user->email }}</td>
                            <td class="table-text">{{ $user->updated_at }}</td>
                            <td class="table-text">{{ $user->created_at }}</td>
                            <td class="table-text">{{ $user->countCourses() }}</td>
                            <td>
                                <form action="/admin/account/{{ $user->id }}" method="POST" style="display:inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                    <button type="submit" id="delete-curse-{{ $user->id }}" class="btn btn-danger"
                                           @if ( Auth::user()->id == $user->id ) disabled="" @endif  >
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
