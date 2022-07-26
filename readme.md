## 前端组件扩展
    一点点前端组件补充 为更加舒适的操作
    Dot         标签选择器   
    CascadeDot  级联标签选择器
    Linear      数据表单控件   
    plane       异步弹窗组件

[demo](https://codepen.io/ydtg1993-the-bashful/pen/rNdWade)
    
### 安装
```shell script
composer require dlp/component-js
```
### 发布
```shell script
php artisan vendor:publish --provider="DLP\DLPServiceProvider"
```

<table> 
    <tr>
        <th style="text-align:left;">名称</td>
        <th style="text-align:left;">数据</td>
        <th style="text-align:left;">描述</td>
        <th style="text-align:left;">使用</td>
    </tr>
    <tr>
        <td style="text-align:left;">标签选择器</td>
        <td style="text-align:left;">一维数组<br/>[id=>val,id2=>val2...]</td>
        <td style="text-align:left;">多选择,快捷点选,查询丝滑</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L134'>调用Dot</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联标签选择器</td>
        <td style="text-align:left;">链表多维数组 <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L188'>参考结构</a>
        <br/>
        <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L143'>数据辅助组装</a><br/>
        </td>
        <td style="text-align:left;">多选择,快捷点选,查询丝滑<br/>右键全选,取消<br/>适用于无限分类,地区选择</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L151'>调用CascadeDot</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">数据表单控件</td>
        <td style="text-align:left;">二维数组<br/>[[col=>val,col2=>val2,...],...]</td>
        <td style="text-align:left;">支持拖拽排序 弥补JSON组件<br/>对字段类型依赖不可排序问题</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L164'>调用Linear</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">弹出层组件</td>
        <td style="text-align:left;"></td>
        <td style="text-align:left;">异步弹窗:表单页 自定义页</td>
        <td style="text-align:left;">
         <ul>
            例.新增表单
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L53'>grid头部创建新增按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L79'>create渲染</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L82'>数据处理store</a></li>
        </ul>
        <ul>
            例.修改表单
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L68'>grid行创建修改按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L102'>edit渲染</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L105'>数据处理update</a></li>
        </ul>
        <ul>
            例.自定义页
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L69'>grid行创建按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L185'>渲染</a></li>
        </ul>
    </tr>
</table>

