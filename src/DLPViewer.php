<?php

namespace DLP;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DLPViewer
 * @package DLP
 */
class DLPViewer
{
    /**
     * 弹窗表单视图生成
     * @param Content $content
     * @return array|string
     * @throws \Throwable
     */
    public static function makeForm(Content $content)
    {
        $request = Request::capture();
        $data = $request->all();
        if(isset($data['dlp_json_view'])){
            $list = json_decode(json_encode(DB::select($data['source'])), true);
            return DLPViewer::result(true, 'source', $list);
        }
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
    public static function makeHtml($html)
    {
        return view('dlp::content', [
            '_content_' => $html
        ])->render();
    }

    /**
     * 表单提交ajax返回数据格式
     * @param bool $success
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function result($success = true, $message = 'OK', $data = [])
    {
        return response()->json([
            'code' => $success ? 0 : 1,
            'data' => $data,
            'message' => $message
        ], 200)
            ->header('Content-Type', 'application/json;charset=utf-8')
            ->header('Access-Control-Allow-Origin', '*');
    }
}
