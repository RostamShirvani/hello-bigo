@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="col-md-10 m-auto">
            <table class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->key }}</td>
                        <td>
                            <form id="form-{{ $setting->key }}"
                                  action="{{ route('admin.settings.ajax.update') }}"
                                  method="POST"
                                  class="ajax-form not-reload">
                                @csrf
                                <input type="hidden"
                                       id="key"
                                       name="key"
                                       value="{{ $setting->key }}">

                                <input type="text"
                                       class="form-control-sm"
                                       data-role="tagsinput"
                                       id="value"
                                       name="value"
                                       value="{{ $setting->formatted_value }}">
                            </form>
                        </td>
                        <td>
                            <button type="button"
                                    data-form="form-{{ $setting->key }}"
                                    class="btn btn-sm btn-primary btn-save-form ladda-button">بروزرسانی</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
