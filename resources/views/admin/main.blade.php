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
    @include("admin.element.script")
</body>

</html>