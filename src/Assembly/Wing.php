<?php

namespace DLP\Assembly;


use DLP\Assembly\Layout\Section;
use DLP\Assembly\Unit\CascadeDot;
use DLP\Assembly\Unit\CascadeLine;
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
    private $layout;
    private $documents = [];

    /**
     * @param string $column
     */
    public function text(string $column)
    {
        $doc = new Text($column);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @return Text
     */
    public function display(string $column)
    {
        $doc = new Text($column);
        $doc->disabled()->setStyle(['background' => '#e7e7e7']);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param string $value
     * @return Hidden
     */
    public function hidden(string $column, string $value)
    {
        $doc = new Hidden($column, $value);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @return Textarea
     */
    public function textarea(string $column)
    {
        $doc = new Textarea($column);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param array $select
     * @return Dot
     */
    public function dot(string $column, array $select)
    {
        $doc = new Dot($column, $select);
        $doc->setStyle(['width' => '100%', 'height' => '220px']);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param array $select
     * @return Dot
     */
    public function cascadeDot(string $column, array $select)
    {
        $doc = new CascadeDot($column, $select);
        $doc->setStyle(['width' => '100%', 'height' => '240px']);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param array $data
     * @return Dot
     */
    public function cascadeLine(string $column, array $data)
    {
        $doc = new CascadeLine($column, $data);
        $doc->setStyle(['width' => '100%', 'height' => '240px']);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param array $select
     * @return Select
     */
    public function select(string $column, array $select)
    {
        $doc = new Select($column, $select);
        $doc->setStyle(['width' => '240px']);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @return Datetime
     */
    public function datepicker(string $column)
    {
        $doc = new Datetime($column);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @return FileInput
     */
    public function fileInput(string $column)
    {
        $doc = new FileInput($column);
        $doc->setStyle([]);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param string $column
     * @param string $content
     * @return Html
     */
    public function html(string $column, string $content)
    {
        $doc = new Html($column, $content);
        if ($this->layout instanceof Section) {
            $this->layout->append($doc);
        } else {
            $this->documents[] = $doc;
        }
        return $doc;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function form(array $attributes = [])
    {
        $attributes = array_merge(['accept-charset' => 'UTF-8', 'enctype' => 'multipart/form-data','class'=>'"dlp dlp-form"'], $attributes);
        $attrs = Assistant::arrayKv2String($attributes, '=', ' ');
        $this->form = <<<EOF
<form {$attrs}>
    %s
</form>
EOF;
        return $this;
    }

    /**
     * @param \Closure $closure
     * @param int $cols
     * @param string $style
     */
    public function section(\Closure $closure, $cols = 2, $style = '')
    {
        if($this->layout != null)throw new \Exception('layout has already been declared');
        $this->layout = new Section($cols, $style);
        $closure($this);
        $this->documents[] = $this->layout;
        $this->layout = null;
    }

    public function __invoke()
    {
        $html = "";
        foreach ($this->documents as $document) {
            $html .= $document();
        }
        if ($this->form) $html = sprintf($this->form, $html);

        return $html;
    }
}
