@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-left py-2">
                <a href="{{ route('admin.blacklist.add')}}" class="btn btn-primary btn-sm">افزودن تکی</a>
            </div>

            <table id="items" class="table table-striped" style="width: 100%">
                <thead>
                <tr>

                    <th>نام</th>
                    <th>ایدی</th>
                    <th>موبایل</th>
                    <th>مبلغ</th>
                    <th>توضیحات</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blacklist as $blacklist)
                    <tr>

                        <td>{{ $blacklist->name }}</td>
                        <td>{{ $blacklist->blackid }}</td>
                        <td>{{ $blacklist->mobile }}</td>
                        <td>{{ $blacklist->amount }} تومان </td>
                        <td>{{ $blacklist->Description }}</td>
                        <td>


                            <form action="/delete/{{$blacklist->id}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">حذف</button>
                            </form>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>

@endsection