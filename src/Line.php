<?php

namespace DLP;

use Encore\Admin\Admin;
use Encore\Admin\Form;

/**
 * 线
 * Class Line
 * @package DLP
 */
class Line
{
    /**
     * @param Form $form
     * @param string $column  字段名
     * @param string $title   名称
     * @param array $settings  设置项
     * @param array $data     数据
     * @param bool $strict    json严格模式 消除json敏感字符问题
     */
    public static function makeComponentLine(Form $form, string $column, string $title, array $settings = [], array $data = [], bool $strict = false)
    {
        if($strict) {
            $data = DLPHelper::safeJson($data);
        }else{
            $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        }
        $settings = json_encode($settings, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        Admin::script(<<<EOF
componentLine("{$column}",JSON.parse('{$settings}'),JSON.parse('{$data}'));
EOF
        );
        $form->html("<div id='{$column}'></div>", $title);
    }
}
