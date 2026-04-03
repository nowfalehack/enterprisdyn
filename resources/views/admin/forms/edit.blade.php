@extends('admin.layout')

@section('content')

<div class="card border-0 shadow-lg rounded-4 p-4">

    <h3 class="fw-bold mb-4">✏ Edit Form</h3>

    <form method="POST" action="/admin/forms/{{ $form->id }}">
        @csrf
        @method('PUT')

        <input class="form-control mb-3" name="title"
               value="{{ $form->title }}">

        <div id="fields">

            @foreach($form->fields as $field)
            <div class="field-box mt-3 p-3 rounded-4 shadow-sm">

                <div class="row">

                    <div class="col-md-4">
                        <input name="fields[][label]" value="{{ $field->label }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <select name="fields[][type]" class="form-control">
                            <option value="text" {{ $field->type=='text'?'selected':'' }}>Text</option>
                            <option value="email" {{ $field->type=='email'?'selected':'' }}>Email</option>
                            <option value="number" {{ $field->type=='number'?'selected':'' }}>Number</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <input type="checkbox" name="fields[][required]" value="1"
                               {{ $field->required ? 'checked' : '' }}>
                        <label class="ms-2">Required</label>
                    </div>

                </div>

            </div>
            @endforeach

        </div>

        <button type="button" onclick="addField()"
                class="btn btn-outline-primary mt-3 rounded-pill">
            + Add Field
        </button>

        <button class="btn btn-success mt-3 rounded-pill px-4">
            Update Form
        </button>

    </form>

</div>

<script>
function addField(){
    document.getElementById('fields').innerHTML += `
        <div class="field-box mt-3 p-3 rounded-4 shadow-sm">
            <div class="row">

                <div class="col-md-4">
                    <input name="fields[][label]" class="form-control"
                           placeholder="Field Label">
                </div>

                <div class="col-md-4">
                    <select name="fields[][type]" class="form-control">
                        <option value="">Type</option>
                        <option value="text">Text</option>
                        <option value="email">Email</option>
                        <option value="number">Number</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-center">
                    <input type="checkbox" name="fields[][required]" value="1">
                    <label class="ms-2">Required</label>
                </div>

            </div>
        </div>
    `;
}
</script>

@endsection