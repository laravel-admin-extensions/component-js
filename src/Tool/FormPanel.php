<?php

namespace DLP\Tool;


/**
 * Class FormPanel
 * @package DLP\Tool
 */
class FormPanel
{
    private $html = '';

    /**
     * @param string $column
     * @param string $label
     * @param string $value
     */
    public function input(string $column, string $label, string $value = '')
    {
        $content = <<<EOF
<input required="1" type="text" id="{$column}" name="{$column}" value="{$value}" class="dlp-input {$column}" placeholder="输入 {$label}" />
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $value
     */
    public function hidden(string $column, string $value)
    {
        $this->html .= <<<EOF
<input type="hidden" id="{$column}" name="{$column}" value="{$value}" />
EOF;
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $value
     */
    public function textarea(string $column, string $label, string $value = '')
    {
        $content = <<<EOF
<textarea name="{$column}" class="{$column}" rows="3" placeholder="输入 {$label}">{$value}</textarea>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param array $select
     * @param array $selected
     * @param int $limit
     * @param array $style
     * @param bool $menu_mode
     */
    public function select(string $column, string $label, array $select, array $selected, $limit = 0, array $style = [],$menu_mode=true)
    {
        $selected = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $select = json_encode($select, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS);
        $style = array_merge(['width' => '100%', 'height' => '62px'], $style);
        $style_string = '';
        foreach ($style as $k => $s) {
            $style_string .= "$k:$s;";
        }
        $content = <<<EOF
<div id="{$column}" style="$style_string"></div>
<script>
new ComponentDot("{$column}",JSON.parse('{$select}'),JSON.parse('{$selected}'),{$limit},{$menu_mode},{$label});
</script>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param string|integer $value
     * @param string $format  YYYY-MM-DD HH:mm:ss | YYYY-MM-DD | YYYY
     */
    public function datepicker(string $column, string $label, $value = '',$format = "YYYY-MM-DD HH:mm:ss")
    {
        if (!$value) {
            $value = date('Y-m-d H:i:s');
        }
        $content = <<<EOF
<input style="width: 160px" type="text" id="{$column}" name="{$column}" value="{$value}" class="dlp-input {$column}" placeholder="输入 {$label}" />
<script>
$('#{$column}').datetimepicker({"format":{$format},"locale":"zh-CN"});
</script>
EOF;
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param array $settings
     * @param array $initialPreview
     * @param string $attribute
     */
    public function fileInput(string $column, string $label, array $settings = [], array $initialPreview = ['files' => null, 'url' => null], $attribute = '')
    {
        $file_input_settings = [
            'overwriteInitial' => false,
            'initialPreviewAsData' => true,
            'msgPlaceholder' => "\u9009\u62e9\u6587\u4ef6",
            'browseLabel' => "\u6d4f\u89c8",
            "cancelLabel" => "\u53d6\u6d88",
            "showRemove" => false,
            "showUpload" => false,
            "showCancel" => false,
            "dropZoneEnabled" => false,
            'fileActionSettings' => ["showRemove" => true, "showDrag" => false]
        ];
        $fileTypes = [
            'image' => '/^(gif|png|jpe?g|svg|webp)$/i',
            'html' => '/^(htm|html)$/i',
            'office' => '/^(docx?|xlsx?|pptx?|pps|potx?)$/i',
            'gdocs' => '/^(docx?|xlsx?|pptx?|pps|potx?|rtf|ods|odt|pages|ai|dxf|ttf|tiff?|wmf|e?ps)$/i',
            'text' => '/^(txt|md|csv|nfo|ini|json|php|js|css|ts|sql)$/i',
            'video' => '/^(og?|mp4|webm|mp?g|mov|3gp)$/i',
            'audio' => '/^(og?|mp3|mp?g|wav)$/i',
            'pdf' => '/^(pdf)$/i',
            'flash' => '/^(swf)$/i',
        ];
        $file_input_settings['initialPreviewConfig'] = [];
        $file_input_settings['initialPreview'] = [];
        if (isset($initialPreview['files']) && is_array($initialPreview['files'])) {
            foreach ($initialPreview['files'] as $file) {
                $filetype = 'other';
                $ext = strtok(strtolower(pathinfo($file, PATHINFO_EXTENSION)), '?');
                foreach ($fileTypes as $type => $pattern) {
                    if (preg_match($pattern, $ext) === 1) {
                        $filetype = $type;
                        break;
                    }
                }
                $setting = ['caption' => basename($file), 'key' => $file, 'type' => $filetype];
                if ($filetype == 'video') {
                    $setting['filetype'] = "video/{$ext}";
                }
                if ($filetype == 'audio') {
                    $setting['filetype'] = "audio/{$ext}";
                }
                $setting['downloadUrl'] = $initialPreview['url'] . $file;
                $settings['initialPreviewConfig'][] = $setting;
                $settings['initialPreview'][] = $initialPreview['url'] . $file;
            }
        }
        $settings = json_encode(array_merge($file_input_settings, $settings));
        $content = `<input class='{$column}' name='{$column}' multiple type='file' {$attribute}>
<script>
$('input.{$column}').fileinput(JSON.parse('{$settings}')).on('filebeforedelete', function () {
                return new Promise(function(resolve, reject) {
                        var remove = resolve;
                        swal({
                            title: "确认删除?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "确认",
                            showLoaderOnConfirm: true,
                            cancelButtonText: "取消",
                            preConfirm: function() {
                                return new Promise(function(resolve) {
                                    resolve(remove());
                                });
                            }
                        });
                });
            }).on("filebatchselected", function (event, files) {
                if(files.length == 0)return;
                $(this).fileinput("upload");
            }).on('fileerror', function (event, data, msg) {
                alert(msg);
            });
</script>`;

        $this->html .= $this->rowpanel($column, $label, $content);
    }

    /**
     * @param string $column
     * @param string $label
     * @param string $content
     */
    public function html(string $column, string $label, string $content)
    {
        $this->html .= $this->rowpanel($column, $label, $content);
    }

    public function compile()
    {
        return <<<EOF
<form class="dlp" accept-charset="UTF-8" method="post">
    <div>{$this->html}</div>
</form>
EOF;
    }

    private function rowpanel($column, $label, $content)
    {
        return <<<EOF
<div class="dlp-form-row">
    <label class="dlp-text" for="{$column}">{$label}</label>
    {$content}
</div>
EOF;
    }
}
