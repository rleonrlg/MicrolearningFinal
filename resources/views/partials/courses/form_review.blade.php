@cannot('inscribe', $course)
    @can('review', $course)
        <div class="col-12 pt-0 mt-4 text-center">
            <h2 class="text-muted">{{ __("Danos tu opinion del curso") }}</h2>
        </div>
        <div class="container-fluid">
            <form action="{{ route('courses.add_review') }} " method="POST" class="form-inline" id="rating_form">
                @csrf
                <div class="form-group">
                    <div class="col-12">
                        <ul id="list_rating" class="list-inline" style="font-size: 40px;">
                            <li class="list-inline-item star" data-number="1"><i class="fas fa-star yellow"></i></li>
                            <li class="list-inline-item star" data-number="2"><i class="fas fa-star "></i></li>
                            <li class="list-inline-item star" data-number="3"><i class="fas fa-star "></i></li>
                            <li class="list-inline-item star" data-number="4"><i class="fas fa-star "></i></li>
                            <li class="list-inline-item star" data-number="5"><i class="fas fa-star "></i></li>

                        </ul>
                    </div>
                </div>
                <br />

                <input type="hidden" name="rating_input" value="1">
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="form-group">
                    <div class="col-12">
                        <textarea
                            placeholder="{{ __("Escribe una resena") }}"
                            id="message"
                            name="message"
                            class="form-control"
                            rows="8"
                            cols="120"
                        >

                        </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning text-white">
                    <i class="fas fa-space-shuttle"></i> {{ __("Valorar") }}
                </button>
            </form>
        </div>
    @endcan
@endcannot

@push('scripts')

    <script>
        jQuery(document).ready(function(){
            const ratingSelector = jQuery('#list_rating');
            ratingSelector.find('li').on('click', function () {
                const number = $(this).data('number');
                $("#rating_form").find('input[name=rating_input]').val(number);
                ratingSelector.find('li i').removeClass('yellow').each(function (index) {
                    if ((index + 1) <= number){
                        $(this).addClass('yellow');
                    }
                })

            })
        });
    </script>
@endpush
