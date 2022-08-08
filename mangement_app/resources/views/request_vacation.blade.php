@extends('layout.masterpage')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Request Vacation</h6>
                <form action="{{ route('add_request') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="vacation_id">
                            @foreach ($vacations as $vacation)
                                <option value="{{ $vacation->id }}">{{ $vacation->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Choise Vacation type</label>
                    </div>
                    <div class="mb-3">
                        <label for="start">Date: </label>

                        <input class="form-control" type="date" id="start" name="date" value="{{ date('Y-m-d') }}"
                            min="({{ date('Y-m-d') }})" max="(DATE)">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
