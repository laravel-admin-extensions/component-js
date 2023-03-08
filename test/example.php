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
            $actions->add(Plane::rowAction('自定义页', $url . "/{$actions->row->id}/blank")->withoutBind());
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
            return Assistant::result(false, $e->getMessage());
        }
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
        $form->html((new Linear('source',
            [
                'id' => ['name' => 'ID', 'type' => 'text'],
                'title' => ['name' => '标题', 'type' => 'input'],
                'url' => ['name' => '图片', 'type' => 'image','insert_type'=>'hidden'],
                'type' => ['name' => '类型', 'type' => 'select', 'select' => ['1' => '开启', '2' => '关闭'], 'limit' => 1, 'style' => 'width:60px'],
                'time' => ['name' => '时间', 'type'=>'datetime']
            ]))
            ->load([
                ["id"=>1,"title" => "ごめんなさい、もう別れたいの…別れを拒む彼氏と結んだ《愛人》と言う名の従順契約 美乃すずめ","url" => "https://img.9618599.com/resources/javdb.com/6180fad2d93894236f287bb2/small_cover.jpg", "type" => 1,"time" => "2021-05-14 00:00:00"],
                ["id"=>2,"title" => "母姉W相姦 木下あずみ 沖田杏梨","url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/1eeef553b3a975f5.jpg","type" => 1, "time" => "2021-05-14 00:00:00",],
                ["id"=>3,"title" => "ヌードモデルNTR監督『ながえ』作品！！×『新作』寝取られドラマ！！武藤あやか","url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/07737929ec75781e.jpeg","type" => 2, "time" => "2021-12-14 13:24:46"],
                ["id"=>4,"title" => "妻晒し 表の顔は貞淑妻、裏の顔は変態妻の公開記録―。 木下凛々子", "url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/b1a3cffd40eca68c.jpg",  "type" => 1, "time" => "2021-12-14 13:24:46"],
                ["id"=>5,"title" => "担任教師に3年分の妄想・愛・性欲をぶち撒けた卒業式前夜 miru （ブルーレイディスク）","url" => "https://img.9618599.com/resources/javdb.com/61e1171d16a76b11f7375cde/small_cover.jpg", "type" => 2, "time" => "2021-12-14 13:24:46"]])
            ->setStyle(['height' => '240px']), '列表组件');
        return $form;
    }

    public function blank()
    {
        /*wing辅助控件工具包*/
        $W = new Wing();
        $W->display('id')->label('序号');
        $W->section(function ($W){
            $W->select('status0', [0 => '开启', 1 => '关闭', 2 => '删除'])->label('状态0');
            $W->select('status1', [0 => '开启', 1 => '关闭', 2 => '删除'])->direction('up')->useSearch()->label('状态1');
            $W->select('status2', [0 => '开启', 1 => '关闭', 2 => '删除'])->direction('middle')->useSearch()->label('状态2');
        },2);
        $W->textarea('description')->label('描述');
        $W->select('status', [0 => '开启', 1 => '关闭', 2 => '删除'])->limit(1)->label('状态');
        $W->datepicker('time')->label('时间');
        $W->html('test', '<p>松下紗栄子</p>')->label('自定义html');

        $W->select('switch',[0=>'左',1=>'右'])
            ->when(0,function (Wing $W){
                $W->display('left')->label( '左');
                $W->dot('dot', [0 => '开启', 1 => '关闭', 2 => '删除'])->useSearch()->label('点组件dot示例');})
            ->when(1,function (Wing $W){
                $W->display('right')->label( '右');
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
                    ->initialPreview(['files' => $images, 'url' => '/image.server...']);})
            ->withoutHiddenInput()->label('切换');

        $W->cascadeDot('clothes',$this->cascadeExampleData())->limit(3)->useSearch()->label('级联选择器');

        $W->cascadeLine('clothes_manager',$data)->label('级联管理器');

        $W->linear('linear',[
            'id' => ['name' => 'ID', 'type' => 'text'],
            'title' => ['name' => '标题', 'type' => 'input'],
            'url' => ['name' => '图片', 'type' => 'image','insert_type'=>'hidden'],
            'type' => ['name' => '类型', 'type' => 'select', 'select' => ['1' => '开启', '2' => '关闭'], 'limit' => 1, 'style' => 'width:60px'],
            'time' => ['name' => '时间', 'type'=>'datetime']
        ])->load([
            ["id"=>1,"title" => "ごめんなさい、もう別れたいの…別れを拒む彼氏と結んだ《愛人》と言う名の従順契約 美乃すずめ","url" => "https://img.9618599.com/resources/javdb.com/6180fad2d93894236f287bb2/small_cover.jpg", "type" => 1,"time" => "2021-05-14 00:00:00"],
            ["id"=>2,"title" => "母姉W相姦 木下あずみ 沖田杏梨","url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/1eeef553b3a975f5.jpg","type" => 1, "time" => "2021-05-14 00:00:00",],
            ["id"=>3,"title" => "ヌードモデルNTR監督『ながえ』作品！！×『新作』寝取られドラマ！！武藤あやか","url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/07737929ec75781e.jpeg","type" => 2, "time" => "2021-12-14 13:24:46"],
            ["id"=>4,"title" => "妻晒し 表の顔は貞淑妻、裏の顔は変態妻の公開記録―。 木下凛々子", "url" => "https://img.9618599.com/resources//d41d8cd98f00b204e9800998ecf8427e/b1a3cffd40eca68c.jpg",  "type" => 1, "time" => "2021-12-14 13:24:46"],
            ["id"=>5,"title" => "担任教師に3年分の妄想・愛・性欲をぶち撒けた卒業式前夜 miru （ブルーレイディスク）","url" => "https://img.9618599.com/resources/javdb.com/61e1171d16a76b11f7375cde/small_cover.jpg", "type" => 2, "time" => "2021-12-14 13:24:46"]])
            ->label('列表组件');
        return $W->form();
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
