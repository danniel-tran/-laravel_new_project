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
                    <th class="column-title">Info</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hiển thị Home</th>
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
                            $status       = Template::showItemStatus($controllerName,$id,$val['status']);
                            $isHome       = Template::showItemIsHome($controllerName,$id,$val['is_home']);
                            $create       = Template::showItemHistory($val['created_by'],date(config("zvn.format.long_time") , strtotime($val['created'])) );
                            $modified     = Template::showItemHistory($val['modified_by'],date(config("zvn.format.long_time") , strtotime($val['modified'])) );
                            $buttonAction = Template::showButtonAction($controllerName , $id);
                        @endphp
                        <tr class="{{ $parityClass }} pointer">
                            <td> {!! $index !!}</td>
                            <td width="40%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                            </td>
                            <td>{!! $status !!}</td>
                            <td>{!! $isHome !!}</td>
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