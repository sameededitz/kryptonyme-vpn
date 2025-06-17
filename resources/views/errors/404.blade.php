@extends('layouts.guest')
@section('title', __('Maintenance Mode'))
@section('content')
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-8 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4 text-center">
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('assets/images/logo-img.png') }}" width="90px" alt="logo" />
                                    <img src="{{ asset('assets/images/logo-text.png') }}" width="160px" alt="logo" />
                                </div>
                                <div class="mb-0 text-center">
                                    <img src="{{ asset('assets/images/errors/404.png') }}" width="200px" alt="logo" />
                                </div>
                                <h3 class="mt-2">Page Not Found</h3>
                                <p class="lead">
                                    Sorry, the page you are looking for does not exist.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection
