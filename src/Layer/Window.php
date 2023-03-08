<?php

namespace DLP\Layer;

class Window
{
    private $trigger;
    private $content;
    private $options = ['width' => '0.8', 'height' => '0.8'];

    public function __construct(array $xhr = ['url' => '', 'method' => 'POST'])
    {
        $this->xhr = json_encode(array_merge($this->xhr, $xhr));
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

    /**
     * @param string|array $data
     */
    public function content($data)
    {
        $this->content = $data;
        if(is_string($data)){
            $this->content = <<<EOF
function(){
    let window = document.createElement('div');
    let fragment = document.createRange().createContextualFragment(response);
    window.appendChild(fragment);
    return window;
}()
EOF;
            return;
        }
        $xhr = array_merge(['url'=>'','method'=>'','data'=>[],'callback'=>'null'],$data);
        $data = json_encode($xhr['data']);
        $this->content = "{url:'{$xhr['url']}',method:'{$xhr['method']}',data:{$data},callback:{$xhr['callback']}}";
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
