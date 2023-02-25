<?php

namespace DLP\Form;


/**
 * Class Panel
 * @package DLP\Form
 */
class Panel
{
    private $documents = [];

    /**
     * @param string $column
     * @param string $label
     */
    public function text(string $column, string $label)
    {
        $doc = new Input('text', $column, $label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     */
    public function display(string $column, string $label)
    {
        $doc = new Input('text', $column, $label);
        $doc->disabled();
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $value
     */
    public function hidden(string $column, string $value)
    {
        $doc = new Hidden($column, $value);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     */
    public function textarea(string $column, string $label)
    {
        $doc = new Textarea($column,$label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     * @param array $select
     */
    public function select(string $column, string $label, array $select)
    {

    }

    /**
     * @param string $column
     * @param string $label
     * @param array $select
     */
    public function dot(string $column, string $label, array $select)
    {
        
    }

    /**
     * @param string $column
     * @param string $label
     * @param array $settings
     *          format: [YYYY-MM-DD HH:mm:ss | YYYY-MM-DD | YYYY ]
     *          locale 语言配置
     */
    public function datepicker(string $column, string $label)
    {
        $doc = new Datetime($column,$label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     */
    public function fileInput(string $column, string $label)
    {
        $doc = new FileInput($column,$label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $content
     */
    public function html(string $column, string $label, string $content)
    {
       
    }

    public function compile()
    {
        $html = "";
        foreach ($this->documents as $document){
            $html .= $document->compile();
        }
        return <<<EOF
<form class="dlp" accept-charset="UTF-8" method="post">
    <div>{$html}</div>
</form>
EOF;
    }
}
