@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form action="{{ route('admin.payment-pins.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="bulk">
                    <button type="submit" class="btn btn-primary">ثبت</button>

                    <table class="table table-striped" style="width: 100%">
                        <thead>
                        <tr class="text-center">
                            <th></th>
                            <th>سریال</th>
                            <th>پین</th>
                            <th>مقدار($)</th>
                            <th>الماس بیگو</th>
                            <th>الماس لایکی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i<100; $i++)
                            <tr>
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <input type="text"
                                           class="form-control form-control-sm text-center direction-ltr"
                                           name="items[{{ $i }}][serial_number]"
                                           value="{{ old('items')[$i]['serial_number'] ?? '' }}"
                                           placeholder="سریال">
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
                                           placeholder="الماس بیگو"
                                           min="1">
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control form-control-sm text-center direction-ltr"
                                           name="items[{{ $i }}][likee_value]"
                                           value="{{ old('items')[$i]['likee_value'] ?? '' }}"
                                           placeholder="الماس لایکی"
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
