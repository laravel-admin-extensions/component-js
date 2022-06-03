function nodesBindEvent(nodes,event,func) {
    for (let element of nodes){
        element.addEventListener(event,func);
    }
}

function componentSelect(name,selected,options) {
    function tagSelect() {
        var cdom = this.cloneNode(true);
        cdom.addEventListener('click',tagCancel);
        document.getElementById(name+'-select').appendChild(cdom);
        this.remove();
        addVal();
    }
    function tagCancel() {
        var cdom = this.cloneNode(true);
        cdom.addEventListener('click',tagSelect);
        document.getElementById(name+'-content').appendChild(cdom);
        this.remove();
        addVal();
    }
    function addVal() {
        var val = '';
        document.getElementById(name+'-select').childNodes.forEach(function (n) {
            val += parseInt(n.getAttribute('data-id'))+",";
        });
        val = val.replace(/,$/g, '');
        document.getElementById(name).setAttribute('data',val);
    }

    var selected_dom = '';
    var options_dom = '';
    var selected_tag = '';

    for(var i in options){
        if(selected.indexOf(parseInt(i)) > -1){
            selected_dom+= "<div class='btn btn-success btn-sm v-tag' data-id='"+i+"'>"+options[i].name+"</div>";
            selected_tag+= i + ',';
            continue;
        }
        options_dom+= "<div class='btn btn-primary btn-sm v-tag' data-id='"+i+"'>"+options[i].name+"</div>";
    }

    var html = '<style>.v-tag{margin-right: 4px;margin-bottom: 4px}</style>'+
        '<div style="width: 100%;display: grid; grid-template-rows: 42px 140px;border: 1px solid #ccc;border-radius: 5px">' +
        '<div style="display:flex;background: #acd55cbf;"><div style="width:25%;background: #dbedb885;">' +
        '<input id="'+name+'-search" type="text" class="form-control" placeholder="搜索名称"></div>' +
        '<div id="'+name+'-select" style="width:75%;overflow-y: auto;border-bottom: 1px solid #ccc;padding: 3px;border-radius: 0 0 0 14px;background: #ffffffbf;"></div> ' +
        selected_dom+
        '</div><div id="'+name+'-content" style="overflow-y: auto;padding: 3px;background: #acd55cbf;">' +
        options_dom +
        '</div>' +
        '</div>';
    document.getElementById(name).innerHTML = html;
    nodesBindEvent(document.getElementById(name+'-select').getElementsByClassName("v-tag"),'click',tagCancel);
    nodesBindEvent(document.getElementById(name+'-content').getElementsByClassName("v-tag"),'click',tagSelect);
    document.getElementById(name+'-search').addEventListener('input',function () {
        var search = this.value;
        if(search == ''){
            return;
        }
        var contentDom = document.getElementById(name+'-content');
        for (let element of contentDom.getElementsByClassName("v-tag")){
            if(element.innerText.indexOf(search) != -1){
                contentDom.insertBefore(element,contentDom.firstChild);
            }
        }
    });
}

function componentJsonTable(name,columns,data) {
    function selectTd(td,type,value,column) {
        switch (type) {
            case 'text':
                td.innerHTML = '<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;">'+value+'</p>';
                break;
            case 'input':
                let input = document.createElement('input');
                input.setAttribute('name',name+'_'+column);
                input.setAttribute('class','form-control');
                input.setAttribute('data-column',column);
                input.value = value;
                input.addEventListener('input',function () {
                    let key = this.parentNode.parentNode.getAttribute('data-key');
                    let column = this.getAttribute('data-column');
                    let data = JSON.parse(dom.getAttribute('data'));
                    if(data[key]){
                        data[key][column] = this.value;
                        dom.setAttribute('data',JSON.stringify(data));
                    }
                });
                td.appendChild(input);
                break;
            default:
                td.innerHTML = '<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;">'+value+'</p>';
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
            let data = JSON.parse(dom.getAttribute('data'));
            let key = tr.getAttribute('data-key');

            data.splice(key,1);
            tbody.removeChild(tr);
            dom.setAttribute('data',JSON.stringify(data));
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
    var head = '<tr style="display:table;width:100%;table-layout:fixed;">';
    var foot = head;
    for (let column in columns){
        if(columns[column].type == 'hidden'){
            continue;
        }
        if(columns[column].style){
            head += '<th style="'+columns[column].style+'">'+columns[column].name+'</th>';
            foot += '<th style="'+columns[column].style+'">' +
                '<input class="form-control" data-column="'+column+'" name="'+name+'_'+column+'" placeholder="添加:'+columns[column].name+'"/></th>';
            continue;
        }
        head += '<th>'+columns[column].name+'</th>';
        foot += '<th>' +
            '<input class="form-control" data-column="'+column+'" name="'+name+'_'+column+'" placeholder="添加:'+columns[column].name+'"/></th>';
    }
    head += '<th style="width: 30px"></th></tr>';
    foot += '<th style="width: 30px" class="JsonTableInsert"></th></tr>';

    dom.innerHTML = '<style>#'+name+' tbody::-webkit-scrollbar { width: 0 !important }</style>' +
        '<table class="table table-striped table-bordered table-hover table-responsive">'+
        '<thead>'+head+'</thead></table>';
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
            dom.setAttribute('data',JSON.stringify(records));
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
        let data = JSON.parse(dom.getAttribute('data'));
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
        dom.setAttribute('data',JSON.stringify(data));
        tbody.scrollTop = tbody.scrollHeight;
    });
    dom.getElementsByClassName('JsonTableInsert')[0].appendChild(i);
}

let componentCommonBlock = {
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
    }
};

let componentEditForm = {
    url: '',
    apply:function(name,url){
        this.url = url;
        componentCommonBlock._nodesBindEvent(document.getElementsByClassName(name),'click',this.make);
    },
    make:function () {
        componentEditForm._DOM = this;
        componentEditForm._modalBodyNode = null;
        componentEditForm._boxNode = null;
        componentEditForm._boxBodyNode = null;
        componentEditForm._tableNode = null;
        componentEditForm._loadingNode = null;
        componentEditForm._createModal();
        let url = componentEditForm.url + '/'+this.getAttribute('data-id') + '/edit';
        componentEditForm._createBox(url);
    },
    _DOM:null,
    _modalBodyNode:null,
    _boxNode:null,
    _boxBodyNode: null,
    _tableNode: null,
    _loadingNode:null,
    _loading:function(remove=false){
        if(remove){
            this._modalBodyNode.removeChild(this._loadingNode);
            this._loadingNode = null;
            return;
        }
        if(this._loadingNode instanceof HTMLElement){
            return;
        }
        let svg = componentCommonBlock._loadingSvg;
        let loading = document.createElement('div');
        loading.style = 'width: 100%;height: 100px;';
        loading.innerHTML = svg;
        this._loadingNode = loading;
        let firstChild = this._modalBodyNode.childNodes[0];
        if(firstChild  instanceof HTMLElement){
            this._modalBodyNode.insertBefore(loading,firstChild);
            return;
        }
        this._modalBodyNode.append(loading);
    },
    _request: function (url) {
        //loading
        var thisObj = this;
        this._loading();
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.timeout = 3000;
        xhr.responseType = "text";
        var token= document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader("Content-type", "application/text;charset=UTF-8");
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.send(null);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == xhr.DONE && xhr.status == 200) {
                thisObj._loading(true);
                var response = xhr.response;
                //thisObj._modalBodyNode.append(response);
                $('.modal-content').append(response)
            }
        };
        xhr.onerror = function (e) {
            console.log(e)
        };
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

        //modal_content
        let modal_content = document.createElement("div");
        modal_content.className = "modal-content";

        //header
        let modal_header = document.createElement("div");
        modal_header.className = 'modal-header';
        modal_header.style = 'background-color:#ffffff;padding: 3px;display: flex;justify-content:flex-end;';
        //X
        let X = document.createElement('i');
        X.setAttribute('class','fa fa-close');
        X.setAttribute('style','cursor: pointer');

        X.addEventListener('click', function () {
            document.body.removeChild(modal);
        });

        let modal_body = document.createElement('div');
        modal_body.className = "modal-body";
        modal_body.style = 'background-color:#f4f4f4;padding:0;';
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


