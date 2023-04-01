@extends("admin.main")

@section('content')
<div class="right_col" role="main">
    @include ('admin.template.page_header', ['pageIndex' => false])
    @include ('admin.template.show_error')
    @if ( $item['id'])
        <div class="row">
            @include('admin.pages.user.form_info')
            @include('admin.pages.user.form_change_password')
            @include('admin.pages.user.form_change_level')
        </div>
    @else
        @include('admin.pages.user.form_add')
    @endif
</div>
@endsection