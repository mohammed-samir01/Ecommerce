@extends('layouts.admin-auth')
@section('content')


        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{route('login')}}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                 aria-describedby="usernameHelp"
                                                 value="{{ old('username') }}" placeholder="Enter your username">
                                        </div>
                                        @error('username')
                                             <span class="text-danger" >  {{ $message }} </span>
                                        @enderror



                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password" value="{{ old('password') }}" placeholder="Enter your password">
                                        </div>
                                        @error('password')
                                            <span class="text-danger" >  {{ $message }} </span>
                                        @enderror



                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>


                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="{{route('backend.forgot_password')}}">Forgot Password?</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

@endsection

