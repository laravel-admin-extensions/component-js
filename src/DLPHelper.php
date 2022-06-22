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
        if(count($intersect) == count($selected) && count($intersect) == count($select)){
            return [$insert,$delete];
        }
        if(count($intersect) == count($selected) && count($intersect) < count($select)){
            $insert = array_diff($select,$intersect);
            return [$insert,$delete];
        }
        if(count($intersect) < count($selected) && count($intersect) == count($select)){
            $delete = array_diff($selected,$intersect);
            return [$insert,$delete];
        }
        if(count($intersect) < count($selected) && count($intersect) < count($select)){
            $insert = array_diff($select,$intersect);
            $delete = array_diff($selected,$intersect);
            return [$insert,$delete];
        }
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
