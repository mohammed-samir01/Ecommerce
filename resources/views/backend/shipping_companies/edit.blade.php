@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Shipping Company ({{ $shipping_company->name }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.shipping_companies.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Shipping Companies</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.shipping_companies.update', $shipping_company->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $shipping_company->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" value="{{ old('code', $shipping_company->code) }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" value="{{ old('description', $shipping_company->description) }}" class="form-control">
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="fast">Fast</label>
                            <select name="fast" class="form-control">
                                <option value="1" {{ old('fast', $shipping_company->fast) == '1' ? 'selected' : null }}>Yes</option>
                                <option value="0" {{ old('fast', $shipping_company->fast) == '0' ? 'selected' : null }}>No</option>
                            </select>
                            @error('fast')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="text" name="cost" value="{{ old('cost', $shipping_company->cost) }}" class="form-control">
                            @error('cost')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="status">status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $shipping_company->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $shipping_company->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="countries">Countries</label>
                            <select name="countries[]" class="form-control select-multiple-tags" multiple="multiple">
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}" {{ in_array($country->id, old('countries', $shipping_company->countries->pluck('id')->toArray())) ? 'selected' : null }}>{{ $country->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('countries')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Shipping Company</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function(){
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $('.select-multiple-tags').select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                match: matchStart
            });
        });
    </script>
@endsection
