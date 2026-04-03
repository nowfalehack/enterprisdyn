@extends('admin.layout')

@section('content')

<h2>Import CSV</h2>

<form method="POST" action="/admin/import-preview" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv">
    <button class="btn btn-primary">Preview</button>
</form>

@endsection