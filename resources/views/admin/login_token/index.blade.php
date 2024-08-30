@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="col-md-10 m-auto">
            <div class="row">
                <div class="col-md-3 text-left py-2">
                    <button
                        type="button"
                        class="btn btn-primary btn-sm btn-create">
                        افزودن
                    </button>
                </div>
            </div>

            <table id="items" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>آی دی اکانت</th>
                    <th>وضعیت</th>
                    <th>همگام سازی</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($loginTokens as $loginToken)
                    <tr class="login-token-item" id="{{ $loginToken->bigo_id }}">
                        <td>{{ $loginToken->bigo_id }}</td>
                        <td class="col-status">
                            <div class="status d-inline-block">
                                @if($loginToken->status === \App\Enums\ELoginTokenStatus::ACTIVE)
                                    <span class="badge bg-success">{{ $loginToken->status_text }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $loginToken->status_text }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="synced_at d-inline-block">
                                {{ dateTimeFormat($loginToken->synced_at) }}
                            </div>
                            <div class="btn-sync d-inline-block">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                        </td>
                        <td>
                            <button
                                type="button"
                                data-value="{{ $loginToken->bigo_id }}"
                                class="btn btn-light btn-sm btn-update">
                                <i class="bi bi-gear"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
