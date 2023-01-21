<!DOCTYPE html>
<html lang="en">

<head>
    @include("admin.element.head")
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    @include("admin.element.sidebar_top")
                    @include("admin.element.sidebar_menu")
                </div>
            </div>

            <div class="top_nav">
                @include("admin.element.topbar")
            </div>

            @yield("content")

            @include("admin.element.footer")

        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="asset/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="js/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="asset/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="asset/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="asset/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>
</body>

</html>