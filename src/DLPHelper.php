<?php

namespace DLP;


/**
 * Class DLPHelper
 * @package DLP
 */
class DLPHelper
{
    /**
     * dot增减计算
     * @param array $selected 过去已经选择
     * @param array $select 已选择
     * @return array [insert,delete]
     */
    public static function dotCalculate(array $selected,array $select)
    {
        $insert = [];
        $delete = [];
        $intersect = array_intersect($selected,$select);
        $intersect_count = count($intersect);
        $selected_count = count($selected);
        $select_count = count($select);
        if($intersect_count == $selected_count && $intersect_count == $select_count){
            return [$insert,$delete];
        }
        if($intersect_count == $selected_count && $intersect_count < $select_count){
            $insert = array_diff($select,$intersect);
            return [$insert,$delete];
        }
        if($intersect_count < $selected_count && $intersect_count == $select_count){
            $delete = array_diff($selected,$intersect);
            return [$insert,$delete];
        }
        if($intersect_count < $selected_count && $intersect_count < $select_count){
            $insert = array_diff($select,$intersect);
            $delete = array_diff($selected,$intersect);
            return [$insert,$delete];
        }
    }

    /**
     * 维度结构数据
     * [[key=>integer,val=>string,par=>integer],...]
     * @param array $data
     */
    public static function dimensionCalculate(array &$data)
    {
        foreach ($data as $key=>&$d){
            $parent_node = $d['par'];
            unset($d['par']);
            foreach ($data as &$val){
                if($val['key'] == $parent_node){
                    if(!isset($val['nodes'])){
                        $val['nodes'] = [];
                    }
                    $val['nodes'][] = $d;
                    unset($data[$key]);
                }
            }
        }
        $data = array_values($data);
    }

    /**
     * @param array $data
     * @return false|string
     */
    public static function safeJson(array $data)
    {
        self::recursiveJsonArray($data);
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param array $data
     */
    private static function recursiveJsonArray(array &$data)
    {
        foreach ($data as &$d) {
            if (is_array($d)) {
                self::recursiveJsonArray($d);
            } else {
                $d = str_replace(['"', '\'', ':', '\\', '{', '}', '[', ']','`'], '', $d);
            }
        }
    }
}
