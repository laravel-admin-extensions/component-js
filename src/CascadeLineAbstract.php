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

    public function edit($id,Content $content)
    {
        $request = Request::capture();
        $data = $request->all();
        $view = new DLPanel();
        /**
         * TODO
         * $view->input('column','参数',value);
         */
        $content = $content
            ->body($view->compile());
        return DLPViewer::makeForm($content);
    }

    public function update($id)
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
        $view->input('column','参数');
        $content = $content
            ->body($view->compile());
        return DLPViewer::makeForm($content);
    }

    public function store()
    {

    }

    public function destroy($id)
    {

    }
}
