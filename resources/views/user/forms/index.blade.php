@extends('user.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">📋 Available Forms</h2>
            <p class="text-muted mb-0">Fill and submit your forms easily</p>
        </div>
    </div>

    <!-- FORMS GRID -->
    <div class="row g-4">

        @forelse($forms as $form)

        <div class="col-md-4">

            <div class="card border-0 shadow-lg rounded-4 h-100 hover-card">

                <div class="card-body d-flex flex-column">

                    <!-- ICON -->
                    <div class="mb-3">
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            FORM
                        </span>
                    </div>

                    <!-- TITLE -->
                    <h5 class="fw-bold mb-2">
                        {{ $form->title }}
                    </h5>

                    <p class="text-muted small">
                        Dynamic form created by admin
                    </p>

                    <!-- STATUS -->
                    <div class="mb-3">
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            Active
                        </span>
                    </div>

                    <!-- ACTION -->
                    <div class="mt-auto">

                        <a href="/forms/{{ $form->id }}" 
                           class="btn btn-primary w-100 rounded-pill fw-semibold">
                            ✍ Fill Form
                        </a>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12 text-center py-5">
            <h5 class="text-muted">🚫 No forms available</h5>
        </div>

        @endforelse

    </div>

</div>

<!-- EXTRA STYLING -->
<style>
.hover-card {
    transition: all 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
</style>

@endsection