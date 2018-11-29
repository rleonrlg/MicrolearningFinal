@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
        "title" => __("Accede a nuestros cursos"),
        "icon" => "th"
    ])
@endsection

@section('content')
<div class="pl-5 pr-5">
    <div class="row justify-content-center">
        @forelse($courses as $course)
                <div class="col-md-4">
                    @include('partials.courses.card_course')
                </div>
            @empty
                <div class="alert alert-dark">
                    {{__("No hay cursos disponibles")}}
                </div>
        @endforelse
    </div>
    <div class="row justify-content-center">
        {{ $courses->links() }}
    </div>
</div>
@endsection
