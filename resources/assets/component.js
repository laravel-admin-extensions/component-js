
let _componentMegaBlock = {
    _loadingSvg:"<svg version=\"1.1\" style='width: 100%;height:100px' xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n" +
        "   width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" enable-background=\"new 0 0 40 40\" xml:space=\"preserve\">\n" +
        "  <path opacity=\"0.2\" fill=\"#000\" d=\"M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946\n" +
        "    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634\n" +
        "    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z\"/>\n" +
        "  <path fill=\"#000\" d=\"M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0\n" +
        "    C22.32,8.481,24.301,9.057,26.013,10.047z\">\n" +
        "    <animateTransform attributeType=\"xml\"\n" +
        "      attributeName=\"transform\"\n" +
        "      type=\"rotate\"\n" +
        "      from=\"0 20 20\"\n" +
        "      to=\"360 20 20\"\n" +
        "      dur=\"0.5s\"\n" +
        "      repeatCount=\"indefinite\"/>\n" +
        "    </path>\n" +
        "  </svg>",
    _nodesBindEvent:function (nodes,event,func) {
        for (let element of nodes){
            element.addEventListener(event,func);
        }
    },
    _request: function (url,method="GET",data={},callback=function(){}) {
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.timeout = 30000;
        var token= document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        if(method == 'GET'){
            xhr.setRequestHeader("Content-type", "application/text;charset=UTF-8");
            xhr.responseType = "text";
            xhr.send(null);
        }else {
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.responseType = "json";
            xhr.send(data);
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState == xhr.DONE && xhr.status == 200) {
                var response = xhr.response;
                callback(response)
            }
        };
        xhr.onerror = function (e) {
            console.log(e)
        };
    }
};

function _componentAlert(message,time=1,callback=function () {}) {
    let div = document.createElement('div');
    div.innerHTML = message;
    let w = window.innerWidth/2 - 140;
    let h = window.innerHeight/2 - 145;
    div.style = "z-index: 1000000; position: fixed;background-color: rgba(0,0,0,.6);color: #fff;" +
        "width: 280px;height: 45px;line-height: 40px;border-radius: 3px;text-align: center;" +
        "top:"+h+"px;left:"+w+"px;";
    document.getElementsByTagName("BODY")[0].appendChild(div);
    var task = setTimeout(function () {
        clearTimeout(task);
        div.parentNode.removeChild(div);
        callback();
    },time*1000);
}

function componentDot(name,selected,options) {
    function tagSelect() {
        let cdom = this.cloneNode(true);
        cdom.addEventListener('click',tagCancel);
        document.getElementById(name+'-select').appendChild(cdom);
        this.remove();
        addVal();
    }
    function tagCancel() {
        let cdom = this.cloneNode(true);
        cdom.addEventListener('click',tagSelect);
        document.getElementById(name+'-content').appendChild(cdom);
        this.remove();
        addVal();
    }
    function addVal() {
        let val = '';
        document.getElementById(name+'-select').childNodes.forEach(function (n) {
            val += parseInt(n.getAttribute('data-id'))+",";
        });
        val = val.replace(/,$/g, '');
        dataInput.value = val
    }
    let DOM = document.getElementById(name);
    let selected_dom = '';
    let options_dom = '';
    let selected_tag = '';

    for(let i in options){
        if(selected[i]){
            selected_dom+= "<div class='btn btn-success btn-sm v-tag' data-id='"+i+"'>"+options[i]+"</div>";
            selected_tag+= i + ',';
            continue;
        }
        options_dom+= "<div class='btn btn-primary btn-sm v-tag' data-id='"+i+"'>"+options[i]+"</div>";
    }

    let html = `<style>.v-tag{margin-right: 4px;margin-bottom: 4px}</style>
        <div style="width: 100%;display: grid; grid-template-rows: 42px 140px;border: 1px solid #ccc;border-radius: 5px">
        <div style="display:flex;background: #e1ffa8bf;"><div style="width:120px;background: #e1ffa8bf;">
        <input id="${name}-search" type="text" class="form-control" placeholder="搜索名称"></div>
        <div id="${name}-select" style="width:100%;overflow: auto;border-bottom: 1px solid #ccc;padding: 3px;border-radius: 0 0 0 14px;background: #ffffffbf;">${selected_dom}</div>
        </div><div id="${name}-content" style="overflow-y: auto;padding: 3px;background: #e1ffa8bf;">
        ${options_dom}
        </div>
        </div>`;
    DOM.insertAdjacentHTML('afterbegin',html);

    /*hidden data container*/
    let dataInput = document.createElement('input');
    dataInput.setAttribute('name',name);
    dataInput.setAttribute('type','hidden');
    dataInput.value = '';
    DOM.appendChild(dataInput);

    _componentMegaBlock._nodesBindEvent(document.getElementById(name+'-select').getElementsByClassName("v-tag"),'click',tagCancel);
    _componentMegaBlock._nodesBindEvent(document.getElementById(name+'-content').getElementsByClassName("v-tag"),'click',tagSelect);
    document.getElementById(name+'-search').addEventListener('input',function () {
        let search = this.value;
        if(search == ''){
            return;
        }
        let contentDom = document.getElementById(name+'-content');
        for (let element of contentDom.getElementsByClassName("v-tag")){
            if(element.innerText.indexOf(search) != -1){
                contentDom.insertBefore(element,contentDom.firstChild);
            }
        }
    });
}

function componentLine(name,columns,data) {
    function selectTd(td,type,value,column) {
        switch (type) {
            case 'text':
                td.insertAdjacentHTML('afterbegin','<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;">'+value+'</p>');
                break;
            case 'input':
                let input = document.createElement('input');
                input.setAttribute('class','form-control');
                input.setAttribute('data-column',column);
                input.value = value;
                input.addEventListener('input',function () {
                    let key = this.parentNode.parentNode.getAttribute('data-key');
                    let column = this.getAttribute('data-column');
                    let data = JSON.parse(dataInput.value);
                    if(data[key]){
                        data[key][column] = this.value;
                        dataInput.value = JSON.stringify(data);
                    }
                });
                td.appendChild(input);
                break;
            default:
                td.insertAdjacentHTML('afterbegin','<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;">'+value+'</p>');
                break;
        }
    }
    function deleteButton(td) {
        let i = document.createElement('i');
        i.setAttribute('class','fa fa-trash');
        i.setAttribute('style','cursor: pointer');
        i.addEventListener('click',function(){
            let tr = this.parentNode.parentNode;
            let tbody = tr.parentNode;
            let data = JSON.parse(dataInput.value);
            let key = tr.getAttribute('data-key');

            data.splice(key,1);
            tbody.removeChild(tr);
            dataInput.value = JSON.stringify(data);
            for(let node in tbody.childNodes){
                if (tbody.childNodes[node] instanceof HTMLElement) {
                    tbody.childNodes[node].setAttribute('data-key', node);
                }
            }
        });
        td.style = 'width:30px';
        td.appendChild(i);
    }
    /*head foot*/
    var dom = document.getElementById(name);
    dom.style = 'overflow-x: auto;';
    var head = '<tr style="display:table;width:100%;table-layout:fixed;">';
    var foot = head;
    for (let column in columns){
        if(columns[column].type == 'hidden'){
            continue;
        }
        if(columns[column].style){
            head += '<th style="'+columns[column].style+'">'+columns[column].name+'</th>';
            foot += '<th style="'+columns[column].style+'">' +
                '<input class="form-control" data-column="'+column+'" placeholder=":'+columns[column].name+'"/></th>';
            continue;
        }
        head += '<th>'+columns[column].name+'</th>';
        foot += '<th>' +
            '<input class="form-control" data-column="'+column+'" placeholder=":'+columns[column].name+'"/></th>';
    }
    head += '<th style="width: 30px"></th></tr>';
    foot += '<th style="width: 30px" class="JsonTableInsert"></th></tr>';

    dom.insertAdjacentHTML('afterbegin',`<style>#${name} tbody::-webkit-scrollbar { width: 0 !important }
        #${name} th,#${name} td{width: 100px}
        </style><table class="table table-striped table-bordered table-hover table-responsive"><thead>${head}</thead></table>`);
    /*hidden data container*/
    var dataInput = document.createElement('input');
    dataInput.setAttribute('name',name);
    dataInput.setAttribute('type','hidden');
    dataInput.value = '[]';
    dom.appendChild(dataInput);
    /*tbody list*/
    var records = [];
    var tbody = document.createElement('tbody');
    data.forEach(function (value,key) {
        let tr = document.createElement('tr');
        let flag =false;
        let record = {};
        for (let column in columns){
            if(columns[column].type == 'hidden'){
                if(value[column]){
                    record[column] = value[column];
                }
                continue;
            }
            let td = document.createElement('td');
            if(value[column]){
                record[column] = value[column];
                flag = true;
                selectTd(td,columns[column].type,value[column],column);
                if(columns[column].style){
                    td.style = columns[column].style;
                }
            }else if(columns[column].type !== 'text'){
                selectTd(td,columns[column].type,'',column);
                if(columns[column].style){
                    td.style = columns[column].style;
                }
            }
            tr.setAttribute('data-key',key);
            tr.appendChild(td);
        }

        let td = document.createElement('td');
        deleteButton(td);
        tr.appendChild(td);
        tr.setAttribute('data-key',key);
        tr.setAttribute('style','display:table;width:100%;table-layout:fixed');
        if(flag){
            tbody.setAttribute('style','display:block;max-height:270px;overflow-y:scroll');
            tbody.appendChild(tr);
            records.push(record);
            dataInput.value = JSON.stringify(records);
        }
    });

    var tableDom = dom.getElementsByTagName('table')[0];
    tableDom.appendChild(tbody);
    var tfoot = document.createElement('tfoot');
    tfoot.style = 'background:#f3ffdb';
    tfoot.innerHTML = foot;
    tableDom.appendChild(tfoot);
    /*foot insert*/
    var i = document.createElement('i');
    i.setAttribute('class','fa fa-edit');
    i.style = 'cursor: pointer';
    i.addEventListener('click',function () {
        let data = JSON.parse(dataInput.value);
        let inputs = dom.getElementsByTagName('tfoot')[0].getElementsByTagName('input');
        let insert = {};
        let tr = document.createElement('tr');
        tr.style = 'display:table;width:100%;table-layout:fixed';
        tr.setAttribute('data-key',data.length);
        for(let input in inputs){
            if(inputs.hasOwnProperty(input)){
                let td = document.createElement('td');
                let column = inputs[input].getAttribute('data-column');
                insert[column] = inputs[input].value;

                selectTd(td,columns[column].type,inputs[input].value,column);
                if(columns[column].style){
                    td.style = columns[column].style;
                }
                tr.appendChild(td);
            }
        }
        let td = document.createElement('td');
        deleteButton(td);
        tr.appendChild(td);
        tbody.appendChild(tr);
        data.push(insert);
        dataInput.value = JSON.stringify(data);
        tbody.scrollTop = tbody.scrollHeight;
    });
    dom.getElementsByClassName('JsonTableInsert')[0].appendChild(i);
}

function componentPlane(url,method='POST'){
    let Form = {
        make:function (url) {
            this._clear();
            this._createModal();
            this._createBox(url);
        },
        _clear:function(){
            this._modalBodyNode = null;
            this._boxNode = null;
            this._boxBodyNode = null;
            this._tableNode = null;
            this._loadingNode = null;
        },
        _modalBodyNode:null,
        _boxNode:null,
        _boxBodyNode: null,
        _tableNode: null,
        _loadingNode:null,
        _request: function (url) {
            this._loading();
            _componentMegaBlock._request(url,'GET',{},function (response) {
                Form._loading(true);
                $('.modal-body').append(response);
                if($('.modal-body button[type="submit"]')) {
                    $('.modal-body button[type="submit"]').click(function () {
                        Form._submitEvent(this, url)
                    });
                }
            });
        },
        _submitEvent:function (obj,url) {
            obj.setAttribute('disabled','disabled');
            obj.innerText = '提交中...';
            let form = Form._modalBodyNode.getElementsByTagName('form')[0];
            let formdata = new FormData(form);

            _componentMegaBlock._request(url,method,formdata,function (response) {
                if(response.code == 0) {
                    window.location.reload();
                }else{
                    _componentAlert(response.message,3,function () {
                        obj.removeAttribute('disabled');
                        obj.innerText = '提交';
                    });
                }
            });
        },
        _createBox: function (url) {
            let box = document.createElement("div");
            box.className = "box grid-box";
            let box_body = document.createElement("div");
            box_body.className = "box-body table-responsive no-padding";

            box.append(box_body);
            this._boxNode = box;
            this._boxBodyNode = box_body;
            this._request(url);
            return;
        },
        _loading: function (remove = false) {
            if (remove && this._loadingNode) {
                this._modalBodyNode.removeChild(this._loadingNode);
                this._loadingNode = null;
                return;
            }
            if (this._loadingNode instanceof HTMLElement) {
                return;
            }
            let svg = _componentMegaBlock._loadingSvg;
            let loading = document.createElement('div');
            loading.style = 'width: 100%;height: 100px;';
            loading.innerHTML = svg;
            this._loadingNode = loading;
            let firstChild = this._modalBodyNode.childNodes[0];
            if (firstChild instanceof HTMLElement) {
                this._modalBodyNode.insertBefore(loading, firstChild);
                return;
            }
            this._modalBodyNode.append(loading);
        },
        _createModal: function () {
            //modal
            let modal = document.createElement("div");
            modal.setAttribute('class', 'modal grid-modal in');
            modal.setAttribute('tabindex', '-1');
            modal.setAttribute('role', 'dialog');
            modal.style = 'display: block;';

            //modal_dialog
            let mod_dialog = document.createElement("div");
            mod_dialog.setAttribute('class', 'modal-dialog modal-lg');
            mod_dialog.setAttribute('role', 'document');
            mod_dialog.style = 'width:' + window.innerWidth * 0.8 + 'px';
            //modal_content
            let modal_content = document.createElement("div");
            modal_content.className = "modal-content";

            //header
            let modal_header = document.createElement("div");
            modal_header.className = 'modal-header';
            modal_header.style = 'background-color:#ffffff;padding: 3px;display: flex;justify-content:flex-end;';
            //X
            let X = document.createElement('i');
            X.setAttribute('class', 'fa fa-close');
            X.setAttribute('style', 'cursor: pointer');

            X.addEventListener('click', function () {
                document.body.removeChild(modal);
            });

            let modal_body = document.createElement('div');
            modal_body.className = "modal-body";
            modal_body.style = 'background-color:#f4f4f4;padding:0;overflow-y:auto;height:' + window.innerHeight * 0.8 + 'px';

            this._modalBodyNode = modal_body;
            this._loading();
            //create modal
            modal_header.append(X);
            modal_content.append(modal_header);
            modal_content.append(modal_body);
            mod_dialog.append(modal_content);
            modal.appendChild(mod_dialog);
            document.body.append(modal);
        }
    };
    Form.make(url)
}




