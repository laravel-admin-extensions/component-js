<?php

namespace DLP;


/**
 * Class DLPHelper
 * @package DLP
 */
class DLPHelper
{
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
