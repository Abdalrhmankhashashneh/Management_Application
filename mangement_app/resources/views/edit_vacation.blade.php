@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-8">
            <form action="{{ route('update_vacation', $vacation->id) }}" method="POST" class="bg-light rounded h-100 p-4">
                @csrf
                @method('PUT')
                <h6 class="mb-4">Add Vacation Type</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" required name="name"
                        value="{{ $vacation->name }}">
                    <label for="floatingInput">Type</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" required name="description"
                        value="{{ $vacation->description }}">
                    <label for="floatingInput">description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" min="1" max="30" class="form-control" id="floatingInput"
                        placeholder="" required name="limit" value="{{ $vacation->limit }}">
                    <label for="floatingInput">limit</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="submit" class=" btn btn-success" id="floatingInput" value="Update Vacation">

                </div>

            </form>
        </div>
    </div>
@endsection
