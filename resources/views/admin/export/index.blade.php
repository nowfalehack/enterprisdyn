@extends('admin.layout')

@section('content')

<h2 class="mb-4">📤 Export Submissions</h2>

<div class="card shadow border-0 rounded-4 p-4">

    <form method="GET" action="/admin/export-download">

        <div class="mb-3">
            <label>Select Form</label>
            <select name="form_id" class="form-control">
                <option value="">All Forms</option>

                @foreach(\App\Models\Form::all() as $form)
                    <option value="{{ $form->id }}">
                        {{ $form->title }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-success">
            ⬇ Download CSV
        </button>

    </form>

</div>

@endsection