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
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success_update'))
            <div class="alert alert-success" role="alert">
                {{ session('success_update') }}
            </div>
        @endif
        @if (session('success_delete'))
            <div class="alert alert-success" role="alert">
                {{ session('success_delete') }}
            </div>
        @endif
        @if (session('success_add'))
            <div class="alert alert-success" role="alert">
                {{ session('success_add') }}
            </div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"> Leavetypes </h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">#</th>
                            <th scope="col">leave type </th>
                            <th scope="col">description</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($leavetypes as $key => $leavetype)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $leavetype->name }}</td>
                                <td>{{ $leavetype->description }}</td>
                                @if (Session::has('admin_id'))
                                    <td><a href="{{ route('edit_leave', $leavetype->id) }}" class="btn btn-warning">edit
                                        </a></td>
                                    <td>
                                        <form action="{{ route('delete_leave', $leavetype->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach


                        @if (Session::has('admin_id'))
                            <td><a href="{{ route('create_leave_type') }}" class="btn btn-success">add leavetype </a></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (Session::has('user_id'))
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Breakes</h6>
                    <form action="{{ route('start_end_clock') }}" method="post">
                        @csrf
                        @if (Session::has('clock'))
                            <h4 class="text-danger">You start break at : @php echo  date('H:m:s'); @endphp</h4>
                            <button type="submit" class="btn btn-danger">Stop</button>
                        @else
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                    name="leave_id">
                                    @foreach ($leavetypes as $key => $leavetype)
                                        @if (!$key == 0)
                                            <option value="{{ $leavetype->id }}">{{ $leavetype->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Choise Leave type</label>
                            </div>
                            <button type="submit" class="btn btn-success">Start</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endif

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
