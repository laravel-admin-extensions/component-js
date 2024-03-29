<?php
namespace App\Admin\Controllers;

use DLP\Assembly\Wing;
use DLP\Tool\Assistant;
use DLP\Traits\CascadeLineTrait;
use Illuminate\Http\Request;

class CascadeLineController
{
    /**
     * 实现抽象trait
     */
    use CascadeLineTrait;

    public function show($id)
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
        $wing->button('新增提交')->setType('submit')->label('');
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
    function editForm(Wing $wing,$id)
    {
        $request = Request::capture();
        $val = $request->input('val');
        // 节点修改 表单列设置 例子.
        $wing->display('update_node_id')->label('修改节点 ID')->value($id);
        $wing->text('update_node_name')->label('修改节点 name')->value($val);
        $wing->button('提 交')->setType('submit')->label('');
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
