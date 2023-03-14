<?php
namespace App\Admin\Controllers;

use DLP\Assembly\Wing;
use DLP\Tool\Assistant;
use DLP\Traits\CascadeLineTrait;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;

class CascadeLineController extends AdminController
{
    /**
     * 实现抽象trait
     */
    use CascadeLineTrait;

    public function show($id, Content $content)
    {
        // 节点详情查看页 例子.
        return "详情查看页";
    }

    /**
     * @inheritDoc
     */
    function createForm(Wing $wing)
    {
        // 节点新增 表单列设置 例子.
        $wing->text('insert_node_val')->label('新增节点 name');
        return $wing->form();
    }

    /**
     * @inheritDoc
     */
    function storeAction()
    {
        $request = Request::capture();
        $key = (int)$request->input('key');
        $insert_node_name = $request->input('insert_node_val');
        // 节点新增逻辑处理
        // 新增id 随机示例
        $insert_node_id = $key+mt_rand(10000,100000);
        return ['key'=>$insert_node_id,'val'=>$insert_node_name];
    }

    /**
     * @inheritDoc
     */
    function editForm($id,Wing $wing)
    {
        $request = Request::capture();
        $val = $request->input('val');
        // 节点修改 表单列设置 例子.
        $wing->text('update_node_name')->label('修改节点 name')->value($val);
        return $wing->form();
    }

    /**
     * @inheritDoc
     */
    function updateAction($id)
    {
        $request = Request::capture();
        $val = $request->input('update_node_name');
        // 节点修改逻辑处理
        return ['val'=>$val];
    }

    /**
     * @inheritDoc
     */
    function destroyAction($id)
    {
        // 节点删除逻辑处理
    }

    /**
    * @inheritDoc
    */
    function migrate()
    {
       // 节点迁移 交换 逻辑处理
       return Assistant::result(true);
    }
}
