@extends("admin.main")
@php
    use App\Helper\Template as Template;
    $xhtmlButtonFilter = Template::showButtonFilter($controllerName,$itemsStatusCount,$params['filter']['status'],$params['search']);
    $xhtmlAreaSearch   = Template::showAreaSearch($controllerName,$params['search']); 
@endphp
@section("content")
<div class="right_col" role="main">
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Danh sách Slider</h3>
        </div>
        <div class="zvn-add-new pull-right">
            <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
        </div>
    </div>
    @include ('admin.template.zvn_notify')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include("admin.template.x_title",["title"=>"Bộ lọc"])
                <div class="x_content"> 
                    <div class="row">
                        <div class="col-md-6">{!! $xhtmlButtonFilter !!}
                        </div>
                        <div class="col-md-6">
                            {!! $xhtmlAreaSearch !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include("admin.template.x_title",["title"=>"Danh sách"])
                @include("admin.pages.slider.list")
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include("admin.template.x_title",["title"=>"Phân trang"])
                @include("admin.template.pagination" ,["items" => $items])
            </div>
        </div>
    </div>
    <!--end-box-pagination-->
</div>
@endsection