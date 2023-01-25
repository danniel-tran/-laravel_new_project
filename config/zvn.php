<?php
return [
    'route' => [
        'prefix_admin'=>'admin'
    ],
    'format' => [
        'long_time'=>'H:i:s d/m/Y',
        'short_time'=>'d/m/Y'
    ],
    'template'         => [
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
            'block' => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'default'      => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ]    
    ],
]
?>