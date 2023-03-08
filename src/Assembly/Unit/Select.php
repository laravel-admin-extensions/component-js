<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;
use DLP\Assembly\Layout\Swing;
use DLP\Assembly\Wing;

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
    private $direction = 'down';
    private $useSearch = false;
    private $useHiddenInput = true;
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
     * @param string $direction   up | down | middle
     * @return $this
     */
    public function direction($direction)
    {
        $this->direction = $direction;
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
        $this->swing[$condition] = $swing();
        return $this;
    }

    public function __invoke()
    {
        $this->annotate();
        $execute = ".mod({mode:true,placeholder: '{$this->placeholder}',height:'{$this->menuHeight}',direction:'{$this->direction}'})";
        if($this->useSearch){
            $execute .= '.useSearch()';
        }
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
<script>new ComponentDot("#{$this->column}",{$this->select},{$this->selected},{$this->limit}){$execute};</script>
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
