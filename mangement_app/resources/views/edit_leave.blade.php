@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-8">
            <form action="{{ route('update_leave', $leavetype->id) }}" method="POST" class="bg-light rounded h-100 p-4">
                @csrf
                @method('PUT')
                <h6 class="mb-4">Edit leavetype Type</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" required name="name"
                        value="{{ $leavetype->name }}">
                    <label for="floatingInput">Type</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" required name="description"
                        value="{{ $leavetype->description }}">
                    <label for="floatingInput">description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="submit" class=" btn btn-success" id="floatingInput" value="Update leavetype">

                </div>

            </form>
        </div>
    </div>
@endsection
