@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-header">
        <h1> Witaj!  </h1>
        <p>Zapraszamy do nauki niestandardowych alfabetów komunikacji.</p>
        @foreach ($courses as $curse)
        <div class="home-box">
            <h4>{{ $curse->name }}</h4>
            <br/>
            <p class="text-center"><a href="{{ url('/study/') }}/{{ $curse->id }}" class="btn btn-primary btn-sm">Podgląd</a> </p>
        </div>
        @endforeach
      </div>
</div>
@endsection
