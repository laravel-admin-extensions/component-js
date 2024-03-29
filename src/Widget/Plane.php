<?php

namespace DLP\Widget;


use DLP\Widget\PlaneAction\HeadPosAction;
use DLP\Widget\PlaneAction\RowPosAction;
use Encore\Admin\Layout\Content;

/**
 * 面
 * Class Plane
 * @package DLP\Widget
 */
class Plane
{
    /**
     * 列表页 头部按钮
     * @param string $title
     * @param string $url 弹窗页接口地址
     * @param array $xhr ajax配置
     *      xhr.url         string  触发事件ajax地址
     *      xhr.method      string  GET,POST,PUT,DELETE
     *      xhr.callback    string  js回调函数
     * @param array $options
     *      options.width   float|string    0.5,50%,500px
     *      options.height  float|string    0.5,50%,500px
     *      options.top     string          5%,50px
     *      options.left    string          5%,50px,auto
     * @return HeadPosAction
     */
    public static function headAction(string $title, string $url, array $xhr = [], array $options = [])
    {
        return new HeadPosAction($title, $url, $xhr, $options);
    }

    /**
     * 列表页 行操作按钮
     * @param string $title
     * @param string $url 弹窗页接口地址
     * @param array $xhr ajax配置
     *      xhr.url         string  触发事件ajax地址
     *      xhr.method      string  GET,POST,PUT,DELETE
     *      xhr.callback    string  js回调函数
     * @param array $options
     *      options.width   float|string    0.5,50%,500px
     *      options.height  float|string    0.5,50%,500px
     *      options.top     string          5%,50px
     *      options.left    string          5%,50px,auto
     * @return RowPosAction
     */
    public static function rowAction(string $title, string $url, array $xhr = [], array $options = [])
    {
        return new RowPosAction($title, $url, $xhr, $options);
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
