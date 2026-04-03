@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">📄 Form Details</h2>
        <p class="text-muted">Manage and view form structure</p>
    </div>

    <!-- MAIN CARD -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <!-- CARD HEADER -->
        <div class="p-4 text-white"
             style="background: linear-gradient(135deg, #1e293b, #0f172a);">

            <h4 class="mb-1 fw-bold">{{ $form->title }}</h4>
            <small class="opacity-75">Dynamic Form Configuration</small>

        </div>

        <!-- CARD BODY -->
        <div class="p-4">

            <h5 class="fw-semibold mb-3">🧩 Form Fields</h5>

            <div class="row g-3">

                @foreach($form->fields as $field)
                <div class="col-md-4">

                    <div class="field-card p-3 rounded-4 shadow-sm">

                        <!-- LABEL -->
                        <h6 class="fw-bold mb-2">
                            {{ $field->label }}
                        </h6>

                        <!-- TYPE -->
                        <span class="badge bg-primary rounded-pill px-3">
                            {{ ucfirst($field->type) }}
                        </span>

                        <!-- REQUIRED -->
                        @if($field->required)
                        <span class="badge bg-danger rounded-pill px-3">
                            Required
                        </span>
                        @else
                        <span class="badge bg-secondary rounded-pill px-3">
                            Optional
                        </span>
                        @endif

                    </div>

                </div>
                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection