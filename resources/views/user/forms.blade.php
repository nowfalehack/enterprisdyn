@extends('user.layout')

@section('content')

<div class="container mt-4">
    <h2 class="fw-bold mb-4">📝 Available Forms</h2>

    <div class="row">

        @forelse($forms as $form)
            <div class="col-md-4 mb-3">
                <div class="card shadow rounded-4 p-3">

                    <h5 class="fw-bold">{{ $form->title }}</h5>

                    <p class="text-muted">
                        Status: {{ $form->status ? 'Active' : 'Inactive' }}
                    </p>

                    <a href="/forms/{{ $form->id }}" class="btn btn-primary rounded-pill">
                        Fill Form
                    </a>

                </div>
            </div>
        @empty
            <p class="text-muted">No forms available 😢</p>
        @endforelse

    </div>
</div>

@endsection