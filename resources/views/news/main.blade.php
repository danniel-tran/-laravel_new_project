<!DOCTYPE html>
<html lang="en">

<head>
    @include("news.element.head")
</head>

<body>
    <div class="super_container">
        @yield("content")
    </div>
    @include("news.element.script")
</body>

</html>