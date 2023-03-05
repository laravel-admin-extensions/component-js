<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;
/**
 * Class Select
 * @package DLP\Assembly\Unit
 */
class Select extends Widget
{
    private $select;
    private $selected = '[]';
    private $limit = 1;
    private $placeholder = '未选择';
    private $menuHeight = '150px';
    private $useSearch = false;
    private $useHiddenInput = true;

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
        $this->selected = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
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
     * @param $placeholder
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @param $height
     * @return $this
     */
    public function menuHeight($height)
    {
        $this->menuHeight = $height;
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

    public function __invoke()
    {
        $this->annotate();
        $execute = ".mod({mode:true,placeholder: '{$this->placeholder}',height:'{$this->menuHeight}'})";
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
new ComponentDot("#{$this->column}",{$this->select},{$this->selected},{$this->limit}){$execute};
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
