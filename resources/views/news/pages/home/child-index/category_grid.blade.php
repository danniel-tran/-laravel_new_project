<div class="world">
    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
        <div>
            <div class="section_title">{{$itemCategory['name']}}</div>
        </div>
        <div class="section_bar"></div>
    </div>
    <div class="row world_row">
        <div class="col-lg-11">
            <div class="row">
                @foreach($itemCategory['articles'] as $article)
                    <div class="col-lg-6">
                        <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                            @include('news.partials.article.image', ['item' => $article ])
                            @include('news.partials.article.content', ['item' => $article, 'lenghtContent' => 0, 'showCategory' => false ])
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="the-loai/so-hoa-6.html">Xem
                        thêm</a></div>
            </div>
        </div>
    </div>
</div>