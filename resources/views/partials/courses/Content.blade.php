<div class="col-12 pt-3 mt-0">
    <h2 class="text-muted">{{ __("Contenido del curso") }}</h2>
    <hr />
</div>
@forelse($updates as $update)
    <div class="col-6">
        <div class="card bg-light p-3">
            <a href="{{ $update->pathAttachment() }}">{{ $update->file }}</a>
        </div>
    </div>

@empty
    <div class="alert alert-dark">
        <i class="fas fa-info-circle"></i>
        {{ __("No hay ningun requisito") }}
    </div>
@endforelse

