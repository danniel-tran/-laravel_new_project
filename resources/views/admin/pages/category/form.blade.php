@extends("admin.main")
@php
    use App\Helper\Form as FormTemplate;
    use App\Helper\Template as Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $IsHomeValue      = ['default' => 'Select is home', 'yes' => config('zvn.template.is_home.yes.name'), 'no' => config('zvn.template.is_home.no.name')];
    $displayValue      = ['default' => 'Select is display', 'list' => config('zvn.template.display.list.name'), 'grid' => config('zvn.template.display.grid.name')];

    $inputHiddenID    = Form::hidden('id', @$item['id']);

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'label'   => Form::label('is_home', 'Is Home', $formLabelAttr),
            'element' => Form::select('is_home', $IsHomeValue, @$item['is_home'], $formInputAttr)
        ],
        [
            'label'   => Form::label('display', 'Display', $formLabelAttr),
            'element' => Form::select('display', $displayValue, @$item['display'], $formInputAttr)
        ],
        [
            'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp
@section("content")
<div class="right_col" role="main">
    @include("admin.template.page_header",["pageIndex" => false])
    @include("admin.template.show_error")
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include("admin.template.x_title",["title"=>"Form"])
                <div class="x_content">
                    <br>
                    {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                    {!! FormTemplate::show($elements) !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!--end-box-lists-->
</div>
@endsection