@php
    use App\Helper\Template;
    use App\Helper\Highlight;
@endphp

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Article Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index        = $key + 1;
                            $parityClass  = (fmod($index, 2) == 0) ? "even" : "odd";
                            $id           = $val["id"];
                            $name         = Highlight::show($val['name'],$params['search'],'name');
                            $content      = Highlight::show($val['content'],$params['search'],'content');
                            $status       = Template::showItemStatus($controllerName,$id,$val['status']);
                            $create       = Template::showItemHistory($val['created_by'],date(config("zvn.format.long_time") , strtotime($val['created'])) );
                            $modified     = Template::showItemHistory($val['modified_by'],date(config("zvn.format.long_time") , strtotime($val['modified'])) );
                            $thumb        = Template::showItemThumb($controllerName,$val['thumb'],$name);
                            $buttonAction = Template::showButtonAction($controllerName , $id);
                        @endphp
                        <tr class="{{ $parityClass }} pointer">
                            <td> {!! $index !!}</td>
                            <td width="40%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Content:</strong> {!! $content !!}</p>
                            </td>
                            <td>{!! $thumb !!}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $create !!}</td>
                            <td>{!! $modified !!}</td>
                            <td class="last">{!! $buttonAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include("admin.template.list_empty" ,['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>