<?php
namespace App\Admin\Controllers;

use DLP\Tool\FormPanel;
use DLP\Traits\CascadeLineTrait;
use Illuminate\Http\Request;

class CascadeLineController
{
    /**
     * 实现抽象trait
     */
    use CascadeLineTrait;

    /**
     * @inheritDoc
     */
    function createForm(FormPanel $formPanel)
    {
        // TODO: CODE
        $formPanel->input('insert_node_val','新增节点 name');
    }

    /**
     * @inheritDoc
     */
    function storeAction(): array
    {
        $request = Request::capture();
        $key = (int)$request->input('key');
        $insert_node_name = $request->input('insert_node_val');
        // TODO: CODE
        // 新增id 随机示例
        $insert_node_id = $key+mt_rand(10000,100000);
        return ['key'=>$insert_node_id,'val'=>$insert_node_name];
    }

    /**
     * @inheritDoc
     */
    function editForm(FormPanel $formPanel,$id)
    {
        $request = Request::capture();
        $val = $request->input('val');
        // TODO: CODE
        $formPanel->input('update_node_name','修改节点 name',$val);
    }

    /**
     * @inheritDoc
     */
    function updateAction($id): array
    {
        $request = Request::capture();
        $val = $request->input('update_node_name');
        // TODO: CODE
        return ['val'=>$val];
    }

    /**
     * @inheritDoc
     */
    function destroyAction($id)
    {
        // TODO: Implement destroyAction() method.
    }
}
