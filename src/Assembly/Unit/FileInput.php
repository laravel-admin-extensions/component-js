<?php


namespace DLP\Assembly\Unit;

use DLP\Tool\Assistant;

/**
 * Class FileInput
 * @package DLP\Assembly\Unit
 */
class FileInput
{
    private $column;
    private $label;
    private $style;
    private $pure = false;
    private $settings = [];
    private $initialPreview;
    private $attributes;
    public $fileType = [
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

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * @param $title
     * @return $this
     */
    public function label($title)
    {
        $this->label = $title;
        return $this;
    }

    /**
     * @param array $styles
     * @return $this
     */
    public function setStyle(array $styles)
    {
        $styles = array_merge(['width' => '100%'], $styles);
        $this->style = 'style="' . Assistant::arrayKv2String($styles) . '"';
        return $this;
    }

    /**
     * @param array $types
     * @return $this
     */
    public function fileType(array $types)
    {
        $this->fileType = array_merge($this->fileType, $types);
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttribute(array $attributes)
    {
        $this->attributes .= Assistant::arrayKv2String($attributes, '=', ' ');
        return $this;
    }

    /**
     * @param array $settings
     * @return $this
     */
    public function settings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @param array $initialPreview
     * @return $this
     */
    public function initialPreview(array $initialPreview = ['files' => null, 'url' => null])
    {
        $this->initialPreview = $initialPreview;
        return $this;
    }

    private function setInit()
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
            'fileActionSettings' => ["showRemove" => true, "showDrag" => false],
            'initialPreviewConfig' => [],
            'initialPreview' => []
        ];
        if (isset($this->initialPreview['files']) && is_array($this->initialPreview['files'])) {
            foreach ($this->initialPreview['files'] as $file) {
                $filetype = 'other';
                $ext = strtok(strtolower(pathinfo($file, PATHINFO_EXTENSION)), '?');
                foreach ($this->fileTypes as $type => $pattern) {
                    if (preg_match($pattern, $ext) === 1) {
                        $filetype = $type;
                        break;
                    }
                }
                $this->setting = ['caption' => basename($file), 'key' => $file, 'type' => $filetype];
                if ($filetype == 'video') {
                    $setting['filetype'] = "video/{$ext}";
                }
                if ($filetype == 'audio') {
                    $setting['filetype'] = "audio/{$ext}";
                }
                $this->setting['downloadUrl'] = $this->initialPreview['url'] . $file;
                $this->settings['initialPreviewConfig'][] = $this->setting;
                $this->settings['initialPreview'][] = $this->initialPreview['url'] . $file;
            }
        }
        return json_encode(array_merge($file_input_settings, $this->settings));
    }

    public function compile()
    {
        $settings = $this->setInit();
        $content = <<<EOF
<div class="dlp" {$this->style}><input name='{$this->column}' multiple type='file' {$this->attributes} /></div>
<script>
$('input[name="{$this->column}"]').fileinput(JSON.parse('{$settings}')).on('filebeforedelete', function () {
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
    console.error(event, data, msg);
    alert(msg);
});
</script>
EOF;
        if(!$this->label) return $content;

        return <<<EOF
<div class="dlp dlp-form-row" style="align-items:center;">
    <label class="dlp-text" for="{$this->column}">{$this->label}</label>
    {$content}
</div>
EOF;
    }
}
