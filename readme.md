## 前端组件扩展

    |-表单类组件扩展 Widget
    |    |-Dot         多选择器
    |    |-CascadeDot  级联多选择器
    |    |-CascadeLine 级联管理器
    |    |-Linear      表单控件  
    |
    |-弹窗组件 Widget
    |    |-plane       异步弹窗组件
    |     
    |-辅助工具 Tool
    |    |-Assistant   数据处理辅助方法  
    |    |-FormPanel   表单内容生成器
    |    |-CascadeLineTrait   级联管理器的接口抽象类 
    |
    |-参考样例 Test
    |    |-example      组件样例
    |    |-CascadeLineController  级联管理器 接口样例
    
    
### [demo样例参见](https://codepen.io/ydtg1993-the-bashful/pen/rNdWade)

### 安装
```shell script
composer require dlp/component-js
```
### 发布
```shell script
php artisan vendor:publish --provider="DLP\DLPServiceProvider"
```

### 使用
<table> 
    <tr>
        <th style="text-align:left;">名称</td>
        <th style="text-align:left;">数据</td>
        <th style="text-align:left;">描述</td>
        <th style="text-align:left;">调用</td>
    </tr>
    <tr>
        <td style="text-align:left;">多选择器</td>
        <td style="text-align:left;">一维数组<br/>[id=>val,id2=>val2...]</td>
        <td style="text-align:left;">多选择器<br/>多选择数量可设限制数<br/>模式切换:经典 下拉列表</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L129'>$form->Dot</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/Dot.php#L36'>Dot::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联多选择器</td>
        <td style="text-align:left;">链表多维数组 <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L248'>参考结构</a>
        <br/>
        <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L146'>数据辅助组装</a><br/>
        </td>
        <td style="text-align:left;">支持右键全选,取消<br/>多选择数量可设限制<br/>适用于无限分类,地区选择</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L144'>$form->CascadeDot</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/CascadeDot.php#L40'>CascadeDot::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联管理器</td>
        <td style="text-align:left;">链表多维数组 <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L248'>参考结构</a>
        <br/>
        <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L192'>数据辅助组装</a><br/>
        </td>
        <td style="text-align:left;">右键新增,修改,删除 操作节点<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/CascadeLineController.php#L13'>需要实现的接口抽象类CascadeLineTrait</a> <br/><br/>example参考<a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/CascadeLineController.php#L8'>test\CascadeLineController</a></td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L190'>$form->CascadeLine</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/CascadeLine.php#L40'>CascadeLine::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">表单控件</td>
        <td style="text-align:left;">二维数组<br/>[[col=>val,col2=>val2,...],...]</td>
        <td style="text-align:left;">支持拖拽排序 类似JSON组件</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L162'>$form->Linear</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/Linear.php#L48'>Linear::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">弹出层组件</td>
        <td style="text-align:left;"></td>
        <td style="text-align:left;">异步弹窗:表单页 自定义页</td>
        <td style="text-align:left;">
         <ul>
            例.新增表单
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L53'>grid头创建新增按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L78'>create渲染</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L82'>数据处理store</a></li>
        </ul>
        <ul>
            例.修改表单
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L68'>grid行创建修改按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L101'>edit渲染</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L105'>数据处理update</a></li>
        </ul>
        <ul>
            例.自定义页
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L69'>grid行创建按钮</a></li>
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L210'>自定义页内容</a></li>
        </ul>
    </tr>
</table>

