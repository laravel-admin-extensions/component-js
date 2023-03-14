<?php
namespace DLP\Traits;


use DLP\Assembly\Wing;
use DLP\Tool\Assistant;
use DLP\Widget\Plane;
use Illuminate\Http\Request;

/**
 * 线 - 级联控制器 视图,接口
 * Trait CascadeLineTrait
 * @package DLP\Traits
 */
trait CascadeLineTrait
{
    public function index()
    {
        try {
            $this->migrate();
        } catch (\Exception $e) {
            return Assistant::result(false, $e->getMessage());
        }
        return Assistant::result(true, 'OK');
    }

    /**
     * 迁移节点
     * event            迁移事件 migrate:节点转移 exchange:主节点与子节点交换
     * node_key         被迁移的节点 键
     * node_val         被迁移的节点 值
     * aim_node_key     迁移到目标节点 键
     * aim_node_val     迁移到目标节点 值
     */
    abstract function migrate();

    /**
    * detail详情查看界面
    * @param $id
    * @return mixed
    */
    abstract function show($id);

    public function create()
    {
        $wing = new Wing();
        $wing->hidden('_method','POST');
        $this->createForm($wing);
        return $wing;
    }

    /**
     * wing组装器
     * @param Wing $wing
     */
    abstract function createForm(Wing $wing);

    public function store()
    {
        try {
            $result = $this->storeAction();
        } catch (\Exception $e) {
            return Assistant::result(false, $e->getMessage());
        }
        return Assistant::result(true, 'OK', $result);
    }

    /**
     * 新增数据处理
     * request params:
     *      [key] 当前操作节点键
     *      [val] 当前操作节点值
     * @return array  ['key'=>insert_node_id,'val'=>insert_node_value] 返回新增节点数据 键值
     */
    abstract function storeAction(): array;

    public function edit($id)
    {
        $wing = new Wing();
        $wing->hidden('_method','PUT');
        $this->editForm($wing,$id);
        return $wing;
    }

    /**
     * request params:
     *      [val] 当前操作节点值
     * @param Wing $wing
     * @param $id
     * @return mixed
     */
    abstract function editForm(Wing $wing,$id);

    public function update($id)
    {
        try {
            $result = $this->updateAction($id);
        } catch (\Exception $e) {
            return Assistant::result(false, $e->getMessage());
        }
        return Assistant::result(true, 'OK', $result);
    }

    /**
     * 修改数据处理
     * @param $id
     * @return array  ['val'=>update_node_value] 返回新增节点数据 值
     */
    abstract function updateAction($id): array;

    public function destroy($id)
    {
        try {
            $this->destroyAction($id);
        } catch (\Exception $e) {
            return Assistant::result(false, $e->getMessage());
        }
        return Assistant::result(true, 'OK');
    }

    /**
     * 删除数据处理
     * @param $id
     */
    abstract function destroyAction($id);
}
