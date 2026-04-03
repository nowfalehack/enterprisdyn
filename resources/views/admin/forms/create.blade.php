@extends('admin.layout')

@section('content')

<div class="card p-4 shadow rounded-4">

    <h3 class="fw-bold mb-3">🧾 Create Form</h3>

    <form method="POST" action="/admin/forms">
        @csrf

        <label>Form Title</label>
        <input name="title" class="form-control mb-3" required>

        <label>Status</label>
        <select name="status" class="form-control mb-3">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <div class="alert alert-info">
            Default Fields: Name, Email, Phone
        </div>

        <h5>Dynamic Fields</h5>

        <div id="fields"></div>

        <button type="button" onclick="addField()" class="btn btn-primary mt-3">
            + Add Field
        </button>

        <button class="btn btn-success mt-3">Save</button>

    </form>
</div>

<script>
let index = 0;

function addField(){
    document.getElementById('fields').insertAdjacentHTML('beforeend', `
        <div class="border p-3 mt-3">

            <input type="hidden" name="fields[${index}][order]" value="${index}">

            <input name="fields[${index}][label]" class="form-control mb-2" placeholder="Label">

            <select name="fields[${index}][type]" class="form-control mb-2">
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="date">Date</option>
                <option value="select">Dropdown</option>
                <option value="checkbox">Checkbox</option>
            </select>

            <input name="fields[${index}][options]" class="form-control mb-2" placeholder="A,B,C">

            <label>
                <input type="checkbox" name="fields[${index}][validation][]" value="required">
                Required
            </label>

            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger btn-sm">
                Remove
            </button>

        </div>
    `);

    index++;
}
</script>

@endsection