@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"> Vecations types </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">period (days)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacations as $vacation)
                            <tr>

                                <td>{{ $vacation->name }}</td>
                                <td>{{ $vacation->description }}</td>
                                <td>{{ $vacation->period }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        @if (session('success'))
            <div class="alert alert-warning">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"> Requests Vacations </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">employee</th>
                            <th scope="col">vacation type </th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>

                                <td>{{ $request->user_name }}</td>
                                <td>{{ $request->vacation_name }}</td>
                                @if ($request->status == 'pending')
                                    <td class="text-success">{{ $request->status }}</td>
                                    <td>
                                        <form action="{{ route('vacation_req') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Accepted">
                                            <input type="hidden" name="id" value="{{ $request->id }}">
                                            <input name="sattus" type="submit" class="btn btn-success" value="Accept">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('vacation_req') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $request->id }}">
                                            <input type="hidden" name="status" value="Rejected">
                                            <input name="sattus" type="submit" class="btn btn-danger" value="Reject">
                                        </form>
                                    </td>
                                @else
                                    @if ($request->status == 'Accepted')
                                        <td class="bg-success text-light">{{ $request->status }}</td>
                                    @else
                                        <td class="bg-danger text-light">{{ $request->status }}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
