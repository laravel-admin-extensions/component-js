## 前端组件扩展
    Dot         多选择器   
    Dot         多选择器(下拉列表模式)
    CascadeDot  级联多选择器
    CascadeLine 级联管理器
    Linear      表单控件   
    plane       异步弹窗组件


  CascadeDot 
  	增加下拉列表模式	O
  	搜索逆向		O
  FormPanel 
  	下拉列表		O
  	 时间input  	O
  	 图文上传		O
  	 界面调整
  	 布局功能
  Linear 数据表单控件 
  	界面调整  		O
  	下拉列表 		O
  	时间input  	O
  	图片 		 
  	insert/update配置化  O  
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
        <td style="text-align:left;">多选择器<br/>多选择数量可设限制</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L134'>$form->Dot</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/Dot.php#L38'>Dot::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联多选择器</td>
        <td style="text-align:left;">链表多维数组 <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L202'>参考结构</a>
        <br/>
        <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L143'>数据辅助组装</a><br/>
        </td>
        <td style="text-align:left;">支持右键全选,取消<br/>多选择数量可设限制<br/>适用于无限分类,地区选择</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L152'>$form->CascadeDot</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/CascadeDot.php#L38'>CascadeDot::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联管理器</td>
        <td style="text-align:left;">链表多维数组 <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L202'>参考结构</a>
        <br/>
        <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L181'>数据辅助组装</a><br/>
        </td>
        <td style="text-align:left;">右键新增,修改,删除 操作节点接口参考<a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/CascadeLineController.php#L8'>test\CascadeLineController</a><br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/CascadeLineController.php#L13'>实现CascadeLineTrait抽象方法</a></td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L189'>$form->CascadeLine</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/CascadeLine.php#L36'>CascadeLine::panel</a></td>
    </tr>
    <tr>
        <td style="text-align:left;">表单控件</td>
        <td style="text-align:left;">二维数组<br/>[[col=>val,col2=>val2,...],...]</td>
        <td style="text-align:left;">支持拖拽排序 类似JSON组件</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L164'>$form->Linear</a><br/><br/><b>直接调用</b>:<br/><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/src/Widget/Linear.php#L49'>Linear::panel</a></td>
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
            <li><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L198'>渲染</a></li>
        </ul>
    </tr>
</table>

