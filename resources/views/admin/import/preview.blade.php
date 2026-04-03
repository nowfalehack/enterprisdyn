@extends('admin.layout')

@section('content')

<h2 class="mb-4">📊 Import Preview</h2>

@php
    // 🔥 Get all keys dynamically
    $headers = [];

    foreach(array_merge($valid, $invalid) as $row){
        $headers = array_unique(array_merge($headers, array_keys($row)));
    }
@endphp

<div class="row">

    <!-- VALID DATA -->
    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-success text-white">
                ✅ Valid Data ({{ count($valid) }})
            </div>

            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            @foreach($headers as $header)
                                <th>{{ ucfirst($header) }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($valid as $row)
                        <tr>
                            @foreach($headers as $header)
                                <td>{{ $row[$header] ?? '-' }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- INVALID DATA -->
    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-danger text-white">
                ❌ Invalid Data ({{ count($invalid) }})
            </div>

            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            @foreach($headers as $header)
                                <th>{{ ucfirst($header) }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($invalid as $row)
                        <tr class="table-danger">
                            @foreach($headers as $header)
                                <td>{{ $row[$header] ?? '-' }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- CONFIRM BUTTON -->
<form method="POST" action="/admin/import-store" class="mt-4">
    @csrf
    <input type="hidden" name="valid" value='@json($valid)'>

    <button class="btn btn-success px-4">
        ✅ Confirm Import
    </button>

    <a href="/admin/import" class="btn btn-secondary">
        Cancel
    </a>
</form>

@endsection