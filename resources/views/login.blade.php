<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Unveritas Nurul jadid</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank app-blank">
    <div class="d-flex flex-column flex-root bg-white" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 w-sm-100  p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-100 w-sm-100 p-10">
                        @include('errors.alert')
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('auth_login') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Login</h1>
                            </div>
                            <div class="fv-row mb-8">
                                <label class="d-flex align-items-center fw-bold mb-2">
                                    <span class="required">Email</span>
                                </label>
                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"  autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-3" data-kt-password-meter="true">
                                <label class="d-flex align-items-center fw-bold mb-2">
                                    <span class="required">Password</span>
                                </label>
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password"
                                        name="password" autocomplete="off" />
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye d-none"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">Login</span>
                                    <span class="indicator-progress">Tunggu Sebentar...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-lg-row-fluid w-lg-50  w-sm-100 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url({{ asset('assets/media/background.jpg') }});" >
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <a class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset('assets/media/unuja.png') }}" class="h-100px h-lg-200px" />
                    </a>
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Universitas Nurul
                        Jadid</h1>
                    <div class="d-none d-lg-block text-white fs-base text-center"><span
                            class="text-warning fw-bold me-1">Unveritas Nurul jadid</span>
                        Karanganyar, Paiton, Probolinggo
                        Jawa Timur,
                        Kode Pos: 67291
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/costum/sign_in.js') }}"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
</body>
<!--end::Body-->

</html>
