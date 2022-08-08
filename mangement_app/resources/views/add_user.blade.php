@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add User</h6>
                <form action="{{ route('add_user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" name="name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <input type="text" class="form-control" id="major" aria-describedby="emailHelp"
                            name="major" required>
                    </div>
                    <div class="mb-3">
                        <label for="start">Birthday: </label>

                        <input class="form-control" type="date" id="start" name="birthday" value="(DATE)"
                            min="(DATE)" max="(DATE)">
                    </div>
            </div>

            <button type="submit" class="btn btn-primary">Add user</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
