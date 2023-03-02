<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;
/**
 * Class Dot
 * @package DLP\Assembly\Unit
 */
class Linear extends Widget
{
    protected $columns;
    protected $options = [
        'sortable' => true,
        'delete' => true,
        'insert' => true,
    ];
    protected $data;
    protected $useHiddenInput = true;

    public function __construct(string $column, string $label)
    {
        parent::__construct($column, $label);

    }

    public function columns(array $columns)
    {
        $this->columns = json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_FORCE_OBJECT);
        return $this;
    }

    public function options($options)
    {
        $this->options = array_merge($this->options,$options);
        return $this;
    }

    public function load($data)
    {
        $this->data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        return $this;
    }

    public function withoutHiddenInput()
    {
        $this->useHiddenInput = false;
        return $this;
    }

    public function compile()
    {
        $this->annotate();
        $this->options = json_encode($this->options);
        $execute = '';
        if($this->useHiddenInput){
            $execute .= ".useHiddenInput('{$this->column}')";
        }
        if($this->data){
            $execute .= ".load($this->data)";
        }
        $execute .= '.make()';
        $content = <<<EOF
<div id="{$this->column}" {$this->annotation}></div>
<script>
new ComponentLine("#{$this->column}",{$this->columns},{$this->options}){$execute};
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
