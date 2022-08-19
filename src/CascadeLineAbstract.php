<?php
namespace DLP;


use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

abstract class CascadeLineAbstract
{
    public function index(Content $content)
    {

    }

    public function create(Content $content)
    {
        $request = Request::capture();
        $data = $request->all();
        $view = new DLPanel();
        /**
         * TODO
         * $view->input('column','参数')
         */
        $view->input('insert-key','参数key');
        $view->input('insert-val','参数val');
        $content = $content
            ->body($view->compile());
        return DLPViewer::makeForm($content);
    }

    public function store()
    {
        $request = Request::capture();
        $data = $request->all();
        try{
            //TODO insert node
            $result = ['key'=>$data['insert-key'],'val'=>$data['insert-val']];
        }catch (\Exception $e){
            return DLPViewer::result(false,$e->getMessage());
        }
        return DLPViewer::result(true,'OK',$result);
    }

    public function edit($id,Content $content)
    {
        $request = Request::capture();
        $data = $request->all();
        $view = new DLPanel();
        /**
         * TODO
         * $view->input('column','参数',value);
         */
        $view->input('update-val','参数',$data['val']);
        $content = $content
            ->body($view->compile());
        return DLPViewer::makeForm($content);
    }

    public function update($id)
    {
        $request = Request::capture();
        $data = $request->all();
        try{
            //TODO update node
            $result = ['val'=>$data['update-val']];
        }catch (\Exception $e){
            return DLPViewer::result(false,$e->getMessage());
        }
        return DLPViewer::result(true,'OK',$result);
    }

    public function destroy($id)
    {
        $request = Request::capture();
        $data = $request->all();
        try{
            //TODO delete node
        }catch (\Exception $e){
            return DLPViewer::result(false,$e->getMessage());
        }
        return DLPViewer::result(true,'OK');
    }
}
