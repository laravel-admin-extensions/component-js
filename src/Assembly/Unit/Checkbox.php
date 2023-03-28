<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;
use DLP\Assembly\Layout\Swing;
use DLP\Assembly\Wing;

/**
 * Class Checkbox
 * @package DLP\Assembly\Unit
 */
class Checkbox extends Widget
{
    private $select;
    private $selected = '[]';
    private $limit = 1;
    private $useHiddenInput = true;
    private $color = '';
    private Wing $wing;
    private $swing = [];

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
     * @param $color
     *          red blue green yellow
     * @return $this
     */
    public function color($color)
    {
        switch ($color) {
            case "red":
            case "blue":
            case "green":
            case "yellow":
            $this->color = '-'.$color;
                break;
        }
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

    /**
     * @param Wing $wing
     */
    public function setWing(Wing $wing)
    {
        $this->wing = $wing;
    }

    /**
     * @param $condition integer | array
     * @param \Closure $closure
     * @return $this
     */
    public function when($condition,\Closure $closure)
    {
        if(!is_array($condition)){
            $condition = [$condition];
        }
        $condition = join('.',$condition);
        $swing = new Swing($this->column);
        $this->wing->swing($swing,$closure);
        $this->swing[$condition] = (string)$swing;
        return $this;
    }

    public function __toString()
    {
        $this->annotate();
        $execute = ".switchMod({color:'{$this->color}'})";
        if($this->useHiddenInput){
            $execute .= ".useHiddenInput('{$this->column}')";
        }
        if(!empty($this->swing)){
            $swing = json_encode($this->swing);
            $execute .= <<<EOF
.trigger(function (select) {
    let swing = {$swing};
    if(document.querySelector('#dlp-swing-{$this->column}'))document.querySelector('#dlp-swing-{$this->column}').remove();
    if(swing[select.join('.')] !== undefined){
        let aim = document.querySelector('#{$this->column}');
        if(aim.parentNode.classList.contains("dlp-form-row")) aim = aim.parentNode;
        let fragment = document.createRange().createContextualFragment(swing[select.join('.')]);
        aim.parentNode.insertBefore(fragment, aim.nextSibling);
    }
})
EOF;
        }
        $execute .= '.make()';
        $content = <<<EOF
<div id="{$this->column}" {$this->annotation}></div>
<script>new ComponentDot("#{$this->column}",{$this->select}).selected({$this->selected}).limitNum({$this->limit}){$execute};</script>
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
