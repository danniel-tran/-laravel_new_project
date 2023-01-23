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
                    <tr class="odd pointer">
                        <td>1</td>
                        <td width="40%">
                            <p><strong>Name:</strong> Ưu đãi học phí</p>
                            <p><strong>Description:</strong> Tổng hợp các trương trình ưu đãi học phí hàng tuần...</p>
                            <p><strong>Link:</strong> https://zendvn.com/uu-dai-hoc-phi-tai-zendvn/</p>
                            <p><img src="http://proj_news.xyz/images/slider/LWi6hINpXz.jpeg" alt="Ưu đãi học phí" class="zvn-thumb"></p>
                        </td>
                        <td><a href="http://proj_news.xyz/admin123/slider/change-status-active/3" type="button" class="btn btn-round btn-success">Kích hoạt</a></td>
                        <td>
                            <p><i class="fa fa-user"></i> admin</p>
                            <p><i class="fa fa-clock-o"></i> 24/04/2019</p>
                        </td>
                        <td>
                            <p><i class="fa fa-user"></i> admin</p>
                            <p><i class="fa fa-clock-o"></i> 24/04/2019</p>
                        </td>
                        <td class="last">
                            <div class="zvn-box-btn-filter"><a href="http://proj_news.xyz/admin123/slider/form/3" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a><a href="http://proj_news.xyz/admin123/slider/delete/3" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a></div>
                        </td>
                    </tr>
                @else
                    @include("admin.template.list_empty" ,['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>