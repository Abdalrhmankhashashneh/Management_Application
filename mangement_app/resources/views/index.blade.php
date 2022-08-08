@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (session('success_deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('success_deleted') }}
            </div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"> Users </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">major</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Session::has('admin_id'))
                            @foreach ($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->major }}</td>
                                    <td><a href="{{ route('edit_user', $user->id) }}" class="btn btn-warning">edit </a></td>
                                    <td>
                                        <form action="{{ route('delete_user', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <td><a href="{{ route('create_user') }}" class="btn btn-success">add user </a></td>
                        @else
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->major }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"> Activities </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">employee</th>
                            <th scope="col">leave type </th>
                            <th scope="col">start</th>
                            <th scope="col">end</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($activities as $activity)
                            <tr>

                                <td>{{ $activity->user_name }}</td>
                                <td>{{ $activity->leave_name }}</td>
                                <td>{{ $activity->start }}</td>
                                <td>{{ $activity->end }}</td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
