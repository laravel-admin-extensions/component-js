<?php

namespace DLP\Layer;

class Dialog
{
    private $trigger;
    private $button;
    private $information;
    private $options = ['width'=>'320px','height'=>'93px'];

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
        $this->options = array_merge($this->options,$options);
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

    public function button($title,$style='')
    {
        $this->button .= <<<EOF
button = document.createElement('button');
button.type = "button";
button.className = "dlp-btn";
button.style = '{$style}';
button.innerText = "{$title}";
operates.append(button);
EOF;
        return $this;
    }

    public function compile()
    {
        $this->options = json_encode($this->options);
        $func = 'dialog'.mt_rand(0,1000000);
        $content = <<<EOF
function {$func}(){
    let buttoon;
    let info;
    let dialog = document.createElement('div');
    let operates = document.createElement('div');
    operates.style = 'display:flex;justify-content: center;align-items: center;height:50px';
    dialog.style = 'padding: 5px;height: 100%;overflow: auto;';
    {$this->information}
    {$this->button}
    dialog.append(operates);
    return dialog;
}
new ComponentPlane({$func}(),$this->options).make();
EOF;
        if(!$this->trigger) return $content;
        return sprintf($this->trigger,$content);
    }
}
