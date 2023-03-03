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
    protected $limit = 0;
    protected $useSearch = false;
    protected $useHiddenInput = true;

    public function __construct(string $column, array $select)
    {
        parent::__construct($column);
        $this->select = json_encode($select, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
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
