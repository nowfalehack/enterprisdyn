@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">📊 Submissions</h2>

    <!-- FILTER -->
    <form method="GET" class="mb-4">
        <div class="row">

            <div class="col-md-4">
                <select name="form_id" class="form-control rounded-3">
                    <option value="">-- Filter by Form --</option>

                    @foreach($forms as $form)
                        <option value="{{ $form->id }}"
                            {{ request('form_id') == $form->id ? 'selected' : '' }}>
                            {{ $form->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">

    <!-- FILTER -->
    <button class="btn btn-primary rounded-pill w-100">
        Filter
    </button>

    <!-- EXPORT -->
    <a href="{{ route('admin.export', request()->query()) }}" 
       class="btn btn-success rounded-pill w-100">
        ⬇ Export
    </a>

</div>

        </div>
    </form>

    <!-- TABLE -->
    <div class="card shadow rounded-4">
        <div class="card-body">

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Form</th>
                        <th>Data</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($submissions as $sub)
                    <tr>

                        <td>#{{ $sub->id }}</td>

                        <td>
                            <span class="badge bg-dark">
                                {{ $sub->form->title ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            @foreach($sub->data as $key => $value)
                                <div>
                                    <strong>{{ $key }}:</strong> {{ $value }}
                                </div>
                            @endforeach
                        </td>

                        <td>{{ $sub->created_at->format('d M Y') }}</td>

                        <td>
                            <form method="POST" action="/admin/submissions/{{ $sub->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- PAGINATION -->
            {{ $submissions->appends(request()->query())->links() }}

        </div>
    </div>

</div>

@endsection