<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;

/**
 * Class CascadeDot
 * @package DLP\Assembly\Unit
 */
class CascadeDot extends Widget
{
    protected $select;
    protected $selected = [];
    protected $style = ['height'=>'270px'];
    protected $limit = 0;
    protected $useSearch = false;
    protected $useHiddenInput = true;

    public function __construct(string $column, array $select)
    {
        parent::__construct($column);
        $this->select = json_encode($select, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function selected(array $data)
    {
        $this->selected = $data;
        return $this;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function limit(int $num)
    {
        $this->limit = $num;
        return $this;
    }

    /**
     * @return $this
     */
    public function useSearch()
    {
        $this->useSearch = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutHiddenInput()
    {
        $this->useHiddenInput = false;
        return $this;
    }

    public function compile()
    {
        $this->select = <<<EOF
[
        {
            "key": 1,
            "val": "上装",
            "nodes": [
                {
                    "key": 101,
                    "val": "西服"
                },
                {
                    "key": 102,
                    "val": "背心", 'nodes': [
                        {
                            key: 1001, 'val': '短背心'
                        },
                        {
                            key: 1002, 'val': '紧身背心'
                        },
                        {
                            key: 1003, 'val': '花背心'
                        },
                        {
                            key: 1004, 'val': '粉背心'
                        }
                    ]
                },
                {
                    "key": 103,
                    "val": "皮衣",
                    "nodes": [
                        {
                            "key": 1005,
                            "val": "牛皮"
                        },
                        {
                            "key": 1006,
                            "val": "貂皮"
                        },
                        {
                            "key": 1007,
                            "val": "犀牛皮"
                        }
                    ]
                },
                {
                    "key": 104,
                    "val": "衬衫",
                    "nodes": [
                        {
                            "key": 1009,
                            "val": "长袖"
                        },
                        {
                            "key": 1010,
                            "val": "短袖"
                        },
                        {
                            "key": 1011,
                            "val": "开衫"
                        },
                        {
                            "key": 1012,
                            "val": "露背衫"
                        }
                    ]
                }
            ]
        },
        {
            "key": 2,
            "val": "头饰",
            "nodes": [
                {
                    "key": 201,
                    "val": "口罩"
                },
                {
                    "key": 202,
                    "val": "帽子", 'nodes': [
                        {
                            key: 2001, 'val': '太阳帽'
                        },
                        {
                            key: 2002, 'val': '睡帽'
                        },
                        {
                            key: 2003, 'val': '贝雷帽'
                        },
                        {
                            key: 2004, 'val': '鸭舌帽'
                        },
                        {
                            key: 2005, 'val': '草帽'
                        }
                    ]
                },
                {
                    "key": 203,
                    "val": "眼镜",
                    "nodes": [
                        {
                            "key": 2006,
                            "val": "墨镜"
                        },
                        {
                            "key": 2007,
                            "val": "近视眼镜"
                        },
                        {
                            "key": 2008,
                            "val": "太阳眼镜"
                        }
                    ]
                }
            ]
        },
        {
            "key": 3,
            "val": "下装",
            "nodes": [
                {
                    "key": 301,
                    "val": "裙子",
                    "nodes": [
                        {
                            "key": 1035,
                            "val": "超短裙"
                        },
                        {
                            "key": 1036,
                            "val": "短裙"
                        },
                        {
                            "key": 1037,
                            "val": "连衣裙"
                        },
                        {
                            "key": 1038,
                            "val": "长裙"
                        }
                    ]
                },
                {
                    "key": 302,
                    "val": "裤子",
                    "nodes": [
                        {
                            "key": 1050,
                            "val": "超短裤"
                        },
                        {
                            "key": 1051,
                            "val": "短裤"
                        },
                        {
                            "key": 1052,
                            "val": "皮裤"
                        },
                        {
                            "key": 1053,
                            "val": "长裤"
                        },
                        {
                            "key": 1054,
                            "val": "牛仔裤"
                        },
                        {
                            "key": 1055,
                            "val": "开档裤"
                        }
                    ]
                },
                {
                    "key": 303,
                    "val": "腿袜",
                    "nodes":[
                        {
                            "key": 1101,
                            "val": "短袜"
                        },
                        {
                            "key": 1102,
                            "val": "船袜"
                        },
                        {
                            "key": 1103,
                            "val": "丝袜"
                        },
                        {
                            "key": 1104,
                            "val": "连裤袜"
                        },
                        {
                            "key": 1105,
                            "val": "蕾絲"
                        },
                        {
                            "key": 1106,
                            "val": "波光丝袜"
                        },
                        {
                            "key": 1107,
                            "val": "吊襪裤袜"
                        }
                    ]
                },
            ]
        },
        {
            "key": 4,
            "val": "内衣",
            "nodes": [
                {
                    "key": 401,
                    "val": "胸罩",
                    'nodes': [
                        {
                            key: 1111, 'val': '魔术胸罩'
                        },
                        {
                            key: 1112, 'val': '休闲胸罩'
                        },
                        {
                            key: 1113, 'val': '透明胸罩'
                        },
                        {
                            key: 1114, 'val': '蕾丝吊带'
                        }
                    ]
                },
                {
                    "key": 402,
                    "val": "内裤",
                    'nodes': [
                        {
                            key: 1115, 'val': '花边内裤'
                        },
                        {
                            key: 1116, 'val': '三角内裤'
                        },
                        {
                            key: 1117, 'val': '四角内裤'
                        },
                        {
                            key: 1118, 'val': '性感内裤'
                        }
                    ]
                }
            ]
        }
    ]
EOF;

        $this->selected = json_encode($this->selected);
        $this->annotate();
        $execute = '';
        if($this->useSearch){
            $execute .= '.useSearch()';
        }
        if($this->useHiddenInput){
            $execute .= ".useHiddenInput('{$this->column}')";
        }
        $execute .= '.make()';
        $content = <<<EOF
<div id="{$this->column}" {$this->annotation}></div>
<script>
new ComponentCascadeDot("#{$this->column}",{$this->select},{$this->selected},{$this->limit}){$execute};
</script>
EOF;
        if(!$this->label) return $content;
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
