@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Off Users </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Employee name</th>
                            <th scope="col">Vacation type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Period (Days)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offusers as $offuser)
                            <tr>

                                <td>{{ $offuser->user_name }}</td>
                                <td>{{ $offuser->vacation_name }}</td>
                                <td>{{ $offuser->date }}</td>
                                <td>{{ $offuser->period }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
