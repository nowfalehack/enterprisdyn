@extends('user.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">{{ $form->title }}</h2>
        <p class="text-muted">Fill the form below</p>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-body p-4">

            <form method="POST" action="{{ route('form.submit', $form->id) }}">
            @csrf

            @foreach($form->fields as $field)

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        {{ $field->label }}
                        @if($field->required)
                            <span class="text-danger">*</span>
                        @endif
                    </label>

                    <!-- TEXT -->
                    @if($field->type == 'text')
                        <input type="text" 
                               name="field_{{ $field->id }}" 
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control rounded-3">

                    <!-- EMAIL -->
                    @elseif($field->type == 'email')
                        <input type="email" 
                               name="field_{{ $field->id }}" 
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control rounded-3">

                    <!-- NUMBER -->
                    @elseif($field->type == 'number')
                        <input type="number" 
                               name="field_{{ $field->id }}" 
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control rounded-3">

                    <!-- DATE -->
                    @elseif($field->type == 'date')
                        <input type="date" 
                               name="field_{{ $field->id }}" 
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control rounded-3">
                    @endif

                    <!-- ERROR -->
                    @error('field_'.$field->id)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

            @endforeach

            <!-- SUBMIT -->
            <button class="btn btn-success px-4 py-2 rounded-pill fw-semibold">
                🚀 Submit Form
            </button>

            </form>

        </div>

    </div>

</div>

@endsection