<?php

namespace DLP;

use Encore\Admin\Admin;
use Encore\Admin\Form;

/**
 * 点
 * Class Dot
 * @package DLP
 */
class Dot
{
    /**
     * @param Form $form
     * @param string $column  字段名
     * @param string $title   名称
     * @param array $select   全部选项
     * @param array $selected 已选择选项
     * @param bool $strict    json严格模式 消除json敏感字符问题
     */
    public static function makeComponentDot(Form $form, string $column, string $title, array $select = [], array $selected = [],bool $strict = false)
    {
        if ($strict) {
            $select = DLPHelper::safeJson($select);
            $selected = DLPHelper::safeJson($selected);
        } else {
            $select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
            $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        }
        Admin::script(<<<EOF
componentDot("{$column}",JSON.parse('{$selected}'),JSON.parse('{$select}'));
EOF
        );
        $form->html("<div id='{$column}'></div>", $title);
    }
}
