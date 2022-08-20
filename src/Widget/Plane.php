<?php

namespace DLP\Widget;


use DLP\Widget\PlaneAction\HeadPosAction;
use DLP\Widget\PlaneAction\RowPosAction;
use Encore\Admin\Layout\Content;

class Plane
{
    /**
     * 列表页 头部按钮
     * @param $title
     * @param $url
     * @param null $xhr_url
     * @param string $method
     * @param null $callback
     * @param array $options
     * @return HeadPosAction
     */
    public static function headAction($title,$url,$xhr_url=null,$method='POST',$callback=null,$options=[])
    {
        return new HeadPosAction($title,$url,$xhr_url,$method,$callback,$options);
    }

    /**
     * 列表页 行操作按钮
     * @param $title
     * @param $url
     * @param null $xhr_url
     * @param string $method
     * @param null $callback
     * @param array $options
     * @return RowPosAction
     */
    public static function rowAction($title,$url,$xhr_url=null,$method='POST',$callback=null,$options=[])
    {
        return new RowPosAction($title,$url,$xhr_url,$method,$callback,$options);
    }

    /**
     * 弹窗表单视图模板
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
     * 弹窗自定义视图模板
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