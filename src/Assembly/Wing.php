<?php

namespace DLP\Assembly;


use DLP\Assembly\Unit\Datetime;
use DLP\Assembly\Unit\FileInput;
use DLP\Assembly\Unit\Hidden;
use DLP\Assembly\Unit\Html;
use DLP\Assembly\Unit\Input;
use DLP\Assembly\Unit\Select;
use DLP\Assembly\Unit\Dot;
use DLP\Assembly\Unit\Text;
use DLP\Assembly\Unit\Textarea;
use DLP\Tool\Assistant;

/**
 * Class Wing
 * @package DLP\Assembly
 */
class Wing
{
    private $form;
    private $documents = [];

    /**
     * @param string $column
     * @param string $label
     */
    public function text(string $column, string $label)
    {
        $doc = new Text($column, $label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     */
    public function display(string $column, string $label)
    {
        $doc = new Text($column, $label);
        $doc->disabled()->setStyle(['background' => '#e7e7e7']);
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
        $doc = new Textarea($column, $label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     * @param array $select
     */
    public function dot(string $column, string $label, array $select)
    {
        $doc = new Dot($column, $label, $select);
        $doc->setStyle(['width' => '100%', 'height' => '220px']);
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
        $doc = new Select($column, $label, $select);
        $doc->setStyle(['width' => '240px']);
        $this->documents[] = $doc;
        return $doc;
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
        $doc = new Datetime($column, $label);
        $this->documents[] = $doc;
        return $doc;
    }

    /**
     * @param string $column
     * @param string $label
     */
    public function fileInput(string $column, string $label)
    {
        $doc = new FileInput($column, $label);
        $doc->setStyle([]);
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
        $doc = new Html($column, $label, $content);
        $this->documents[] = $doc;
        return $doc;
    }

    public function form(array $attributes = [])
    {
        $attributes = array_merge(['accept-charset'=>'UTF-8','enctype'=>'multipart/form-data'],$attributes);
        $attrs = Assistant::arrayKv2String($attributes, '=', ' ');
        $this->form = <<<EOF
<form class="dlp" {$attrs}>
    <div>%s</div>
</form>
EOF;
        return $this;
    }

    public function compile()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document->compile();
        }
        if ($this->form) $html = sprintf($this->form, $html);

        return $html;
    }
}
