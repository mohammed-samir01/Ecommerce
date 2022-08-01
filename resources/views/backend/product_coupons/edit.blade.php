@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.date.css') }}">
    <style>
        .picker__select--month, .picker__select--year {
            padding: 0 !important;
        }
    </style>
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit coupon ({{ $productCoupon->code }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.product_coupons.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Coupons</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.product_coupons.update', $productCoupon->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $productCoupon->code) }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="">---</option>
                            <option value="fixed" {{ old('type', $productCoupon->type) == 'fixed' ? 'selected' : null }}>Fixed</option>
                            <option value="percentage" {{ old('type', $productCoupon->type) == 'percentage' ? 'selected' : null }}>Percentage</option>
                        </select>
                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" value="{{ old('value', $productCoupon->value) }}" class="form-control">
                            @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="use_times">Use times</label>
                            <input type="number" name="use_times" value="{{ old('use_times', $productCoupon->use_times) }}" class="form-control">
                            @error('use_times')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="start_date">Start date</label>
                            <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $productCoupon->start_date->format('Y-m-d')) }}" class="form-control">
                            @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="expire_date">Expire date</label>
                            <input type="text" name="expire_date" id="expire_date" value="{{ old('expire_date', $productCoupon->expire_date->format('Y-m-d')) }}" class="form-control">
                            @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="greater_than">Greater than</label>
                            <input type="number" name="greater_than" value="{{ old('greater_than', $productCoupon->greater_than) }}" class="form-control">
                            @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $productCoupon->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $productCoupon->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $productCoupon->description) }}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Coupon</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script>
        $(function(){
            $('#code').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $('#start_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });
            var startdate = $('#start_date').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            $('#start_date').change(function() {
                selected_ci_date ="";
                selected_ci_date = $('#start_date').val();
                if (selected_ci_date != null)   {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate()+1);
                    enddate.set('min', min_codate);
                }
            });

            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min : new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });

        });
    </script>
@endsection
