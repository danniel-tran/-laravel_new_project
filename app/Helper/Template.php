<?php

namespace App\Helper;

use Illuminate\Support\Facades\Config;

class Template
{
    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentStatusCount, $paramsSearch)
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
                if ($paramsSearch["value"] != "") {
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" .  $paramsSearch['value'];
                }
                $xhtml .= '
                    <a href="' . $link . '" type="button" class="btn ' . $btn_class . '" >
                        ' . $currentTemplateStatus['name'] . '
                        <span class="badge bg-white">' . $item['count'] . '</span>
                    </a>
                ';
            }
        }
        return $xhtml;
    }

    public static function showAreaSearch($controllerName, $paramsSearch)
    {
        $xhtml = null;
        $tmplField         = Config::get('zvn.template.search');
        $fieldInController = Config::get('zvn.config.search');
        $controllerName    = array_key_exists($controllerName, $fieldInController) ? $controllerName : "default";
        $xhtmlField        = '';
        $searchField       = in_array($paramsSearch['field'], $fieldInController[$controllerName]) ? $paramsSearch['field'] : "all";
        foreach ($fieldInController[$controllerName] as $field) {
            $xhtmlField .= '<li><a href="#" class="select-field" data-field="' . $field . '">' . $tmplField[$field]['name'] . '</a></li>';
        };
        $xhtml = '
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
                            ' . $tmplField[$searchField]['name'] . ' <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            ' . $xhtmlField . '
                        </ul>
                    </div>
                    <input type="text" class="form-control" name="search_value" value="' . $paramsSearch['value'] . '">
                    <span class="input-group-btn">
                        <button id="btn-clear" type="button" class="btn btn-success" style="margin-right: 0px">Xóa tìm kiếm</button>
                        <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                    </span>
                    <input type="hidden" name="search_field" value="' . $searchField . '">
                </div>';

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
        $tmplButton = Config::get("zvn.template.button");

        $buttonInArea = config("zvn.config.button");
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
