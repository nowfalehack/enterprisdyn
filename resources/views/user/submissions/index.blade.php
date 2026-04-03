@extends('user.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">📨 My Submissions</h2>

    <div class="card shadow border-0 rounded-4">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Form Data</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($submissions as $sub)

                    <tr>
                        <td>{{ $sub->id }}</td>

                        <td>
                           <div class="text-muted">

    @foreach($sub->data as $key => $value)

        <div class="mb-1">
            <strong>{{ ucfirst($key) }}:</strong> {{ $value }}
        </div>

    @endforeach

</div>
                        </td>

                        <td>{{ $sub->created_at->format('d M Y') }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            🚫 No submissions yet
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $submissions->links() }}
            </div>

        </div>

    </div>

</div>

@endsection