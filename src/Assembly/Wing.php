<?php

namespace DLP\Assembly;


use DLP\Assembly\Abs\Component;
use DLP\Assembly\Abs\Layout;
use DLP\Assembly\Layout\Section;
use DLP\Assembly\Layout\Swing;
use DLP\Assembly\Unit\CascadeDot;
use DLP\Assembly\Unit\CascadeLine;
use DLP\Assembly\Unit\Datetime;
use DLP\Assembly\Unit\FileInput;
use DLP\Assembly\Unit\Hidden;
use DLP\Assembly\Unit\Html;
use DLP\Assembly\Unit\Input;
use DLP\Assembly\Unit\Linear;
use DLP\Assembly\Unit\Select;
use DLP\Assembly\Unit\Dot;
use DLP\Assembly\Unit\Text;
use DLP\Assembly\Unit\Textarea;
use DLP\Tool\Assistant;

/**
 * Class Wing
 * @package DLP\Assembly
 */
class Wing implements Layout
{
    private $form;
    private $layout;
    private $documents = [];
    private Layout $node;

    public function __construct()
    {
        $this->node = $this;
    }

    /**
     * @param string $column
     */
    public function text(string $column)
    {
        $doc = new Text($column);
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param string $column
     * @return Text
     */
    public function display(string $column)
    {
        $doc = new Text($column);
        $doc->disabled()->setStyle(['background' => '#ffffff', 'cursor' => 'not-allowed']);
        $this->node->append($doc);
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
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param string $column
     * @return Textarea
     */
    public function textarea(string $column)
    {
        $doc = new Textarea($column);
        $this->node->append($doc);
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
        $doc->setWing($this);
        $doc->setStyle(['width' => '240px']);
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param string $column
     * @return Datetime
     */
    public function datepicker(string $column)
    {
        $doc = new Datetime($column);
        $this->node->append($doc);
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
        $this->node->append($doc);
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
        $this->node->append($doc);
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
        $this->node->append($doc);
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
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param string $column
     * @param array $data
     * @return CascadeLine
     */
    public function cascadeLine(string $column, array $data)
    {
        $doc = new CascadeLine($column, $data);
        $doc->setStyle(['width' => '100%', 'height' => '240px']);
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param string $column
     * @param array $columnSetting
     * @return Linear
     */
    public function linear(string $column, array $columnSetting)
    {
        $doc = new Linear($column, $columnSetting);
        $doc->setStyle(['width' => '100%', 'height' => '240px']);
        $this->node->append($doc);
        return $doc;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function form(array $attributes = [])
    {
        $attributes = array_merge(['accept-charset' => 'UTF-8', 'enctype' => 'multipart/form-data', 'class' => '"dlp dlp-form"'], $attributes);
        $attrs = Assistant::arrayKv2String($attributes, '=', ' ');
        $this->form = "<form {$attrs}>%s</form>";
        return $this;
    }

    /**
     * @param \Closure $closure
     * @param int $cols
     * @param string $style
     */
    public function section(\Closure $closure, $cols = 2, $style = '')
    {
        $section = new Section($cols, $style);
        $prevNode = $this->node;
        $this->node = $section;
        $closure($this);
        $prevNode->append($this->node);
        $this->node = $prevNode;
    }

    /**
     * @param Swing $swing
     */
    public function swing(Swing $swing, \Closure $closure)
    {
        $prevNode = $this->node;
        $this->node = $swing;
        $closure($this);
        $this->node = $prevNode;
    }

    /**
     * @param Component|Layout $document
     */
    public function append($document)
    {
        if ($document instanceof Component || $document instanceof Layout) $this->documents[] = $document;
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
