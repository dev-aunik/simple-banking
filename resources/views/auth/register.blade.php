@extends('auth.layout.app')
@section('title', 'Register')
@section('content')
    <form class="form w-100" action="{{ route('register.post') }}" method="POST">
        @csrf
        @if (session()->has('success'))
            <div
                class="alert alert-dismissible bg-light-success d-flex flex-column align-items-center flex-sm-row w-100 p-3 mb-5">

                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <span>{{ session('success') }}</span>
                </div>

                <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                    <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span
                            class="path2"></span></i> </button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div
                    class="alert alert-dismissible bg-light-danger d-flex flex-column align-items-center flex-sm-row w-100 p-3 mb-5">

                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <span>{{ $error }}</span>
                    </div>

                    <button type="button"
                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                        data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span
                                class="path2"></span></i>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="text-center mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">Get Register Now</h1>
            <div class="text-gray-500 fw-semibold fs-6">Your Financial Security</div>
        </div>
        <div class="fv-row mb-8">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">Account Type</span>
            </label>
            <select name="account_type" class="form-control form-select form-select-lg form-select-solid"
                data-control="select2" data-placeholder="Select..." required>
                <option value="INDIVIDUAL">Individual</option>
                <option value="BUSINESS">Business</option>
            </select>
        </div>
        <div class="fv-row mb-8">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">Full Name</span>
            </label>
            <input type="text" placeholder="Name" name="name" autocomplete="off"
                class="form-control form-control-solid" value="{{ old('name') }}" required />
        </div>
        <div class="fv-row mb-8">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">Email Address</span>
            </label>
            <input type="email" placeholder="Email" name="email" autocomplete="off"
                class="form-control form-control-solid" value="{{ old('email') }}" required />
        </div>
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <div class="mb-1">
                <div class="position-relative mb-3">
                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                        <span class="required">Password</span>
                        <span class="ms-1" data-bs-toggle="tooltip" title="Mimimum 8 charecters">
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <input class="form-control form-control-solid" type="password" placeholder="Password" name="password"
                        autocomplete="off" vvalue="{{ old('password') }}" required />
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                        <i class="ki-duotone ki-eye-slash fs-2"></i>
                        <i class="ki-duotone ki-eye fs-2 d-none"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Sign up</span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
        </div>
    </form>
@endsection
