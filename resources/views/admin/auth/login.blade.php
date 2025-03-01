<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/admin_asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style type="text/css">
        .imgLogo {
            width: 100%;

            margin: 0px auto;

        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="/storage/images/eng20220810-3.jpg" class="imgLogo">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-3 mt-2">
                                    <div class="text-center mb-3">
                                        @if (session('error'))
                                            <div class="text-danger text-center">{{ session('error') }}</div>
                                        @endif
                                        @if (session('success'))
                                            <div class="text-success text-center">{{ session('success') }}</div>
                                        @endif
                                        <p class="login-box-msg pt-5">
                                          <h3>   ผู้ดูแลระบบและส่วนงาน  </h3>
                                        </p>
                                    </div>
                                    <br/>
                                        <a href="{{ $urlCMUOauth }}" class="btn btn-cmuOauth btn-user btn-block mt-2 btn-lg">
                                            <i class="fab fa-google fa-fw"></i> Login with CMU Account
                                        </a>

                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/admin_asset/vendor/jquery/jquery.min.js"></script>
    <script src="/admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/admin_asset/js/sb-admin-2.min.js"></script>
</body>

</html>
