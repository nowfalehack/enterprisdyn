@extends('user.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">{{ $form->title }}</h2>
        <p class="text-muted">Fill the form below</p>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('form.submit', $form->id) }}">
            @csrf

            <!-- ✅ DEFAULT FIELDS -->
            <div class="mb-4">
                <label class="fw-semibold">Name *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="fw-semibold">Email *</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone') }}">
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- ✅ DYNAMIC FIELDS -->
            @foreach($form->fields as $field)

                @php
                    $options = $field->options ? explode(',', $field->options) : [];
                @endphp

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        {{ $field->label }}
                        @if($field->required)
                            <span class="text-danger">*</span>
                        @endif
                    </label>

                    @if($field->type == 'text')
                        <input type="text"
                               name="field_{{ $field->id }}"
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control">

                    @elseif($field->type == 'email')
                        <input type="email"
                               name="field_{{ $field->id }}"
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control">

                    @elseif($field->type == 'number')
                        <input type="number"
                               name="field_{{ $field->id }}"
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control">

                    @elseif($field->type == 'date')
                        <input type="date"
                               name="field_{{ $field->id }}"
                               value="{{ old('field_'.$field->id) }}"
                               class="form-control">

                    @elseif($field->type == 'select')
                        <select name="field_{{ $field->id }}" class="form-control">
                            <option value="">-- Select --</option>
                            @foreach($options as $opt)
                                <option value="{{ trim($opt) }}"
                                    {{ old('field_'.$field->id) == trim($opt) ? 'selected' : '' }}>
                                    {{ trim($opt) }}
                                </option>
                            @endforeach
                        </select>

                    @elseif($field->type == 'checkbox')
                        <div class="mt-2">
                            @foreach($options as $opt)
                                <div class="form-check">
                                    <input type="checkbox"
                                           name="field_{{ $field->id }}[]"
                                           value="{{ trim($opt) }}"
                                           class="form-check-input"
                                           {{ in_array(trim($opt), old('field_'.$field->id, [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ trim($opt) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

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