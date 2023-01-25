<?php

namespace App\Helper;

class Template
{
    public static function showButtonFilter($controllerName, $itemsStatusCount,$currentStatusCount)
    {
        $xhtml = "";
        $tmpStatus = config("zvn.template.status");
        array_unshift(
            $itemsStatusCount,
            [
                "count" => array_sum(array_column($itemsStatusCount, "count")),
                "status" => "all"
            ]
        );
        if (count($itemsStatusCount) > 0) {
            foreach ($itemsStatusCount as $item) {
                $statusValue = (array_key_exists($item['status'], $tmpStatus)) ? $item['status'] : "default";
                $currentTemplateStatus = $tmpStatus[strtolower($statusValue)];
                $link = route($controllerName) . "?filter_status=$statusValue";
                $btn_class = ($currentStatusCount == $statusValue) ? "btn-primary" : "btn-success";
                $xhtml .= '
                    <a href="' . $link . ' " type="button" class="btn '. $btn_class .'">
                        ' . $currentTemplateStatus['name'] . ' 
                        <span class="badge bg-white">' . $item['count'] . '</span>
                    </a>
                ';
            }
        }
        return $xhtml;
    }

    public static function showItemHistory($by, $time)
    {
        $xhtml = '
            <p><i class="fa fa-user"></i> ' . $by . '</p>
            <p><i class="fa fa-clock-o"></i> ' . $time . '</p>
        ';
        return $xhtml;
    }
    public static function showItemStatus($controllerName, $id, $statusValue)
    {
        $tmpStatus = config("zvn.template.status");
        $statusValue = (array_key_exists($statusValue, $tmpStatus)) ? $statusValue : "default";
        $currentTemplateStatus = $tmpStatus[strtolower($statusValue)];
        $link = route($controllerName, "/status", ["status" => $statusValue, "id" => $id]);
        $xhtml = '
            <a href="' . $link . '" type="button" 
            class="btn btn-round ' . $currentTemplateStatus['class'] . '">' . $currentTemplateStatus['name'] . '
            </a>
        ';
        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumb, $name)
    {
        $link = asset("images/$controllerName/$thumb");
        $xhtml = '
            <img src="' . $link . '" alt="' . $name . '" class="zvn-thumb">
        ';
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $tmplButton = [
            'edit'      => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' => '/delete'],
        ];

        $buttonInArea = [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete'],
        ];
        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listButton = $buttonInArea[$controllerName];

        $xhtml = '<div class="zvn-box-btn-filter">';
        foreach ($listButton as $btn) {
            $currentButton = $tmplButton[$btn];
            $link = route($controllerName . $currentButton['route-name'], ["id" => $id]);
            $xhtml .= '
                <a href="' . $link . '" type="button" class="btn btn-icon ' . $currentButton['class'] . '" 
                data-toggle="tooltip" data-placement="top" data-original-title="' . $currentButton['title'] . '">
                    <i class="fa ' . $currentButton['icon'] . '"></i>
                </a>
            ';
        }
        $xhtml .= '</div>';
        return $xhtml;
    }
}
