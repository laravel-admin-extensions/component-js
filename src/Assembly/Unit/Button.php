<?php


namespace DLP\Assembly\Unit;

use DLP\Assembly\Abs\Input;
use DLP\Assembly\Abs\Layer;
use DLP\Layer\Dialog;
use DLP\Tool\Assistant;

/**
 * Class Button
 * @package DLP\Assembly\Unit
 */
class Button extends Input
{
    private $domId;
    private $title;
    private $trigger;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->domId = "button_".substr(md5($this->title.microtime().mt_rand(0,10000)),16);
    }

    /**
     * @param array $xhr
     * @param string $formSelector
     */
    public function bindRequest($xhr = ['url'=>'','method'=>'','data'=>[],'callback'=>'null'],$formSelector = '')
    {
        $xhr = array_merge(['url'=>'','method'=>'','data'=>[],'callback'=>'null'],$xhr);
        $data = json_encode($xhr['data']);
        $form = '';
        if($formSelector !== ''){
            $form = <<<EOF
let form = document.querySelector('{$formSelector}');
let formdata = new FormData(form);
let flag = false;
for (let pair of formdata.entries()) {
    let key = pair[0];
    let val = pair[1];
    let input;
    try {
        input = form.querySelector(`[name="`+key+`"]`);
    } catch (e) {
        continue;
    }
    if (input.hasAttribute('required') && input.value === '') {
        flag = true;
        input.focus();
    }
    if (/\[.*\]/.test(key) && /^\[.*\]$/.test(val) && (typeof val === 'string')) {
        val = JSON.parse(val);
        if (Array.isArray(val) && val.length > 0) {
            val.forEach((v) => {
                formdata.append(key+`[]`, v);
            });
        } else {
            formdata.append(key, '');
        }
    }
}
if (flag) return;
if(typeof xhr.data === 'object' && Object.keys(xhr.data).length !== 0){
    for (let k in xhr.data){
        if(xhr.data.hasOwnProperty(k)) formdata.append(k,xhr.data[k]);
    }
}
EOF;
        }
        $this->trigger = <<<EOF
document.querySelector('#{$this->domId}').addEventListener('click', function (e) {
    let xhr = {url:'{$xhr['url']}',method:'{$xhr['method']}',data:{$data},callback:{$xhr['callback']}};
    {$form}
    e.target.setAttribute('disabled','disabled');
    _component.request(xhr);
});
EOF;
        return $this;
    }

    /**
     * @param \Closure $closure
     * @param array $xhr
     * @return $this
     */
    public function bindDialog(\Closure $closure,array $xhr = ['url' => '', 'method' => 'POST'])
    {
        $dialog = (new Dialog($xhr))->trigger("#{$this->domId}");
        $closure($dialog);
        $this->trigger = $dialog;
        return $this;
    }

    public function __toString()
    {
        $this->annotate();
        $content = <<<EOF
<button type="{$this->type}" id="{$this->domId}" class="dlp dlp-button" {$this->annotation}>{$this->title}</button>
<script>{$this->trigger}</script>
EOF;
        return $content;
    }
}
