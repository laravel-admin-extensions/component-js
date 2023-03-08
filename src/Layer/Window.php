<?php

namespace DLP\Layer;

class Window
{
    private $trigger;
    private $content;
    private $options = ['width' => '0.8', 'height' => '0.8'];

    /**
     * Window constructor.
     * @param string|array $content
     */
    public function __construct($content)
    {
        $this->content = $content;
        if(is_string($content)){
            $this->content = <<<EOF
function(){
    let window = document.createElement('div');
    let fragment = document.createRange().createContextualFragment("{$this->content}");
    window.appendChild(fragment);
    return window;
}()
EOF;
            return;
        }
        $xhr = array_merge(['url'=>'','method'=>'','data'=>[],'callback'=>'null'],$content);
        $data = json_encode($xhr['data']);
        $this->content = "{url:'{$xhr['url']}',method:'{$xhr['method']}',data:{$data},callback:{$xhr['callback']}}";
    }

    /**
     * @param $selector
     * @param string $event
     * @return $this
     */
    public function trigger($selector, $event = 'click')
    {
        $this->trigger = <<<EOF
if(document.querySelector('$selector')){
    document.querySelector('$selector').addEventListener('$event', function () {
        %s
    });
}
EOF;
        return $this;
    }

    /**
     * @param array $options
     */
    public function options(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    public function __toString()
    {
        $this->options = json_encode($this->options);
        $content = <<<EOF
new ComponentPlane({$this->content},$this->options).make();
EOF;
        if (!$this->trigger) return $content;
        return sprintf($this->trigger, $content);
    }
}
