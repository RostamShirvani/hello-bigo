@extends('admin.layouts.admin')

@section('title')
    bulk other pins
@endsection

@section('content')
    <div class="p-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form action="{{ route('admin.other-pins.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="bulk">
                    <button type="submit" class="btn btn-primary">ثبت</button>

                    <table class="table table-striped" style="width: 100%">
                        <thead>
                        <tr class="text-center">
                            <th></th>
                            <th>نوع پین</th>
                            <th>پین</th>
                            <th>مقدار($)</th>
                            <th>تعداد الماس</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i<100; $i++)
                            <tr>
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <select id="typeSelect" name="items[{{ $i }}][app_type]" class="form-control" data-live-search="true">
                                        <option value="">انتخاب کنید ...</option>
                                        @foreach(\App\Enums\EAppType::other() as $key => $value)
                                            <option value="{{ $key }}" {{ isset(old('items')[$i]) && $key == old('items')[$i]['app_type'] ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control form-control-sm text-center direction-ltr"
                                           name="items[{{ $i }}][pin]"
                                           value="{{ old('items')[$i]['pin'] ?? '' }}"
                                           placeholder="پین">
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control form-control-sm text-center direction-ltr"
                                           name="items[{{ $i }}][amount]"
                                           value="{{ old('items')[$i]['amount'] ?? '' }}"
                                           placeholder="مقدار($)"
                                           min="1">
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control form-control-sm text-center direction-ltr"
                                           name="items[{{ $i }}][value]"
                                           value="{{ old('items')[$i]['value'] ?? '' }}"
                                           placeholder="تعداد الماس"
                                           min="1">
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
