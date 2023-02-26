<?php


namespace DLP\Assembly\Unit;


/**
 * Class Dot
 * @package DLP\Assembly\Unit
 */
class Dot extends Widget
{
    protected $select;
    protected $selected = '[]';
    protected $limit = 0;
    protected $useSearch = 'false';

    public function __construct(string $column, string $label, array $select)
    {
        parent::__construct($column, $label);
        $this->select = json_encode($select, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
    }

    public function selected(array $data)
    {
        $this->selected = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        return $this;
    }

    public function limit(int $num)
    {
        $this->limit = $num;
        return $this;
    }

    public function useSearch()
    {
        $this->useSearch ='true';
        return $this;
    }

    public function compile()
    {
        $this->settings = (string)join(' ', $this->settings);
        $content = <<<EOF
<div id="{$this->column}" {$this->settings}></div>
<script>
new ComponentDot("{$this->column}",{$this->select},{$this->selected},{$this->limit},{useSearch:{$this->useSearch}});
</script>
EOF;
        if($this->pure) return $content;
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
