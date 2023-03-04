<?php

namespace DLP\Layer;

class Dialog
{
    private $trigger;
    private $button;
    private $information;
    private $options = ['width' => '420px', 'height' => '93px', 'f' => false];
    private $xhr = ['url' => '', 'method' => 'POST'];

    public function __construct(array $xhr = ['url' => '', 'method' => 'POST'])
    {
        $this->xhr = json_encode(array_merge($this->xhr, $xhr));
    }

    public function trigger($selector, $event = 'click')
    {
        $this->trigger = <<<EOF
document.querySelector('$selector').addEventListener('$event', function () {
    %s
});
EOF;
        return $this;
    }

    public function options(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    public function info($information)
    {
        $this->information = <<<EOF
info = document.createElement('div');
info.style = "text-align: center;height:30px;line-height: 30px;";
info.innerText = "{$information}";
dialog.append(info);
EOF;
        return $this;
    }

    public function button($title, $style = '', $params = [], $callback = 'function(response){if(response.code!==0){_component.alert(response.message,3);}else{window.location.reload();}}')
    {

        $this->button .= <<<EOF
button = document.createElement('button');
button.type = "button";
button.className = "dlp-button";
button.style = '{$style}';
button.innerText = "{$title}";
operates.append(button);
XHR = {$this->xhr};
XHR.callback = {$callback};
button.addEventListener('click', function () {
    button.setAttribute('disabled','disabled');
    _component.request(XHR);
});
EOF;
        return $this;
    }

    public function compile()
    {
        $this->options = json_encode($this->options);
        $content = <<<EOF
new ComponentPlane(function(){
    let buttoon;
    let info;
    let XHR;
    let dialog = document.createElement('div');
    let operates = document.createElement('div');
    operates.style = 'display:flex;justify-content: center;align-items: center;height:50px';
    dialog.style = 'padding: 5px;height: 100%;overflow: auto;';
    {$this->information}
    {$this->button}
    dialog.append(operates);
    return dialog;
}(),$this->options).make();
EOF;
        if (!$this->trigger) return $content;
        return sprintf($this->trigger, $content);
    }
}
