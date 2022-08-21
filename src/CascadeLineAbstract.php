<?php
namespace DLP;


use DLP\Tool\Assistant;
use DLP\Tool\FormPanel;
use DLP\Widget\Plane;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

/**
 * 线 - 级联控制器 视图,接口
 * Class CascadeLineAbstract
 * @package DLP
 */
abstract class CascadeLineAbstract
{
    public function index(Content $content)
    {

    }

    public function create(Content $content)
    {
        $formPanel = new FormPanel();
        $this->createForm($formPanel);
        $content = $content
            ->body($formPanel->compile());
        return Plane::form($content);
    }

    /**
     * TODO
     * $formPanel->input('column','参数')
     * @param FormPanel $formPanel
     */
    abstract function createForm(FormPanel $formPanel);

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
     * @return array  ['key'=>insert_node_id,'val'=>insert_node_value]
     */
    abstract function storeAction(): array;

    public function edit($id, Content $content)
    {
        $formPanel = new FormPanel();
        $this->editForm($formPanel);
        $content = $content
            ->body($view->compile());
        return Plane::form($content);
    }

    /**
     * TODO
     * $formPanel->input('column','参数',value))
     * @param FormPanel $formPanel
     */
    abstract function editForm(FormPanel $formPanel);

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
     * @param $id
     * @return array  ['val'=>update_node_value]
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
     * @param $id
     */
    abstract function destroyAction($id);
}
