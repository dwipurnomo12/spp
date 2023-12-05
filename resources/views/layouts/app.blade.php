<!DOCTYPE html>
<html lang="en">

<head>
    <title>Authentikasi Akun</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="/auth/assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="/auth/assets/css/style.css">
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content">
        @yield('auth')
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="/auth/assets/js/vendor-all.min.js"></script>
<script src="/auth/assets/js/plugins/bootstrap.min.js"></script>
<script src="/auth/assets/js/ripple.js"></script>
<script src="/auth/assets/js/pcoded.min.js"></script>


</body>

</html>
