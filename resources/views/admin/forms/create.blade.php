@extends('admin.layout')

@section('content')

<div class="card p-4 shadow rounded-4">

    <h3>Create Form</h3>

    <form method="POST" action="/admin/forms">
        @csrf

        <input name="title" class="form-control mb-3" placeholder="Form Title">

        <div id="fields"></div>

        <button type="button" onclick="addField()" class="btn btn-primary mt-3">
            + Add Field
        </button>

        <button class="btn btn-success mt-3">Save</button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
let index = 0;

function addField(){

    document.getElementById('fields').innerHTML += `
        <div class="field-box border p-3 mt-2">

            <input type="hidden" name="fields[${index}][order]" value="${index}">

            <input name="fields[${index}][label]" placeholder="Label" class="form-control mb-2">

            <select name="fields[${index}][type]" class="form-control mb-2">
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="select">Dropdown</option>
                <option value="checkbox">Checkbox</option>
            </select>

            <input name="fields[${index}][validation]" placeholder="email|min:5" class="form-control mb-2">

            <input name="fields[${index}][options]" placeholder="A,B,C" class="form-control mb-2">

            <label><input type="checkbox" name="fields[${index}][required]"> Required</label>

            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger btn-sm mt-2">
                Remove
            </button>

        </div>
    `;

    index++;
}

// DRAG DROP
new Sortable(document.getElementById('fields'), {
    animation: 150,
    onEnd: function () {
        document.querySelectorAll('.field-box').forEach((el, i) => {
            el.querySelector('input[type="hidden"]').value = i;
        });
    }
});
</script>

@endsection