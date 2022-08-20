<?php

namespace DLP\Widget;


use DLP\Widget\PlaneAction\HeadPos;
use DLP\Widget\PlaneAction\RowPos;
use Encore\Admin\Layout\Content;

class Plane
{
    /**
     * @param $pos
     * @param $title
     * @param $url
     * @param null $xhr_url
     * @param string $method
     * @param null $callback
     * @param array $options
     * @return null
     */
    public static function action($pos,$title,$url,$xhr_url=null,$method='POST',$callback=null,$options=[])
    {
        if($pos === HeadPos::class || $pos === RowPos::class)
            return new $pos($title,$url,$xhr_url,$method,$callback,$options);
        throw new \Exception('pos param must be HeadPos::class or RowPos::class');
    }

    /**
     * 弹窗表单视图生成
     * @param Content $content
     * @return array|string
     * @throws \Throwable
     */
    public static function form(Content $content)
    {
        return view('dlp::content', [
            '_content_' => str_replace('pjax-container', '', $content->build())
        ])->render();
    }

    /**
     * 弹窗自定义视图生成
     * @param string $html
     * @return array|string
     * @throws \Throwable
     */
    public static function html($html)
    {
        return view('dlp::content', [
            '_content_' => $html
        ])->render();
    }
}
