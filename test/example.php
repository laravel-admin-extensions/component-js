<?php

namespace App\Admin\Controllers;

use DLP\Assembly\Unit\Linear;
use DLP\Assembly\Wing;
use DLP\Tool\Assistant;
use DLP\Widget\Plane;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use DLP\DLPHelper;
use DLP\DLPViewer;
use Illuminate\Support\Facades\Route;


class ExampleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '测试样例';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Model());
        $grid->model()->where('status', 1);
        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', '名称');
        $grid->column('created_at', __('创建时间'))->sortable();
        $grid->column('updated_at', __('更新时间'))->sortable();

        /*配置 禁用原生创建*/
        $grid->disableCreateButton();
        $url = config('app.url') . Route::current()->uri;
        /**
         * 弹窗模式:设置列表-头部操作方法
         * title    名称
         * url      弹窗页地址
         * xhr_url  表单提交地址
         * method   提交方式 POST PUT GET ...
         * callback ajax请求回调js函数 (字符串方式书写)
         *      function(response){
         *          alert(response);
         *      }
         */
        $grid->tools->append(Plane::headAction('新增', $url . '/create', $url, 'POST'));

        /**
         * 弹窗模式:设置列表-行操作方法
         * title    名称
         * url      弹窗页地址 {id}反向匹配当前行id
         * xhr_url  表单提交地址 {id}反向匹配当前行id
         * method   提交方式 POST PUT GET ...
         * callback ajax请求回调js函数 (字符串方式书写)
         *      function(response){
         *          alert(response);
         *      }
         */
        $grid->actions(function ($actions) use ($url) {
            $actions->disableEdit();
            $actions->add(Plane::rowAction('编辑', $url . "/{$actions->row->id}/edit", $url . "/{$actions->row->id}"));
            $actions->add(Plane::rowAction('自定义页', $url . "/{$actions->row->id}/blank"));
        });
        return $grid;
    }

    public function create(Content $content)
    {
        $content = $content
            ->body($this->form());
        /*弹窗模式 渲染form表单模板 Plane::form*/
        return Plane::form($content);
    }

    public function store()
    {
        $request = Request::capture();
        $data = $request->all();
        try {
            //TODO
        } catch (\Exception $e) {
            DB::rollBack();
            return Assistant::result(false, $e->getMessage());
        }
        DB::commit();
        return Assistant::result(true, '');
    }


    public function edit($id, Content $content)
    {
        $content = $content
            ->body($this->form($id)->edit($id));
        /*弹窗模式 渲染form表单模板 Plane::form*/
        return Plane::form($content);
    }

    public function update($id)
    {
        $request = Request::capture();
        $data = $request->all();
        try {
            //TODO
        } catch (\Exception $e) {
            DB::rollBack();
            return Assistant::result(false, $e->getMessage());
        }
        DB::commit();
        return Assistant::result(true, '');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id)
    {
        $form = new Form(new Model());
        $form->html((new Linear('source'))
            ->columns([
                'url' => ['name' => '名称', 'type' => 'input'],
                'type' => ['name' => '分辨率', 'type' => 'select', 'select' => ['1' => '720p', '2' => '1080p'], 'limit' => 1, 'style' => 'width:60px']
            ])->setStyle(['height' => '240px'])->compile(), '视频资源');
        return $form;
    }

    public function blank()
    {
        $title = '<h1>松下紗栄子</h1>';
        /*辅助表单内容组装器 FormPanel 参考以下*/
        $W = new Wing();
        $W->display('id')->label('序号');
        $W->section('布局',function ($W){
            $W->text('title1')->label('标题1');
            $W->text('title2')->label('标题2');
            $W->text('title3')->label('标题3');
        });
        $W->textarea('description')->label('描述');
        $W->select('status', [0 => '开启', 1 => '关闭', 2 => '删除'])->useSearch(false)->label('状态');
        $W->datepicker('time')->label('时间');
        $W->html('test', '<p>松下紗栄子</p>')->label('自定义html');

        $W->section(function ($W){
            $W->select('status0', [0 => '开启', 1 => '关闭', 2 => '删除'])->useSearch(false)->label('状态0');
            $W->dot('status1', [0 => '开启', 1 => '关闭', 2 => '删除'])->useSearch(false)->label('状态1');

            /*多图上传样例*/
            $images = ['/image1...', '/image2...', '/image3...'];
            $W->fileInput('photo')
                ->label('艳照')
                ->settings([
                    'uploadUrl' => 'https://...upload.file.url...',
                    'uploadExtraData' => [
                        '_token' => csrf_token(),
                        'uploadAsync' => true,
                        /*自定义加传参*/
                    ],
                    'deleteUrl' => 'https://...delete.file.url...',
                    'deleteExtraData' => [
                        '_token' => csrf_token(),
                        'uploadAsync' => true,
                        /*自定义加传参*/
                    ],
                    'maxFileCount' => 10,
                    'maxFileSize' => 800 //单图限制800kb
                ])
                ->initialPreview(['files' => $images, 'url' => '/image.server...']);
        },2);

        return $W->form()();
    }

    private function cascadeExampleData()
    {
        return [
            ["key" => "3", "val" => "基本", "nodes" => [
                ["key" => "6895", "val" => "可播放"],
                ["key" => "6896", "val" => "可下載"],
                ["key" => "6863", "val" => "含字幕"],
                ["key" => "6855", "val" => "含預覽圖"],
                ["key" => "6862", "val" => "含預覽視頻"]
            ]],
            ["key" => "10", "val" => "年份", "nodes" => [
                ["key" => "6868", "val" => "2021"],
                ["key" => "6867", "val" => "2020"],
                ["key" => "6866", "val" => "2019"],
                ["key" => "14", "val" => "2018"],
                ["key" => "15", "val" => "2017"],
                ["key" => "16", "val" => "2016"],
                ["key" => "6897", "val" => "2015"],
                ["key" => "18", "val" => "2014"],
                ["key" => "19", "val" => "2013"],
                ["key" => "20", "val" => "2012"],
                ["key" => "6898", "val" => "2011"],
                ["key" => "22", "val" => "2010"]
            ]],
            ["key" => "32", "val" => "主題", "nodes" => [
                ["key" => "443", "val" => "按摩油"],
                ["key" => "444", "val" => "成熟妈妈"],
                ["key" => "445", "val" => "綠帽男"]
            ]],
            ["key" => "86", "val" => "角色", "nodes" => [
                ["key" => "614", "val" => "空姐"],
                ["key" => "616", "val" => "繼女"],
                ["key" => "587", "val" => "少女"],
                ["key" => "617", "val" => "角色扮演"],
                ["key" => "588", "val" => "醫生\/護士"],
                ["key" => "618", "val" => "女友"],
                ["key" => "589", "val" => "性愛專家"],
                ["key" => "619", "val" => "女神"],
                ["key" => "377", "val" => "熟女"],
                ["key" => "590", "val" => "媽媽"],
                ["key" => "591", "val" => "女抖S"],
                ["key" => "592", "val" => "抖M"],
                ["key" => "593", "val" => "妻子"],
                ["key" => "601", "val" => "女傭"],
                ["key" => "603", "val" => "水管工"],
                ["key" => "604", "val" => "警察"],
                ["key" => "402", "val" => "女學生"],
                ["key" => "607", "val" => "女戰士"],
                ["key" => "608", "val" => "特務"],
                ["key" => "609", "val" => "老師"],
                ["key" => "610", "val" => "女服務員"],
                ["key" => "110", "val" => "秘書"]
            ]],
            ["key" => "133", "val" => "服裝", "nodes" => [
                ["key" => "550", "val" => "吊襪腰帶"],
                ["key" => "551", "val" => "背心"],
                ["key" => "552", "val" => "裙子"],
                ["key" => "553", "val" => "短裙"],
                ["key" => "554", "val" => "短褲"],
                ["key" => "555", "val" => "綁腿"],
                ["key" => "556", "val" => "太陽鏡"],
                ["key" => "557", "val" => "帽子"],
                ["key" => "558", "val" => "襯衫"],
                ["key" => "559", "val" => "睡衣"],
                ["key" => "560", "val" => "內褲"],
                ["key" => "561", "val" => "牛仔短褲"],
                ["key" => "542", "val" => "蕾絲"],
                ["key" => "543", "val" => "高跟鞋"],
                ["key" => "544", "val" => "絲襪"],
                ["key" => "545", "val" => "吊帶"],
                ["key" => "416", "val" => "比基尼"],
                ["key" => "6912", "val" => "眼鏡"],
                ["key" => "546", "val" => "眼罩"],
                ["key" => "137", "val" => "制服"],
                ["key" => "547", "val" => "牛仔褲"],
                ["key" => "158", "val" => "緊身衣"]
            ]]
        ];
    }
}
