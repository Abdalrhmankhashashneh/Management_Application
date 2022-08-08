@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add User</h6>
                <form action="{{ route('update_user', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" name="name"
                            value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="email" value="{{ $user->email }}" required>

                    </div>


                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <input type="text" class="form-control" id="major" aria-describedby="emailHelp"
                            name="major" value="{{ $user->major }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="start">Birthday: </label>

                        <input class="form-control" type="date" id="start" name="birthday"
                            value="{{ $user->birthday }}" min="(DATE)" max="(DATE)">
                    </div>
            </div>

            <button type="submit" class="btn btn-primary">Update user</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
