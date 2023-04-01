<!DOCTYPE html>
<html lang="en">

<head>
    @include("news.element.head")
</head>

<body>
    <div class="super_container">
        <!-- Header -->
        @include("news.element.header")
        
        <!-- Content -->
        @yield("content")

        <!-- Footer -->
        @include("news.element.footer")
    </div>
    @include("news.element.script")
</body>

</html>