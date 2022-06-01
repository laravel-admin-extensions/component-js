function nodesEvent(nodes,event,func) {
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
        $('#'+name+'-select').children().each(function(i,n){
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
    nodesEvent(document.getElementById(name+'-select').getElementsByClassName("v-tag"),'click',tagCancel);
    nodesEvent(document.getElementById(name+'-content').getElementsByClassName("v-tag"),'click',tagSelect);
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
                td.innerText = value;
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
