@foreach ($itemsCategory as $itemCategory)
    @if($itemCategory['display'] == 'list')
        @include('news.pages.category.child-index.category_list',['itemCategory' => $itemCategory])
    @elseif($itemCategory['display'] == 'grid')
        @include('news.pages.category.child-index.category_grid',['itemCategory' => $itemCategory])
    @endif
@endforeach