@php
    use App\Helper\Template;
@endphp

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Slider Info</th>
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
                            $name         = $val['name'];
                            $description  = $val['description'];
                            $link         = $val['link'];
                            $thumb        = $val['thumb'];
                            $status       = Template::showItemStatus($controllerName,$id,$val['status']);
                            $create       = Template::showItemHistory($val['created_by'],date(config("zvn.format.long_time") , strtotime($val['created'])) );
                            $modified     = Template::showItemHistory($val['modified_by'],date(config("zvn.format.long_time") , strtotime($val['modified'])) );
                            $thumb        = Template::showItemThumb($controllerName,$val['thumb'],$name);
                            $buttonAction = Template::showButtonAction($controllerName , $id);
                        @endphp
                        <tr class="{{ $parityClass }} pointer">
                            <td> {{ $index }}</td>
                            <td width="40%">
                                <p><strong>Name:</strong> {{ $name }}</p>
                                <p><strong>Description:</strong> {{ $description }}</p>
                                <p><strong>Link:</strong> {{ $link }}</p>
                                <p>{!! $thumb !!}</p>
                            </td>
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