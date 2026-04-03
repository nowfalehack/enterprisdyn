@extends('admin.layout')
@section('content')
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">

    <div class="p-4 text-white d-flex justify-content-between align-items-center"
         style="background: linear-gradient(135deg,#0f172a,#1e293b);">

        <div>
            <h4 class="fw-bold mb-0">🚀 Forms</h4>
            <small class="opacity-75">Manage your dynamic forms</small>
        </div>

        <a href="/admin/forms/create"
           class="btn btn-warning rounded-pill px-4 fw-bold shadow">
            + New Form
        </a>
    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead style="background:#111827;color:#fff;">
                <tr>
                    <th>ID</th>
                    <th>Form</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($forms as $form)
            <tr class="table-hover-row">

                <td class="fw-bold text-muted">#{{ $form->id }}</td>

                <td>
                    <div class="fw-semibold">{{ $form->title }}</div>
                    <small class="text-muted">Dynamic Builder</small>
                </td>

                <td>
                    <span class="badge bg-success rounded-pill px-3">
                        Active
                    </span>
                </td>

                <td class="text-end">

                    <a href="/admin/forms/{{ $form->id }}"
                       class="btn btn-sm btn-outline-info rounded-pill px-3">
                        👁
                    </a>

                    <a href="/admin/forms/{{ $form->id }}/edit"
                       class="btn btn-sm btn-outline-warning rounded-pill px-3">
                        ✏
                    </a>

                    <form action="/admin/forms/{{ $form->id }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Delete form?')"
                                class="btn btn-sm btn-outline-danger rounded-pill px-3">
                            🗑
                        </button>
                    </form>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-5 text-muted">
                    🚫 No forms created
                </td>
            </tr>
            @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection