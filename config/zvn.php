<?php
return [
    'route' => [
        'prefix_admin'=>'admin',
        'prefix_news'  => 'news_app',
    ],
    'format' => [
        'long_time'=>'H:i:s d/m/Y',
        'short_time'=>'d/m/Y'
    ],
    'template'         => [
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'status' => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
            'block'    => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'default'  => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
        'is_home'       => [
            'yes'      =>  ['name'=> 'Hiển thị', 'class'=> 'btn-primary'],
            'no'        => ['name'=> 'Không hiển thị', 'class'=> 'btn-warning']
        ],
        'display'       => [
            'list'      => ['name'=> 'Danh sách'],
            'grid'      => ['name'=> 'Lưới'],
        ],
        'search' => [
            'all'           => ['name'=> 'Search by All'],
            'id'            => ['name'=> 'Search by ID'],
            'name'          => ['name'=> 'Search by Name'],
            'username'      => ['name'=> 'Search by Username'],
            'fullname'      => ['name'=> 'Search by Fullname'],
            'email'         => ['name'=> 'Search by Email'],
            'description'   => ['name'=> 'Search by Description'],
            'link'          => ['name'=> 'Search by Link'],
            'content'       => ['name'=> 'Search by Content'],    
        ],
        'button'=>[
            'edit'      => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' => '/delete'],
        ]
    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'fullname'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete'],
            'category'  => ['edit', 'delete'],
            'article'   => ['edit', 'delete'],
            'rss'   => ['edit', 'delete'],
            'user'      => ['edit'],
        ]
    ]
]
?>