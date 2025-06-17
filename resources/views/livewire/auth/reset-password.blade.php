@section('title', 'Reset Password')
<div>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('assets/images/logo-img.png') }}" width="80px" class="me-4"
                                        alt="logo" />
                                </div>
                                <div class="text-center mb-4">
                                    <p class="mb-0">Reset your password below</p>
                                </div>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <x-alert type="danger" :message="$error" />
                                    @endforeach
                                @endif
                                <div class="form-body">
                                    <form class="row g-3" wire:submit.prevent="resetPassword">
                                        <input type="hidden" wire:model="token">
                                        <input type="hidden" wire:model="email">

                                        <div class="col-12">
                                            <label for="inputNewPassword" class="form-label">New Password</label>
                                            <div class="input-group" x-data="{ show: false }">
                                                <input :type="show ? 'text' : 'password'" class="form-control border-end-0"
                                                    id="inputNewPassword" wire:model="password"
                                                    placeholder="Enter New Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent" @click="show = !show">
                                                    <i :class="show ? 'bx bx-show' : 'bx bx-hide'"></i>
                                                </a>
                                            </div>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                            <div class="input-group" x-data="{ show: false }">
                                                <input :type="show ? 'text' : 'password'" class="form-control"
                                                    id="inputConfirmPassword" wire:model="password_confirmation"
                                                    placeholder="Confirm New Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent" @click="show = !show">
                                                    <i :class="show ? 'bx bx-show' : 'bx bx-hide'"></i>
                                                </a>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" wire:click="resetPassword"
                                                    class="btn btn-light">Reset Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
