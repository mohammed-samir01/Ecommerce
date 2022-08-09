@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit City {{ $city->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Cities</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.cities.update', $city->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $city->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="state_id">State</label>
                        <select name="state_id" class="form-control">
                            <option value=""> --- </option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id', $city->country_id) == $state->id ? 'selected' : null }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $city->status) == '1' ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $city->status) == '0' ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update City</button>
                </div>
            </form>
        </div>
    </div>

@endsection
