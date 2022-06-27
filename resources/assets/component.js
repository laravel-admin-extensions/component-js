function _componentRequest(url, method = "GET", data = {}, callback = function () {
}) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.timeout = 30000;
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    if (method == 'GET') {
        xhr.setRequestHeader("Content-type", "application/text;charset=UTF-8");
        xhr.responseType = "text";
        xhr.send(null);
    } else {
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

function _componentAlert(message, time = 1, callback = function () {
}) {
    let div = document.createElement('div');
    div.innerHTML = message;
    let w = window.innerWidth / 2 - 140;
    let h = window.innerHeight / 2 - 145;
    div.style = "z-index: 1000000; position: fixed;background-color: rgba(0,0,0,.6);color: #fff;" +
        "width: 280px;height: 45px;line-height: 40px;border-radius: 3px;text-align: center;" +
        "top:" + h + "px;left:" + w + "px;";
    document.getElementsByTagName("BODY")[0].appendChild(div);
    var task = setTimeout(function () {
        clearTimeout(task);
        div.parentNode.removeChild(div);
        callback();
    }, time * 1000);
}

class ComponentDot {
    constructor(name, selected, select) {
        this.DOM = document.getElementById(name);
        let selected_dom = '';
        let select_dom = '';
        for (let i in select) {
            if (selected[i]) {
                selected_dom += `<div class='btn btn-success btn-sm v-tag' style='margin-right: 4px;margin-bottom: 4px' data-id='${i}'>${select[i]}</div>`;
                continue;
            }
            select_dom += `<div class='btn btn-primary btn-sm v-tag' style='margin-right: 4px;margin-bottom: 4px' data-id='${i}'>${select[i]}</div>`;
        }

        this.selected_data = Object.keys(selected);
        this.select_data = this.selected_data.map((x) => x);
        let select_str = JSON.stringify(this.select_data);
        this.insert_data = [];
        this.delete_data = [];
        let html = `<div style="width: 100%;height:100%;display: grid; grid-template-rows: 42px auto;border: 1px solid #ccc;border-radius: 5px">
        <div style="display:flex;background: #e1ffa8bf;"><div style="width:120px;background: #e1ffa8bf;">
        <input id="${name}-search" type="text" class="form-control" placeholder="搜索名称"></div>
        <div id="${name}-select" style="width:100%;overflow: auto;border-bottom: 1px solid #ccc;padding: 3px;border-radius: 0 0 0 14px;background: #ffffffbf;">${selected_dom}</div>
        </div><div id="${name}-content" style="overflow-y: auto;padding: 3px;background: #e1ffa8bf;">
        ${select_dom}</div></div>
        <input name="${name}[data]" value='${select_str}' type="hidden">
        <input name="${name}[insert]" value="[]" type="hidden">
        <input name="${name}[delete]" value="[]" type="hidden">`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.SELECT_DOM = document.getElementById(name + '-select');
        this.CONTENT_DOM = document.getElementById(name + '-content');
        this.dataDOM = document.querySelector(`input[name='${name}[data]']`);
        this.insertDOM = document.querySelector(`input[name='${name}[insert]']`);
        this.deleteDOM = document.querySelector(`input[name='${name}[delete]']`);

        for (let element of document.getElementById(name + '-select').getElementsByClassName("v-tag")) {
            element.addEventListener('click', this.tagCancel.bind(this, element),false);
        }
        for (let element of document.getElementById(name + '-content').getElementsByClassName("v-tag")) {
            element.addEventListener('click', this.tagSelect.bind(this, element),false);
        }
        document.getElementById(name + '-search').addEventListener('input', function () {
            let search = this.value;
            if (search == '') {
                return;
            }
            let contentDom = document.getElementById(name + '-content');
            for (let element of contentDom.getElementsByClassName("v-tag")) {
                if (element.innerText.indexOf(search) != -1) {
                    contentDom.insertBefore(element, contentDom.firstChild);
                }
            }
        },false);
    }

    tagSelect(element) {
        let cdom = element.cloneNode(true);
        cdom.addEventListener('click', this.tagCancel.bind(this, cdom),false);
        this.SELECT_DOM.appendChild(cdom);
        element.remove();
        this.tagCal(cdom, 'insert');
    }

    tagCancel(element) {
        let cdom = element.cloneNode(true);
        cdom.addEventListener('click', this.tagSelect.bind(this, cdom),false);
        this.CONTENT_DOM.appendChild(cdom);
        element.remove();
        this.tagCal(cdom, 'delete');
    }

    tagCal(cdom, operate) {
        let id = cdom.getAttribute('data-id');
        if (operate == 'insert') {
            if (this.select_data.indexOf(id) == -1) {
                this.select_data.push(id);
                this.dataDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) == -1 && this.insert_data.indexOf(id) == -1) {
                this.insert_data.push(id);
                this.insertDOM.value = JSON.stringify(this.insert_data);
            }
            let index = this.delete_data.indexOf(id);
            if (index != -1) {
                this.delete_data.splice(index, 1);
                this.deleteDOM.value = JSON.stringify(this.delete_data);
            }
            return;
        }
        if (operate == 'delete') {
            let index = this.select_data.indexOf(id);
            if (index != -1) {
                this.select_data.splice(index, 1);
                this.dataDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) != -1 && this.delete_data.indexOf(id) == -1) {
                this.delete_data.push(id);
                this.deleteDOM.value = JSON.stringify(this.delete_data);
            }
            index = this.insert_data.indexOf(id);
            if (index != -1) {
                this.insert_data.splice(index, 1);
                this.insertDOM.value = JSON.stringify(this.insert_data);
            }
        }
    }
}

class ComponentLine {
    constructor(name, columns, data, options={}) {
        this.DOM = document.getElementById(name);
        this.NAME = name;
        this.COLUMNS = columns;
        this.DATA = data;
        this.OPTIONS = Object.assign({
            sortable: true,
            delete: true,
        }, options);
        /*head foot*/
        let foot = this.makeHead();
        /*hidden data container*/
        this.DATA_INPUT = document.createElement('input');
        this.DATA_INPUT.setAttribute('name', name);
        this.DATA_INPUT.setAttribute('type', 'hidden');
        this.DATA_INPUT.value = '[]';
        this.DOM.appendChild(this.DATA_INPUT);
        /*tbody list*/
        this.makeBody();
        /*foot*/
        this.makeFoot(foot);
        /*sort*/
        if(this.OPTIONS.sortable) this.sortable();
    }

    makeHead() {
        let head = '<tr style="display:table;width:100%;table-layout:fixed;">';
        let foot = head;
        let columns = this.COLUMNS;
        for (let column in columns) {
            if (columns[column].type == 'hidden') {
                continue;
            }
            if (columns[column].style) {
                head += `<th style="${columns[column].style}">${columns[column].name}</th>`;
                foot += `<th style="${columns[column].style}"><input class="form-control" data-column="${column}" placeholder=":${columns[column].name}"/></th>`;
                continue;
            }
            head += '<th>' + columns[column].name + '</th>';
            foot += `<th><input class="form-control" data-column="${column}" placeholder=":${columns[column].name}"/></th>`;
        }
        head += '<th style="width: 50px"></th></tr>';
        foot += '<th style="width: 50px" class="JsonTableInsert"></th></tr>';

        this.DOM.insertAdjacentHTML('afterbegin', `<style>#${this.NAME} tbody::-webkit-scrollbar { width: 0 !important }</style>
        <table class="table table-striped table-bordered table-hover table-responsive" style="height: 100%"><thead>${head}</thead></table>`);
        this.TABLE_DOM = this.DOM.getElementsByTagName('table')[0];
        return foot;
    }

    makeBody() {
        var records = [];
        var tbody = document.createElement('tbody');
        var object = this;
        var columns = this.COLUMNS;
        this.DATA.forEach(function (value, key) {
            let tr = document.createElement('tr');
            tr.setAttribute('sortable-item','sortable-item');
            let record = {};
            for (let column in columns) {
                if (columns[column].type == 'hidden') {
                    if (value[column]) {
                        record[column] = value[column];
                    }
                    continue;
                }
                let td = document.createElement('td');
                if (value[column]) {
                    record[column] = value[column];
                    object.makeTd(td, columns[column].type, value[column], column);
                    if (columns[column].style) {
                        td.style = columns[column].style;
                    }
                } else {
                    record[column] = '';
                    object.makeTd(td, columns[column].type, '', column);
                    if (columns[column].style) {
                        td.style = columns[column].style;
                    }
                }
                tr.setAttribute('style', 'display:table;width:100%;table-layout:fixed');
                tr.setAttribute('data-key', key);
                tr.appendChild(td);
            }

            let td = document.createElement('td');
            object.operateButton(td);
            tr.appendChild(td);
            tbody.appendChild(tr);
            records.push(record);
            object.DATA = records;
            object.DATA_INPUT.value = JSON.stringify(records);
        });
        tbody.setAttribute('style', 'display:block;height:100%;overflow-y:scroll');
        tbody.setAttribute('sortable-list','sortable-list');
        this.TBODY_DOM = tbody;
        this.TABLE_DOM.appendChild(tbody);
    }

    makeFoot(foot) {
        let tfoot = document.createElement('tfoot');
        tfoot.style = 'background:#f3ffdb';
        tfoot.insertAdjacentHTML('afterbegin', foot);
        this.TABLE_DOM.appendChild(tfoot);
        /*insert action*/
        var object = this;
        var i = document.createElement('i');
        i.setAttribute('class', 'fa fa-edit');
        i.style = 'cursor: pointer';
        i.addEventListener('click', function () {
            let inputs = object.DOM.getElementsByTagName('tfoot')[0].getElementsByTagName('input');
            let insert = {};
            let tr = document.createElement('tr');
            tr.style = 'display:table;width:100%;table-layout:fixed';
            tr.setAttribute('sortable-item','sortable-item');
            tr.setAttribute('data-key', object.DATA.length);
            for (let input in inputs) {
                if (inputs.hasOwnProperty(input)) {
                    let td = document.createElement('td');
                    let column = inputs[input].getAttribute('data-column');
                    insert[column] = inputs[input].value;

                    object.makeTd(td, object.COLUMNS[column].type, inputs[input].value, column);
                    if (object.COLUMNS[column].style) {
                        td.style = object.COLUMNS[column].style;
                    }
                    tr.appendChild(td);
                    inputs[input].value = '';
                }
            }
            let td = document.createElement('td');
            object.operateButton(td);
            tr.appendChild(td);
            object.TBODY_DOM.appendChild(tr);
            object.DATA.push(insert);
            object.DATA_INPUT.value = JSON.stringify(object.DATA);
            object.TBODY_DOM.scrollTop = object.TBODY_DOM.scrollHeight;
        },false);
        this.DOM.getElementsByClassName('JsonTableInsert')[0].appendChild(i);
    }

    makeTd(td, type, value, column, attributes) {
        var object = this;
        switch (type) {
            case 'text':
                td.insertAdjacentHTML('afterbegin', `<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;" title="${value}">${value}</p>`);
                break;
            case 'input':
                let input = document.createElement('input');
                input.setAttribute('class', 'form-control');
                input.setAttribute('data-column', column);
                input.value = value;
                input.style = 'width:100%;padding:1px';
                for (let attribute in attributes) {
                    input.setAttribute(attribute, attributes[attribute]);
                }
                input.addEventListener('input', function () {
                    let key = this.parentNode.parentNode.getAttribute('data-key');
                    let column = this.getAttribute('data-column');
                    if (object.DATA[key]) {
                        object.DATA[key][column] = this.value;
                        object.DATA_INPUT.value = JSON.stringify(object.DATA);
                    }
                },false);
                td.appendChild(input);
                break;
            default:
                td.insertAdjacentHTML('afterbegin', `<p style="text-overflow: ellipsis;overflow: hidden;display: block;white-space: nowrap;" title="${value}">${value}</p>`);
                break;
        }
    }

    operateButton(td) {
        var object = this;
        if(this.OPTIONS.sortable) {
            let M = document.createElement('i');
            M.setAttribute('class', 'fa fa-arrows');
            M.setAttribute('style', 'cursor: pointer;margin-right:5px;');
            M.setAttribute('sortable-handle', 'sortable-handle');
            td.appendChild(M);
        }

        if(this.OPTIONS.delete) {
            let D = document.createElement('i');
            D.setAttribute('class', 'fa fa-trash');
            D.setAttribute('style', 'cursor: pointer');
            D.addEventListener('click', function () {
                let tr = this.parentNode.parentNode;
                let tbody = tr.parentNode;
                let key = tr.getAttribute('data-key');

                object.DATA.splice(key, 1);
                tbody.removeChild(tr);
                object.DATA_INPUT.value = JSON.stringify(object.DATA);
                for (let node in tbody.childNodes) {
                    if (tbody.childNodes[node] instanceof HTMLElement) {
                        tbody.childNodes[node].setAttribute('data-key', node);
                    }
                }
            }, false);
            td.appendChild(D);
        }
        td.style = 'width:50px';
    }

    sortable(){
        var object = this;
        this.SORTABLE = new ComponentSortable(this.TBODY_DOM,function (sort) {
            let data = [];
            sort.forEach(function (k) {
                data.push(object.DATA[k]);
            });
            object.DATA = data;
            object.DATA_INPUT.value = JSON.stringify(object.DATA);
        });
    }
}

class ComponentPlane {
    _loadingSvg=`<svg version="1.1" style='width: 100%;height:100px' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
    <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
    <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
    C22.32,8.481,24.301,9.057,26.013,10.047z"><animateTransform attributeType="xml"attributeName="transform"
   type="rotate"from="0 20 20"to="360 20 20"dur="0.5s"repeatCount="indefinite"/></path></svg>`;

    constructor(url, xhr_url = '', method = 'POST', callback = null,options = {}) {
        this.URL = url;
        this.XHR_URL = xhr_url;
        this.METHOD = method;
        this.CALLBACK = callback;
        this.OPTIONS = Object.assign({
            W: 0.8,
            H: 0.8,
        }, options);

        this.makeModal();
        this.makeContent();
    }

    makeModal() {
        /*modal*/
        let modal = document.createElement("div");
        modal.setAttribute('class', 'modal grid-modal in');
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('role', 'dialog');
        modal.style = 'display: block;';
        /*modal_dialog*/
        let mod_dialog = document.createElement("div");
        mod_dialog.setAttribute('class', 'modal-dialog modal-lg');
        mod_dialog.setAttribute('role', 'document');
        mod_dialog.style = `width:${window.innerWidth*this.OPTIONS.W}px`;
        /*modal_content*/
        let modal_content = document.createElement("div");
        modal_content.className = "modal-content";
        /*header*/
        let modal_header = document.createElement("div");
        modal_header.className = 'modal-header';
        modal_header.style = 'background-color:#ffffff;padding: 3px;display: flex;justify-content:flex-end;';
        /*X*/
        let X = document.createElement('i');
        X.setAttribute('class', 'fa fa-close');
        X.setAttribute('style', 'cursor: pointer');
        X.addEventListener('click', function () {
            document.body.removeChild(modal);
            if (document.getElementById('kvFileinputModal') instanceof HTMLElement) {
                document.getElementById('kvFileinputModal').remove();
            }
        },false);
        let modal_body = document.createElement('div');
        modal_body.className = "modal-body";
        modal_body.style = 'background-color:#f4f4f4;padding:0;overflow-y:auto;max-height:' +
            window.innerHeight * this.OPTIONS.H + 'px;min-height:' + window.innerHeight * this.OPTIONS.H / 2 + 'px;';

        this.MODEL_BODY_DOM = modal_body;
        /*create modal*/
        modal_header.append(X);
        modal_content.append(modal_header);
        modal_content.append(modal_body);
        mod_dialog.append(modal_content);
        modal.appendChild(mod_dialog);
        document.body.append(modal);
    }

    makeContent() {
        this.loading();
        var object = this;
        _componentRequest(this.URL, 'GET', {}, function (response) {
            object.loading(true);
            $('.modal-body').append(response);
            let submit = document.querySelector('.modal-body button[type="submit"]');
            if (submit instanceof HTMLElement) {
                submit.addEventListener('click', object.submitEvent.bind(object,submit),false);
            }
        });
    }

    submitEvent(element){
        element.setAttribute('disabled', 'disabled');
        element.innerText = '提交中...';
        let form = this.MODEL_BODY_DOM.getElementsByTagName('form')[0];
        let formdata = new FormData(form);
        var object = this;
        _componentRequest(this.XHR_URL, this.METHOD, formdata, function (response) {
            if (typeof object.CALLBACK == 'function') {
                object.CALLBACK(response);
                return;
            }
            if (response.code == 0) {
                window.location.reload();
                return;
            } else {
                _componentAlert(response.message, 3, function () {
                    element.removeAttribute('disabled');
                    element.innerText = '提交';
                });
            }
        });
    }

    loading(remove = false) {
        if (remove && this.LOADING_DOM) {
            this.MODEL_BODY_DOM.removeChild(this.LOADING_DOM);
            this.LOADING_DOM = null;
            return;
        }
        if (this.LOADING_DOM instanceof HTMLElement) {
            return;
        }
        this.LOADING_DOM = document.createElement('div');
        this.LOADING_DOM.style = 'width: 100%;height: 100px;';
        this.LOADING_DOM.insertAdjacentHTML('afterbegin', this._loadingSvg);
        let firstChild = this.MODEL_BODY_DOM.childNodes[0];
        if (firstChild instanceof HTMLElement) {
            this.MODEL_BODY_DOM.insertBefore(loading, firstChild);
            return;
        }
        this.MODEL_BODY_DOM.append(this.LOADING_DOM);
    }
}

class ComponentSortable {
    constructor(list, callback=null) {
        this.list = (typeof list === 'string')
            ? document.querySelector(list)
            : list;
        this.options = {
            animationSpeed: 200,
            animationEasing: 'ease-out',
        };
        this.callback = callback;
        this.animation = false;
        this.dragStart = this.dragStart.bind(this);
        this.dragMove = this.dragMove.bind(this);
        this.dragEnd = this.dragEnd.bind(this);
        this.list.addEventListener('touchstart', this.dragStart, false);
        this.list.addEventListener('mousedown', this.dragStart, false);
    }

    reset(){
        this.items = Array.from(this.list.children);
        if(this.items[this.items.length-1].offsetTop > this.list.offsetHeight){
            this.listHeight = this.list.scrollHeight;
        }else {
            this.listHeight = this.items[this.items.length-1].offsetTop;
        }
    }

    dragStart(e) {
        this.reset();
        if (this.animation) return;
        if(this.items.length<2)return;
        this.handle = null;

        let el = e.target;
        while (el) {
            if (el.hasAttribute('sortable-handle')) this.handle = el;
            if (el.hasAttribute('sortable-item')) this.item = el;
            if (el.hasAttribute('sortable-list')) break;
            el = el.parentElement;
        }

        if (!this.handle) return;
        this.list.style.position = 'relative';
        this.item.classList.add('is-dragging')
        this.itemHeight = this.items[1].offsetTop;
        this.startTouchY = this.getDragY(e);
        this.startTop = this.item.offsetTop;

        const offsetsTop = this.items.map(item => item.offsetTop);

        this.items.forEach((item, index) => {
            item.style.position = 'absolute';
            item.style.top = 0;
            item.style.left = 0;
            item.style.transform = `translateY(${offsetsTop[index]}px)`;
            item.style.zIndex = (item == this.item) ? 2 : 1;
        });

        this.positions = this.items.map((item, index) => index);
        this.position = Math.round((this.startTop / this.listHeight) * this.items.length);

        this.touch = e.type == 'touchstart';
        window.addEventListener((this.touch ? 'touchmove' : 'mousemove'), this.dragMove);
        window.addEventListener((this.touch ? 'touchend' : 'mouseup'), this.dragEnd, false);
    }

    dragMove(e) {
        if (this.animation) return;
        if(this.items.length<2)return;
        const top = this.startTop + this.getDragY(e) - this.startTouchY;
        const newPosition = Math.round((top / this.listHeight) * this.items.length);

        this.item.style.transform = `translateY(${top}px)`;

        this.positions.forEach(index => {
            if (index == this.position || index != newPosition) return;
            this.swapElements(this.positions, this.position, index);
            this.position = index;
        });
        this.items.forEach((item, index) => {
            if (item == this.item) return;
            item.style.transform = `translateY(${this.positions.indexOf(index) * this.itemHeight}px)`;
            item.style.transition = `transform ${this.options.animationSpeed}ms ${this.options.animationEasing}`;
        });

        e.preventDefault();
    }

    dragEnd(e) {
        this.animation = true;
        if(this.items.length<2)return;
        this.item.style.transition = `all ${this.options.animationSpeed}ms ${this.options.animationEasing}`;
        this.item.style.transform = `translateY(${this.position * this.itemHeight}px)`;
        this.item.classList.remove('is-dragging');
        if(typeof this.callback == 'function') this.callback(this.positions);

        setTimeout(() => {
            this.list.style.position = '';

            this.items.forEach(item => {
                item.style.top = '';
                item.style.left = '';
                item.style.right = '';
                item.style.position = '';
                item.style.transform = '';
                item.style.transition = '';
                item.style.zIndex = '';
            });

            this.positions.map(i => {
                if(this.items[i]) {
                    this.list.appendChild(this.items[i]);
                }
            });
            this.animation = false;
        }, this.options.animationSpeed);

        window.removeEventListener((this.touch ? 'touchmove' : 'mousemove'), this.dragMove, {passive: false});
        window.removeEventListener((this.touch ? 'touchend' : 'mouseup'), this.dragEnd, false);
    }

    swapElements(array, a, b) {
        const temp = array[a];
        array[a] = array[b];
        array[b] = temp;
    }

    getDragY(e) {
        return e.touches ? (e.touches[0] || e.changedTouches[0]).pageY : e.pageY;
    }
}