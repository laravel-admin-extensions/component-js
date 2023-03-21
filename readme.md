## 前端组件扩展

    |-表单类组件扩展.Assembly
    |    |-Layout      布局类 
    |    |-Unit        组件单元
    |    Wing.php      组装器
    |
    |-弹窗组件.Layer (直接调用嵌入到js中产生效果)
    |     
    |-辅助工具.Tool
    |    |-Assistant   数据处理辅助方法  
    |
    |-Traits
    |    |-CascadeLineTrait   级联管理器的接口抽象类 
    |
    |-弹窗组件.Widget (框架Grid中调用)
    |
    |-参考样例.Test
    |    |-example      组件样例
    |    |-CascadeLineController  级联管理器 Api接口样例
    
    
### [demo样例参见](https://codepen.io/ydtg1993-the-bashful/pen/rNdWade)

### 安装
```shell script
composer require dlp/component-js
```
### 发布
```shell script
php artisan vendor:publish --provider="DLP\DLPServiceProvider" --force
```

### PHP调用

    use DLP\Assembly\Wing;
    new Wing();
    
<table> 
    <tr>
        <th style="text-align:left;">名称</td>
        <th style="text-align:left;">调用</td>
        <th style="text-align:left;">说明</td>
    </tr>
    <tr>
        <td style="text-align:left;">多(单)选择器 Dot</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L156'>->select</a>
        | <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L163'>->dot</a></td>
        <td style="text-align:left;"></td>
    </tr>
    <tr>
        <td style="text-align:left;">级联多选择器 CascadeDot</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L189'>->cascadeDot</a></td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L221'>链表数据结构参考</a>
         <br/>
         <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L211'>数据辅助组装 步骤方法</a><br/>
         </td></td> 
    </tr>
    <tr>
        <td style="text-align:left;">级联管理器 CascadeLine</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L191'>->cascadeLine</a></td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L221'>链表数据结构参考</a>
         <br/>
         <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L211'>数据辅助组装 步骤方法</a><br/>
         </td></td> 
    </tr>
    <tr>
        <td style="text-align:left;">列表控件 Linear</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L193'>->linear</a></td>
        <td style="text-align:left;">二维数组<br/>[[col=>val,col2=>val2,...],...]</td>
    </tr>
    <tr>
        <td style="text-align:left;">弹出层组件</td>
        <td style="text-align:left;"><a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L55'>Plane::headAction</a> 
        | <a target="_blank" href='https://github.com/laravel-admin-extensions/component-js/blob/main/test/example.php#L70'>Plane::rowAction</a></td>
        <td style="text-align:left;"></td>
    </tr>
</table>

