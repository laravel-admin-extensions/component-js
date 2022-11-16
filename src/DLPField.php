<?php
namespace DLP;

use Encore\Admin\Form\Field;
use Illuminate\Contracts\Support\Arrayable;

class DLPField extends Field
{
    protected $view = 'dlp::component';

    protected $list = [];
    
    /**
     * Set the field options.
     *
     * @param array $options
     *
     * @return $this
     */
    public function options($options = [])
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        $this->options = $options;
        return $this;
    }

    /**
     * Set the field options.
     *
     * @param array $list
     *
     * @return $this
     */
    public function list(array $list = [])
    {
        $this->list = $list;
        return $this;
    }

    /**
     * Set the field option checked.
     *
     * @param array $checked
     *
     * @return $this
     */
    public function checked($checked = [])
    {
        if ($checked instanceof Arrayable) {
            $checked = $checked->toArray();
        }

        $this->checked = array_map(function ($v) {
            return (int)$v;
        }, array_values($checked));
        return $this;
    }

    /**
     * Set the field option checked.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns($columns)
    {
        if ($columns instanceof Arrayable) {
            $columns = $columns->toArray();
        }

        $this->columns = $columns;
        return $this;
    }

    /**
     * Set the field option checked.
     *
     * @param string $url
     *
     * @return $this
     */
    public function xhr($url)
    {
        $this->xhr = $url;
        return $this;
    }
}
