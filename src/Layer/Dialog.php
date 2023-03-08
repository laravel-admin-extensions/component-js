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

    /**
     * @param array $options
     */
    public function options(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @param $information
     * @return $this
     */
    public function info($information)
    {
        $this->information = <<<EOF
info = document.createElement('div');
info.className = 'dlp-scroll';
info.style = 'justify-content: center;display: flex;align-items: center;';
info.innerText = "{$information}";
dialog.append(info);
EOF;
        return $this;
    }

    /**
     * @param $title
     * @param array $params
     * @param string $callback
     * @return $this
     */
    public function button($title, $params = [], $callback = 'function(response){if(response.code!==0){_component.alert(response.message,3,function(){window.location.reload();});}else{window.location.reload();}}')
    {
        $params = json_encode($params);
        $this->button .= <<<EOF
button = document.createElement('button');
button.type = "button";
button.className = "dlp dlp-button";
button.style = 'margin:0 20px;';
button.innerText = "{$title}";
operates.append(button);
button.addEventListener('click', function (e) {
    e.target.setAttribute('disabled','disabled');
    _component.request({url:XHR.url,method:XHR.method,data:{$params},callback:{$callback}});
});
EOF;
        return $this;
    }

    public function __toString()
    {
        $this->options = json_encode($this->options);
        $content = <<<EOF
new ComponentPlane(function(){
    let buttoon;
    let info;
    let XHR = {$this->xhr};
    let dialog = document.createElement('div');
    let operates = document.createElement('div');
    operates.style = 'display:flex;justify-content: center;align-items: center;height:40px;';
    dialog.style = 'padding: 5px;height: 100%;display: grid;grid-template-rows: auto 40px;';
    dialog.className = 'dlp';
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
