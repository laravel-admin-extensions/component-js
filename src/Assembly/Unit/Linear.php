<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Widget;

/**
 * Class Linear
 * @package DLP\Assembly\Unit
 */
class Linear extends Widget
{
    private $columns;
    private $options = [
        'sortable' => true,
        'delete' => true,
        'insert' => true,
        'isomer' => false
    ];
    private $data;
    private $useHiddenInput = true;

    public function __construct(string $column,array $columnSetting)
    {
        parent::__construct($column);
        $this->columns = json_encode($columnSetting, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_FORCE_OBJECT);
    }

    /**
     * @param $options
     * @example ['sortable' => true,'delete' => true,'insert' => true,'isomer' => false]
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = array_merge($this->options,$options);
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function load($data)
    {
        $this->data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
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
        if(!$this->label) return $content;
        return <<<EOF
<div class="dlp dlp-form-row">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
