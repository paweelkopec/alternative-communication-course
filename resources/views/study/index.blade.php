@extends('layouts.app')

@section('content')
<div class="container well mainContainer">
    <div class="row">
        <div class="jumbotron"
             style="margin-top: -14px; margin-bottom: -14px; padding-top: 10px;">
            <h1 class="special-title">Nauka: {{ $course->name }}</h1>
            <table class="table table-hover">
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td style="width:40%;  vertical-align: middle;   ">
                            <p style="font-size:70px; text-align:center;  "> <b> {{$file->name}}</b></p>
                        </td>
                        <td style="  text-align:center  "><img src="{{ url('/file/') }}/{{$file->id}}"/> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/study/') }}/{{ $course->id }}/test" style="width: 100%"  class="btn btn-lg btn-success">Start</a>

        </div>
    </div>
</div>
@endsection
