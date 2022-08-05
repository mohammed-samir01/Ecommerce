@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit State {{ $state->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.states.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">States</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.states.update', $state->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $state->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="country_id">Country</label>
                        <select name="country_id" class="form-control">
                            <option value=""> --- </option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $state->country_id) == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $state->status) == '1' ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $state->status) == '0' ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update State</button>
                </div>
            </form>
        </div>
    </div>

@endsection
