@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Address ({{ $customer_address->address_title }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.customer_addresses.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Customer Addresses</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.customer_addresses.update', $customer_address->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="user_id">Customer</label>
                            <input type="text" class="form-control" name="customer_name" value="{{ $customer_address->user->full_name }}" readonly>
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $customer_address->user_id }}" readonly>
                            @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address_title">Address title</label>
                            <input type="text" name="address_title" value="{{ old('address_title', $customer_address->address_title) }}" class="form-control">
                            @error('address_title')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="default_address">Default address</label>
                            <select name="default_address" class="form-control">
                                <option value="0" {{ old('default_address', $customer_address->default_address) == '0' ? 'selected' : null }}>No</option>
                                <option value="1" {{ old('default_address', $customer_address->default_address) == '1' ? 'selected' : null }}>Yes</option>
                            </select>
                            @error('default_address')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $customer_address->first_name) }}" class="form-control">
                            @error('first_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $customer_address->last_name) }}" class="form-control">
                            @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email', $customer_address->email) }}" class="form-control">
                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $customer_address->mobile) }}" class="form-control">
                            @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value=""> --- </option>
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $customer_address->country_id) == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control">
                            </select>
                            @error('state_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                            </select>
                            @error('city_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{ old('address', $customer_address->address) }}" class="form-control">
                            @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address2">Address 2</label>
                            <input type="text" name="address2" value="{{ old('address2', $customer_address->address2) }}" class="form-control">
                            @error('address2')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="zip_code">ZIP code</label>
                            <input type="text" name="zip_code" value="{{ old('zip_code', $customer_address->zip_code) }}" class="form-control">
                            @error('zip_code')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="po_box">P.O.Box</label>
                            <input type="text" name="po_box" value="{{ old('po_box', $customer_address->po_box) }}" class="form-control">
                            @error('po_box')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Address</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/typeahead/bootstrap3-typeahead.min.js') }}"></script>
    <script>
        $(function () {
            populateStates();
            populateCities();

            $("#country_id").change(function () {
                populateStates();
                populateCities();
                return false;
            });

            $("#state_id").change(function () {
                populateCities();
                return false;
            });


            function populateStates()
            {
                let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : '{{ old('country_id', $customer_address->country_id) }}';
                $.get("{{ route('admin.states.get_states') }}", {country_id: countryIdVal}, function (data) {
                    $('option', $("#state_id")).remove();
                    $("#state_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('state_id', $customer_address->state_id) }}' ? "selected" : "";
                        $("#state_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

            function populateCities()
            {
                let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : '{{ old('state_id', $customer_address->state_id) }}';
                $.get("{{ route('admin.cities.get_cities') }}", {state_id: stateIdVal}, function (data) {
                    $('option', $("#city_id")).remove();
                    $("#city_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('city_id', $customer_address->city_id) }}' ? "selected" : "";
                        $("#city_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

        });
    </script>
@endsection
