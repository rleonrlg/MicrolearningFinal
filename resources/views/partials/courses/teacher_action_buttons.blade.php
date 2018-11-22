<div class="btn-group">
    @if((int) $course->status === \App\Course::PUBLISHED)
        <a class="btn btn-course" href="{{ route('courses.detail', ["slug" => $course->slug]) }}">
            <i class="fas fa-eye"></i>{{ __("Detalle") }}
        </a>
        <a class="btn btn-warning text-white" href="{{ route('courses.edit', ["slug" => $course->slug]) }}">
            <i class="fas fa-pencil"></i>{{ __("Editar") }}
        </a>
        @include('partials.courses.btn_forms.delete')
    @elseif((int) $course->status === \App\Course::PENDING)
        <a class="btn btn-primary text-white" href="#">
            <i class="fas fa-history"></i>{{ __("Curso pendiente de revision") }}
        </a>
        <a class="btn btn-course" href="{{ route('courses.detail', ["slug" => $course->slug]) }}">
            <i class="fas fa-eye"></i>{{ __("Detalle") }}
        </a>
        <a class="btn btn-warning text-white" href="{{ route('courses.edit', ["slug" => $course->slug]) }}">
            <i class="fas fa-pencil"></i>{{ __("Editar") }}
        </a>
        @include('partials.courses.btn_forms.delete')
    @else
        <a class="btn btn-danger text-white" href="#">
            <i class="fas fa-pencil"></i>{{ __("Curso rechazado") }}
        </a>
        @include('partials.courses.btn_forms.delete')
    @endif

</div>
