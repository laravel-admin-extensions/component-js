const _componentSvg = {
    'trash': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>`,
    'move': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/>
</svg>`,
    'write': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>`,
    'close': `<svg style="vertical-align: middle;" width="14" height="14" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="white" stroke-width="2.5" d="M16,16 L4,4"></path><path fill="none" stroke="white" stroke-width="2.5" d="M16,4 L4,16"></path></svg>`,
    'loading': `<svg version="1.1" style='width: 100%;height:100px' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
<path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
<path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
C22.32,8.481,24.301,9.057,26.013,10.047z"><animateTransform attributeType="xml"attributeName="transform"
type="rotate"from="0 20 20"to="360 20 20"dur="0.5s"repeatCount="indefinite"/></path></svg>`,
    'check': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>`,
    'check_circle': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>`
};

function _componentRequest(url, method = "GET", data = {}, callback = function () {
}) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.timeout = 30000;
    let token = '';
    if (document.querySelector('meta[name="csrf-token"]')) {
        token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    if (method === 'GET') {
        xhr.setRequestHeader("Content-type", "application/text;charset=UTF-8");
        xhr.responseType = "text";
        xhr.send(null);
    } else {
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.responseType = "json";
        xhr.send(data);
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            var response = xhr.response;
            callback(response);
        }
    };
    xhr.onerror = function (e) {
        console.log(e);
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
    MODE = {
        insert: 'insert',
        delete: 'delete'
    };

    constructor(name, selected, select) {
        this.name = name;
        this.DOM = document.getElementById(name);
        if (!Array.isArray(selected)) {
            console.error('Dot param selected is not array!');
            return;
        }
        this.make(selected, select);
        this.selected_data = selected;
        this.select_data = selected.slice(0);
        this.insert_data = [];
        this.delete_data = [];

        for (let element of this.SELECTED_DOM.getElementsByClassName("dlp-label")) {
            element.addEventListener('click', this.tagCancel.bind(this, element), false);
        }
        for (let element of this.CONTENT_DOM.getElementsByClassName("dlp-label")) {
            element.addEventListener('click', this.tagSelect.bind(this, element), false);
        }
        this.search();
    }

    make(selected, select) {
        let selected_dom = '';
        let select_dom = '';
        for (let i in select) {
            if (selected.indexOf(parseInt(i)) !== -1) {
                selected_dom += `<div class='dlp dlp-text dlp-label' data-id='${i}' title="${select[i]}">${select[i]}</div>`;
                continue;
            }
            select_dom += `<div class='dlp dlp-text dlp-label' data-id='${i}' title="${select[i]}">${select[i]}</div>`;
        }

        let html = `<div class="dlp-dot" ><div class="dot-top"><input type="text" class="dlp dot-search" placeholder="搜索名称"><div id="${this.name}-select" class="dot-selected dlp-scroll">${selected_dom}</div></div><div class="dot-select dlp-scroll">${select_dom}</div></div>
<input name="${this.name}[select]" value='${JSON.stringify(selected)}' type="hidden"><input name="${this.name}[insert]" value="[]" type="hidden"><input name="${this.name}[delete]" value="[]" type="hidden">`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.SELECTED_DOM = document.querySelector(`#${this.name} .dot-selected`);
        this.CONTENT_DOM = document.querySelector(`#${this.name} .dot-select`);
        this.selectInputDOM = document.querySelector(`input[name='${this.name}[select]']`);
        this.insertInputDOM = document.querySelector(`input[name='${this.name}[insert]']`);
        this.deleteInputDOM = document.querySelector(`input[name='${this.name}[delete]']`);
    }

    tagSelect(element) {
        let cdom = element.cloneNode(true);
        cdom.addEventListener('click', this.tagCancel.bind(this, cdom), false);
        this.SELECTED_DOM.appendChild(cdom);
        element.remove();
        this.tagCal(cdom, this.MODE.insert);
        this.SELECTED_DOM.scrollTop = this.SELECTED_DOM.scrollHeight;
    }

    tagCancel(element) {
        let cdom = element.cloneNode(true);
        cdom.addEventListener('click', this.tagSelect.bind(this, cdom), false);
        this.CONTENT_DOM.appendChild(cdom);
        element.remove();
        this.tagCal(cdom, this.MODE.delete);
    }

    tagCal(cdom, operate) {
        let id = parseInt(cdom.getAttribute('data-id'));
        if (operate === this.MODE.insert) {
            if (this.select_data.indexOf(id) === -1) {
                this.select_data.push(id);
                this.selectInputDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) === -1 && this.insert_data.indexOf(id) === -1) {
                this.insert_data.push(id);
                this.insertInputDOM.value = JSON.stringify(this.insert_data);
            }
            let index = this.delete_data.indexOf(id);
            if (index !== -1) {
                this.delete_data.splice(index, 1);
                this.deleteInputDOM.value = JSON.stringify(this.delete_data);
            }
            return;
        }
        if (operate === this.MODE.delete) {
            let index = this.select_data.indexOf(id);
            if (index !== -1) {
                this.select_data.splice(index, 1);
                this.selectInputDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) !== -1 && this.delete_data.indexOf(id) === -1) {
                this.delete_data.push(id);
                this.deleteInputDOM.value = JSON.stringify(this.delete_data);
            }
            index = this.insert_data.indexOf(id);
            if (index !== -1) {
                this.insert_data.splice(index, 1);
                this.insertInputDOM.value = JSON.stringify(this.insert_data);
            }
        }
    }

    search() {
        var object = this;
        document.querySelector(`#${this.name} .dot-search`).addEventListener('input', function () {
            let search = this.value;
            if (search === '') {
                return;
            }
            for (let element of object.CONTENT_DOM.getElementsByClassName("dlp-label")) {
                if (element.innerText.indexOf(search) !== -1) {
                    object.CONTENT_DOM.insertBefore(element, object.CONTENT_DOM.firstChild);
                }
            }
        }, false);
    }
}

class ComponentCascadeDot {
    MODE = {
        insert: 'insert',
        delete: 'delete'
    };

    constructor(name, selected, select, options) {
        this.name = name;
        this.DOM = document.getElementById(name);
        if (!Array.isArray(selected)) {
            console.error('CascadeDot param selected is not array!');
            return;
        }
        this.selected_data = selected;
        this.select_data = selected.slice(0);
        this.insert_data = [];
        this.delete_data = [];
        this.make().makeSelect(select);
        this.selectInputDOM.value = JSON.stringify(this.select_data);
    }

    make() {
        let html = `<div class="dlp-dot" ><div class="dot-top"><input type="text" class="dlp dot-search" placeholder="搜索名称"><div id="${this.name}-select" class="dot-selected dlp-scroll"></div></div><div class="dot-select dot-select-cascade dlp-scroll"></div></div>
<input name="${this.name}[select]" value="[]" type="hidden"><input name="${this.name}[insert]" value="[]" type="hidden"><input name="${this.name}[delete]" value="[]" type="hidden">`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.SELECTED_DOM = document.querySelector(`#${this.name} .dot-selected`);
        this.CONTENT_DOM = document.querySelector(`#${this.name} .dot-select`);
        this.selectInputDOM = document.querySelector(`input[name='${this.name}[select]']`);
        this.insertInputDOM = document.querySelector(`input[name='${this.name}[insert]']`);
        this.deleteInputDOM = document.querySelector(`input[name='${this.name}[delete]']`);
        return this;
    }

    makeSelect(select) {
        this.dimensional_data = [];
        this.makeDimensional(select);
        for (let stack in this.dimensional_data) {
            stack = parseInt(stack);
            let data = this.dimensional_data[stack];
            let stackDom = document.createElement('div');
            stackDom.className = 'dot-cascade-stack dlp-scroll';
            data.forEach((v, k) => {
                if(Array.isArray(v.nodes) && v.nodes.length !==0) {
                    v.nodes = v.nodes.map((N) => N.key);
                }else {
                    v.nodes = null;
                    v.checked = false;
                }
                let div = document.createElement('div');
                div.className = 'dlp dlp-text dlp-label';
                div.textContent = v.val;
                div.setAttribute('data-id', v.key);
                div.setAttribute('data-k', k);
                div.addEventListener('click', this.select.bind(this, div, stack));
                stackDom.append(div);
                /*selected append*/
                let index = this.selected_data.indexOf(parseInt(v.key));
                if (v.checked !== false && index !== -1) {
                    this.selected_data.splice(index, 1);
                    this.select_data = this.selected_data.slice(0);
                    return;
                }
                if (index !== -1) {
                    v.checked = true;
                }
            });
            this.CONTENT_DOM.append(stackDom);
        }
        console.log(this.dimensional_data)
        this.STACKS = this.CONTENT_DOM.childNodes;
        return this;
    }

    makeDimensional(data, dimension = 0, parentNodes = []) {
        if (Array.isArray(data)) {
            for (let k in data) {
                let parents = parentNodes.slice(0);
                parents.push(data[k].key);
                this.makeDimensional(data[k], dimension, parents);
            }
            return;
        }
        let parent = parentNodes.slice(0);
        parent.pop();
        data.parentNodes = parent;
        if (!Array.isArray(this.dimensional_data[dimension])) {
            this.dimensional_data[dimension] = [data];
        } else {
            this.dimensional_data[dimension].push(data);
        }
        if (!data.hasOwnProperty('nodes') || !Array.isArray(data.nodes) || data.nodes.length === 0) {
            return;
        }
        dimension++;
        this.makeDimensional(data.nodes, dimension, parentNodes);
    }

    select(element, stack) {
        let id = parseInt(element.getAttribute('data-id'));
        let k = parseInt(element.getAttribute('data-k'));
        let data = this.dimensional_data[stack][k];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let parentNode = data.parentNodes[data.parentNodes.length - 1];

        if (data.checked === false) {
            data.checked = true;
            currentStackDocuments.forEach((D, index) => {
                if (this.dimensional_data[stack][index].parentNodes.indexOf(parentNode) !== -1) {
                    currentStackDocuments[index].classList.remove('dlp-label-silence');
                }else {
                    currentStackDocuments[index].classList.add('dlp-label-silence');
                }
            });
            this.tagCal(id, this.MODE.insert);
            element.querySelector('i') != null && element.removeChild(element.querySelector('i'));
            element.insertAdjacentHTML('beforeend', `<i>${_componentSvg.check}</i>`);
            this.selectToChildren(stack + 1, data.nodes);
            this.selectToSelected(element,stack);
        } else if(data.checked === true){
            data.checked = false;
            this.tagCal(id, this.MODE.delete);
            element.querySelector('i') != null && element.removeChild(element.querySelector('i'));
            for (let index in this.SELECTED_DOM.childNodes) {
                let D = this.SELECTED_DOM.childNodes[index];
                if ((D instanceof HTMLElement) && (D.getAttribute('data-id') == id)) {
                    D.remove();
                    break;
                }
            }
        }else {
            currentStackDocuments.forEach((D, index) => {
                if (this.dimensional_data[stack][index].parentNodes.indexOf(parentNode) !== -1) {
                    currentStackDocuments[index].classList.remove('dlp-label-silence');
                }else {
                    currentStackDocuments[index].classList.add('dlp-label-silence');
                }
            });
            element.classList.remove('dlp-label-silence');
            this.selectToChildren(stack + 1, data.nodes);
        }
        if (Array.isArray(data.parentNodes) && data.parentNodes.length>0) {
            let parentNodes = data.parentNodes.slice(0);
            this.selectToParent(parentNodes,data.checked);
        }
    }

    selectToSelected(element, stack) {
        let div = document.createElement('div');
        div.className = 'dlp dlp-text dlp-label';
        div.setAttribute('data-id', element.getAttribute('data-id'));
        div.setAttribute('stack', stack);
        div.textContent = element.textContent;
        var object = this;
        div.addEventListener('click', function () {
            object.select(element,stack);
        });
        this.SELECTED_DOM.append(div);
    }

    selectToParent(nodes,checked) {
        let stack = nodes.length - 1;
        let node = nodes.pop();
        let parentNode = nodes[stack-1];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        currentStackDocuments.forEach((D, index) => {
            let parents = this.dimensional_data[stack][index].parentNodes;
            if(checked === true || checked === undefined) {
                let D = currentStackDocuments[index];
                if (parents.length > 0 && (parents[stack - 1] !== parentNode)) {
                    D.classList.add('dlp-label-silence');
                }else {
                    D.classList.remove('dlp-label-silence');
                }
            }
            if (checked === true && node === parseInt(D.getAttribute('data-id')) && !(D.querySelector('i') instanceof HTMLElement)) {
                D.insertAdjacentHTML('beforeend', `<i>${_componentSvg.check_circle}</i>`);
            }
            if(checked === false){

            }
        });
        if(nodes.length>0){
            this.selectToParent(nodes,checked);
        }
    }

    selectToChildren(stack, nodes) {
        if (stack > (this.dimensional_data.length - 1)) return;
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let children = [];
        currentStackDocuments.forEach((D,index) => {
            if(nodes===null){
                D.classList.add('dlp-label-silence');
                return;
            }
            if (nodes.indexOf(parseInt(D.getAttribute('data-id'))) !== -1) {
                D.classList.remove('dlp-label-silence');
                let child = this.dimensional_data[stack][index].nodes;
                if (Array.isArray(child)) {
                    child.forEach((c) => {
                        if (children.indexOf(child) === -1) children.push(c);
                    });
                }
            } else {
                D.classList.add('dlp-label-silence');
            }
        });
        this.selectToChildren(stack + 1, children);
    }

    tagCal(id, operate) {
        if (operate === this.MODE.insert) {
            if (this.select_data.indexOf(id) === -1) {
                this.select_data.push(id);
                this.selectInputDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) === -1 && this.insert_data.indexOf(id) === -1) {
                this.insert_data.push(id);
                this.insertInputDOM.value = JSON.stringify(this.insert_data);
            }
            let index = this.delete_data.indexOf(id);
            if (index !== -1) {
                this.delete_data.splice(index, 1);
                this.deleteInputDOM.value = JSON.stringify(this.delete_data);
            }
            return;
        }
        if (operate === this.MODE.delete) {
            let index = this.select_data.indexOf(id);
            if (index !== -1) {
                this.select_data.splice(index, 1);
                this.selectInputDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) !== -1 && this.delete_data.indexOf(id) === -1) {
                this.delete_data.push(id);
                this.deleteInputDOM.value = JSON.stringify(this.delete_data);
            }
            index = this.insert_data.indexOf(id);
            if (index !== -1) {
                this.insert_data.splice(index, 1);
                this.insertInputDOM.value = JSON.stringify(this.insert_data);
            }
        }
    }
}

class ComponentLine {
    constructor(name, columns, data, options = {}) {
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
        if (this.OPTIONS.sortable) this.sortable();
    }

    makeHead() {
        let head = '<tr>';
        let foot = head;
        let columns = this.COLUMNS;
        for (let column in columns) {
            if (columns[column].type == 'hidden') {
                continue;
            }
            if (columns[column].style) {
                head += `<th style="${columns[column].style}">${columns[column].name}</th>`;
                foot += `<th style="${columns[column].style}"><input class="dlp-input" data-column="${column}" placeholder=":${columns[column].name}"/></th>`;
                continue;
            }
            head += '<th>' + columns[column].name + '</th>';
            foot += `<th><input class="dlp-input" data-column="${column}" placeholder=":${columns[column].name}"/></th>`;
        }
        head += '<th class="operate-column" style="width: 48px;"></th></tr>';
        foot += '<th class="insert_handel operate-column" style="width: 48px;"></th></tr>';

        this.DOM.insertAdjacentHTML('afterbegin', `<table class="dlp dlp-table" style="height: 100%"><thead>${head}</thead></table>`);
        this.TABLE_DOM = this.DOM.getElementsByTagName('table')[0];
        return foot;
    }

    makeBody() {
        var records = [];
        var tbody = document.createElement('tbody');
        var object = this;
        var columns = this.COLUMNS;
        if (Array.isArray(this.DATA) == false) return;
        this.DATA.forEach(function (value, key) {
            let tr = document.createElement('tr');
            tr.setAttribute('sortable-item', 'sortable-item');
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
                tr.setAttribute('data-key', key.toString());
                tr.appendChild(td);
            }

            let td = document.createElement('td');
            object.operateButton(td);
            tr.appendChild(td);
            tbody.appendChild(tr);
            records.push(record);
        });
        object.DATA = records;
        object.DATA_INPUT.value = JSON.stringify(records);
        tbody.setAttribute('sortable-list', 'sortable-list');
        tbody.className = 'dlp-scroll';
        this.TBODY_DOM = tbody;
        this.TABLE_DOM.appendChild(tbody);
    }

    makeFoot(foot) {
        let tfoot = document.createElement('tfoot');
        tfoot.insertAdjacentHTML('afterbegin', foot);
        this.TABLE_DOM.appendChild(tfoot);
        /*insert action*/
        var object = this;
        var i = document.createElement('i');
        i.style = 'cursor: pointer';
        i.insertAdjacentHTML('afterbegin', _componentSvg.write);
        i.addEventListener('click', function () {
            let inputs = object.DOM.getElementsByTagName('tfoot')[0].getElementsByTagName('input');
            let insert = {};
            let tr = document.createElement('tr');
            tr.setAttribute('sortable-item', 'sortable-item');
            tr.setAttribute('data-key', object.DATA.length.toString());
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
        }, false);
        this.DOM.getElementsByClassName('insert_handel')[0].appendChild(i);
    }

    makeTd(td, type, value, column, attributes) {
        var object = this;
        switch (type) {
            case 'text':
                td.insertAdjacentHTML('afterbegin', `<p style="display: block;" class="dlp-text" title="${value}">${value}</p>`);
                break;
            case 'input':
                let input = document.createElement('input');
                input.setAttribute('class', 'dlp-input');
                input.setAttribute('data-column', column);
                input.value = value;
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
                }, false);
                td.appendChild(input);
                break;
            default:
                td.insertAdjacentHTML('afterbegin', `<p style="display: block;" class="dlp-text" title="${value}">${value}</p>`);
                break;
        }
    }

    operateButton(td) {
        var object = this;
        if (this.OPTIONS.sortable) {
            let M = document.createElement('i');
            M.setAttribute('style', 'cursor: pointer;margin-right:5px;');
            M.setAttribute('sortable-handle', 'sortable-handle');
            M.insertAdjacentHTML('afterbegin', _componentSvg.move);
            td.appendChild(M);
        }

        if (this.OPTIONS.delete) {
            let D = document.createElement('span');
            D.setAttribute('style', 'cursor: pointer;display: inline-block;');
            D.insertAdjacentHTML('afterbegin', _componentSvg.trash);
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
        td.className = 'operate-column';
    }

    sortable() {
        var object = this;
        new ComponentSortable(this.TBODY_DOM, function (sort) {
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
    constructor(url, xhr_url = '', method = 'POST', callback = null, options = {}) {
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
        let html = `<div id="dlp-plane" class="dlp-plane-gauze"><div class="dlp-plane" style="width: ${window.innerWidth * this.OPTIONS.W}px;"><div class="dlp plane-header"></div><div class="plane-body dlp-scroll" style="max-height:${window.innerHeight * this.OPTIONS.H}px; min-height: ${window.innerHeight * this.OPTIONS.H / 2}px;"></div></div></div>`;
        document.body.insertAdjacentHTML('beforeEnd', html);
        this.DOM = document.getElementById('dlp-plane');
        /*X*/
        let X = document.createElement('i');
        X.insertAdjacentHTML('afterbegin', _componentSvg.close);
        let object = this;
        X.addEventListener('click', function () {
            if (object.DOM instanceof HTMLElement) {
                object.DOM.remove();
            }
            if (document.getElementById('kvFileinputModal') instanceof HTMLElement) {
                document.getElementById('kvFileinputModal').remove();
            }
        }, false);
        object.DOM.querySelector('.plane-header').append(X);
        this.MODEL_BODY_DOM = object.DOM.querySelector('.plane-body');
    }

    makeContent() {
        this.loading();
        var object = this;
        _componentRequest(this.URL, 'GET', {}, function (response) {
            object.loading(true);
            /*object.MODEL_BODY_DOM.innerHTML = response;*/
            $('#dlp-plane .plane-body').append(response);
            let submit = object.MODEL_BODY_DOM.querySelector('button[type="submit"]');
            if (submit instanceof HTMLElement) {
                submit.addEventListener('click', object.submitEvent.bind(object, submit), false);
            }
        });
    }

    submitEvent(element) {
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
        this.LOADING_DOM.insertAdjacentHTML('afterbegin', _componentSvg.loading);
        this.MODEL_BODY_DOM.append(this.LOADING_DOM);
    }
}

class ComponentSortable {
    constructor(list, callback = null) {
        this.list = (typeof list === 'string') ? document.querySelector(list) : list;
        this.options = {
            animationSpeed: 200,
            animationEasing: 'ease-out'
        };
        this.callback = callback;
        this.animation = false;
        this.dragStart = this.dragStart.bind(this);
        this.dragMove = this.dragMove.bind(this);
        this.dragEnd = this.dragEnd.bind(this);
        this.list.addEventListener('touchstart', this.dragStart, false);
        this.list.addEventListener('mousedown', this.dragStart, false);
    }

    reset() {
        this.items = Array.from(this.list.children);
        if (this.items[this.items.length - 1].offsetTop > this.list.offsetHeight) {
            this.listHeight = this.list.scrollHeight;
        } else {
            this.listHeight = this.items[this.items.length - 1].offsetTop;
        }
    }

    dragStart(e) {
        this.reset();
        if (this.animation) return;
        if (this.items.length < 2) return;
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
        if (this.items.length < 2) return;
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
        if (this.items.length < 2) return;
        this.item.style.transition = `all ${this.options.animationSpeed}ms ${this.options.animationEasing}`;
        this.item.style.transform = `translateY(${this.position * this.itemHeight}px)`;
        this.item.classList.remove('is-dragging');
        if (typeof this.callback == 'function') this.callback(this.positions);

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
                if (this.items[i]) {
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