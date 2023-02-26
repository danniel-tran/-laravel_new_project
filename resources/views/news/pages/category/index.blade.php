@extends("news.main")
@section("content")
<!-- Home -->
@include("news.block.slider")
<!-- Content Container -->
<div class="content_container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main_content">
                    <!-- Featured -->
                    @include("news.block.feature", ['itemsFeature' => []])
                    <!-- Category -->
                    @include("news.pages.category.child-index.category")
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <!-- Latest Posts -->
                    @include("news.block.latest_post", ["itemsLatest" => []]);
                    <!-- Advertisement -->
                    <!-- Extra -->
                    @include("news.block.advertisement",['itemsAdvertisement' => []])
                    <!-- Most Viewed -->
                    @include("news.block.most_viewed",['itemsMostViewed' => []])
                    <!-- Tags -->
                    @include("news.block.tags",['itemsTags' => []])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection