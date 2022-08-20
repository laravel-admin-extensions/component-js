const _component = {
    'trash': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>`,
    'move': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>`,
    'write': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>`,
    'close': `<svg style="vertical-align: middle;" width="14" height="14" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="white" stroke-width="2.5" d="M16,16 L4,4"></path><path fill="none" stroke="white" stroke-width="2.5" d="M16,4 L4,16"></path></svg>`,
    'check': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>`,
    'check_circle': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>`,
    'caret_right': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg>`,
    'caret_right_circle': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
</svg>`,
    'sub_check': `<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="rgb(54 54 54)" viewBox="0 0 16 16">
  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
</svg>`,
    'sub_loading':`<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
  <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
  <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
    C22.32,8.481,24.301,9.057,26.013,10.047z">
    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"></animateTransform>
    </path>
  </svg>`,
    request: function (url, method = "GET", data = {}, callback = null,error_callback=null) {
        let xhr = new XMLHttpRequest();
        if (method === 'GET') url = _component.parseParams(url,data);
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
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) return;
            if (typeof error_callback === 'function') error_callback();
        };
        xhr.onreadystatechange = function () {
            if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                let response = xhr.response;
                if (typeof callback === 'function') callback(response);
            }
        };
        xhr.onerror = function (e) {
            console.error(e);
            if (typeof error_callback === 'function') error_callback(e);
        };
    },
    parseParams(uri, params){
        let paramsArray = [];
        if(Object.keys(params).length === 0)return uri;
        Object.keys(params).forEach(key => params[key] && paramsArray.push(`${key}=${params[key]}`));
        if (uri.search(/\?/) === -1) {
            uri += `?${paramsArray.join('&')}`
        } else {
            uri += `&${paramsArray.join('&')}`
        }
        return uri
    },
    loading:function(DOM,remove=false){
        if(remove){
            DOM.innerHTML = '';
            return;
        }
        DOM.insertAdjacentHTML('afterbegin', `<div class="dlp-loader">
        <div class="dlp-loader-inner">
            <div class="dlp-loader-line-wrap"><div class="dlp-loader-line"></div></div>
            <div class="dlp-loader-line-wrap"><div class="dlp-loader-line"></div></div>
            <div class="dlp-loader-line-wrap"><div class="dlp-loader-line"></div></div>
            <div class="dlp-loader-line-wrap"><div class="dlp-loader-line"></div></div>
            <div class="dlp-loader-line-wrap"><div class="dlp-loader-line"></div></div>
        </div></div>`);
    },
    alert: function (message, time = 1, callback = null) {
        let div = document.createElement('div');
        div.innerHTML = message;
        let w = window.innerWidth / 2 - 140;
        let h = window.innerHeight / 2 - 145;
        let style = "z-index: 1000000; position: fixed;background-color: rgba(0,0,0,.6);color: #fff;" +
            "width: 280px;height: 45px;line-height: 40px;border-radius: 3px;text-align: center;" +
            "top:" + h + "px;left:" + w + "px;";
        div.setAttribute('style', style);
        document.getElementsByTagName("BODY")[0].appendChild(div);
        let task = setTimeout(function () {
            clearTimeout(task);
            div.parentNode.removeChild(div);
            if (typeof callback === 'function') callback();
        }, time * 1000);
    },
    contextmenu: function (event, list, options = {}) {
        options = Object.assign({
            W: '70px'
        }, options);
        let ul = document.createElement('ul');
        ul.className = 'dlp dlp-contextmenu';
        list.forEach((v) => {
            let li = document.createElement('li');
            li.className = 'dlp dlp-text';
            li.textContent = v.title;
            li.style.width = options.W;
            if (typeof v.func === 'function') {
                li.addEventListener('click', () => {
                    ul.remove();
                    let sync = setTimeout(() => {
                        v.func();
                        clearTimeout(sync);
                    }, 100);
                });
                ul.append(li);
            }
        });
        ul.style.top = `${event.pageY - 3}px`;
        ul.style.left = `${event.pageX - 3}px`;
        ul.addEventListener("contextmenu", (e) => {
            e.preventDefault();
        });
        ul.addEventListener('mouseleave', () => {
            ul.remove();
        });
        document.getElementsByTagName("BODY")[0].appendChild(ul);
    },
    dimensional(output, data, dimension = 0, parentNodes = []) {
        if (Array.isArray(data)) {
            for (let k in data) {
                if (!data.hasOwnProperty(k)) continue;
                let parents = parentNodes.slice(0);
                parents.push(data[k].key);
                _component.dimensional(output, data[k], dimension, parents);
            }
            return;
        }
        let parents = parentNodes.slice(0);
        parents.pop();
        data.parentNodes = parents;
        if (!Array.isArray(output[dimension])) {
            output[dimension] = [data];
        } else {
            output[dimension].push(data);
        }
        if (!data.hasOwnProperty('nodes') || !Array.isArray(data.nodes) || data.nodes.length === 0) {
            return;
        }
        dimension++;
        _component.dimensional(output, data.nodes, dimension, parentNodes);
    },
    arrayInsert(index, ...items) {
        if (isNaN(index)) {
            throw new TypeError('int only');
        }
        this.splice(index, 0, ...items);
    }
};

class ComponentDot {
    MODE = {
        insert: 'insert',
        delete: 'delete'
    };

    constructor(name, selected, select) {
        if (!Array.isArray(selected)) {
            console.error('Dot param selected must be array!');
            return;
        }
        if (Array.isArray(select) || typeof select !== 'object') {
            console.error('Dot param select must be object such as {key:val,key2:val2,...} !');
            return;
        }
        this.name = name;
        this.DOM = document.getElementById(name);
        this.DOM.addEventListener("contextmenu", (e) => {
            e.preventDefault();
        });
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

        let search = document.querySelector(`#${this.name} .dot-search`);
        let object = this;
        search.addEventListener('input', () => {
            let timeout = setTimeout(function () {
                clearTimeout(timeout);
                object.search(search);
            }, 500);
        });
    }

    make(selected, select) {
        let selected_dom = '';
        let select_dom = '';
        for (let i in select) {
            if (!select.hasOwnProperty(i)) continue;
            if (selected.indexOf(parseInt(i)) !== -1) {
                selected_dom += `<div class="dlp-label dlp-text" data-id="${i}" title="${select[i]}">${select[i]}</div>`;
                continue;
            }
            select_dom += `<div class="dlp-label dlp-text" data-id="${i}" title="${select[i]}">${select[i]}</div>`;
        }

        let html = `<div class="dlp dlp-dot" ><div class="dot-top"><input type="text" class="dot-search" placeholder="搜索名称"><div class="dot-selected dlp-scroll">${selected_dom}</div></div><div class="dot-body"><div class="dot-select dlp-scroll">${select_dom}</div></div></div>
<input name="${this.name}[select]" value='${JSON.stringify(selected)}' type="hidden"><input name="${this.name}[insert]" value="[]" type="hidden"><input name="${this.name}[delete]" value="[]" type="hidden">`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.SELECTED_DOM = document.querySelector(`#${this.name}  .dot-selected`);
        this.CONTENT_DOM = document.querySelector(`#${this.name}  .dot-select`);
        this.selectInputDOM = document.querySelector(`input[name='${this.name}[select]']`);
        this.insertInputDOM = document.querySelector(`input[name='${this.name}[insert]']`);
        this.deleteInputDOM = document.querySelector(`input[name='${this.name}[delete]']`);
    }

    tagSelect(element) {
        element.addEventListener('click', this.tagCancel.bind(this, element), false);
        this.SELECTED_DOM.appendChild(element);
        this.tagCal(element, this.MODE.insert);
        this.SELECTED_DOM.scrollTop = this.SELECTED_DOM.scrollHeight;
    }

    tagCancel(element) {
        element.addEventListener('click', this.tagSelect.bind(this, element), false);
        this.CONTENT_DOM.appendChild(element);
        this.tagCal(element, this.MODE.delete);
    }

    tagCal(element, operate) {
        let id = parseInt(element.getAttribute('data-id'));
        let index = this.select_data.indexOf(id);
        if (operate === this.MODE.insert) {
            if (index === -1) {
                this.select_data.push(id);
                this.selectInputDOM.value = JSON.stringify(this.select_data);
            }
            if (this.selected_data.indexOf(id) === -1 && this.insert_data.indexOf(id) === -1) {
                this.insert_data.push(id);
                this.insertInputDOM.value = JSON.stringify(this.insert_data);
            }
            index = this.delete_data.indexOf(id);
            if (index !== -1) {
                this.delete_data.splice(index, 1);
                this.deleteInputDOM.value = JSON.stringify(this.delete_data);
            }
        } else {
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

    search(search) {
        if (search.value === '') {
            if (this.SELECT_COVER_DOM instanceof HTMLElement) {
                let elements = [];
                this.SELECT_COVER_DOM.childNodes.forEach((D) => {
                    elements.push(D);
                });
                this.CONTENT_DOM.append(...elements);
                this.SELECT_COVER_DOM.remove();
                this.SELECT_COVER_DOM = null;
            }
            return;
        }
        if (!(this.SELECT_COVER_DOM instanceof HTMLElement)) {
            this.SELECT_COVER_DOM = document.createElement('div');
            this.SELECT_COVER_DOM.className = 'dot-select dlp-scroll dot-select-cover';
            this.CONTENT_DOM.parentNode.appendChild(this.SELECT_COVER_DOM);
        } else {
            let elements = [];
            this.SELECT_COVER_DOM.childNodes.forEach((D) => {
                elements.push(D);
            });
            this.CONTENT_DOM.append(...elements);
        }
        let elements = [];
        for (let element of this.CONTENT_DOM.childNodes) {
            if (element.className.indexOf('dlp-label') === -1) {
                continue;
            }
            if (element.innerText.indexOf(search.value) !== -1) {
                elements.push(element);
            }
        }
        this.SELECT_COVER_DOM.append(...elements);
    }
}

class ComponentCascadeDot {
    MODE = {
        insert: 'insert',
        delete: 'delete'
    };

    constructor(name, selected, select) {
        if (!Array.isArray(selected) || !Array.isArray(select)) {
            console.error('CascadeDot param selected and select must be array!');
            return;
        }
        this.name = name;
        this.DOM = document.getElementById(name);
        this.selected_data = selected;
        this.select_data = selected.slice(0);
        this.insert_data = [];
        this.delete_data = [];
        this.make().makeSelect(select);
        this.selectInputDOM.value = JSON.stringify(this.select_data);
        let search = document.querySelector(`#${this.name} .dot-search`);
        let object = this;
        search.addEventListener('input', () => {
            let timeout = setTimeout(function () {
                clearTimeout(timeout);
                object.search(search);
            }, 500);
        });
    }

    make() {
        let html = `<div class="dlp dlp-dot"><div class="dot-top"><input type="text" class="dot-search" placeholder="搜索名称"><div id="${this.name}-select" class="dot-selected dlp-scroll"></div></div><div class="dot-body"><div class="dot-select dot-select-cascade dlp-scroll"></div></div></div>
<input name="${this.name}[select]" value="[]" type="hidden"><input name="${this.name}[insert]" value="[]" type="hidden"><input name="${this.name}[delete]" value="[]" type="hidden">`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.DOM.addEventListener("contextmenu", (e) => {
            e.preventDefault();
        });
        this.SELECTED_DOM = document.querySelector(`#${this.name} .dot-selected`);
        this.CONTENT_DOM = document.querySelector(`#${this.name} .dot-select`);
        this.selectInputDOM = document.querySelector(`input[name='${this.name}[select]']`);
        this.insertInputDOM = document.querySelector(`input[name='${this.name}[insert]']`);
        this.deleteInputDOM = document.querySelector(`input[name='${this.name}[delete]']`);
        return this;
    }

    makeSelect(select) {
        this.dimensional_data = [];
        _component.dimensional(this.dimensional_data, select);
        let object = this;
        for (let stack in this.dimensional_data) {
            if (!this.dimensional_data.hasOwnProperty(stack)) continue;
            stack = parseInt(stack);
            let data = this.dimensional_data[stack];
            let stackDom = document.createElement('div');
            stackDom.className = 'dot-cascade-stack dlp-scroll';
            data.forEach((v, k) => {
                if (Array.isArray(v.nodes) && v.nodes.length !== 0) {
                    v.nodes = v.nodes.map((N) => N.key);
                    v.expand = false;
                } else {
                    v.nodes = null;
                    v.checked = false;
                }
                let div = document.createElement('div');
                div.className = 'dlp dlp-text dlp-label';
                div.textContent = v.val;
                div.setAttribute('data-id', v.key);
                div.setAttribute('data-k', k);
                div.addEventListener('click', this.select.bind(this, div, stack));
                if (v.nodes !== null) {
                    div.insertAdjacentHTML('afterbegin', `<i class="left">${_component.caret_right}</i>`);
                    div.addEventListener("contextmenu", (e) => {
                        e.target.click();
                        e.preventDefault();
                        let k = parseInt(div.getAttribute('data-k'));
                        _component.contextmenu(e, [
                            {
                                title: '全选', func: () => {
                                    object.checkAll(stack + 1,
                                        this.dimensional_data[stack][k].nodes, true);
                                }
                            },
                            {
                                title: '取消', func: () => {
                                    object.checkAll(stack + 1,
                                        this.dimensional_data[stack][k].nodes, false);
                                }
                            }
                        ]);
                    });
                } else {
                    div.addEventListener("contextmenu", (e) => {
                        e.preventDefault();
                    });
                }
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
                    let E = new Event('click');
                    setTimeout(() => {
                        div.click();
                        div.dispatchEvent(E);
                    });
                }
            });
            this.CONTENT_DOM.append(stackDom);
        }
        this.STACKS = this.CONTENT_DOM.childNodes;
        return this;
    }

    select(element, stack) {
        let id = parseInt(element.getAttribute('data-id'));
        let k = parseInt(element.getAttribute('data-k'));
        let data = this.dimensional_data[stack][k];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let parentNode = data.parentNodes[data.parentNodes.length - 1];
        if (data.checked === true) {
            data.checked = false;
            this.tagCal(id, this.MODE.delete);
            element.querySelector('i.right') !== null && element.removeChild(element.querySelector('i.right'));
            for (let D of this.SELECTED_DOM.childNodes) {
                if (parseInt(D.getAttribute('data-id')) === id) {
                    D.remove();
                    break;
                }
            }
        } else {
            this.dimensional_data[stack].forEach((data, index) => {
                if (data.parentNodes.indexOf(parentNode) !== -1) {
                    currentStackDocuments[index].classList.remove('dlp-label-silence');
                } else {
                    currentStackDocuments[index].classList.add('dlp-label-silence');
                }
                this.expand(data,currentStackDocuments[index], false);
            });
            if (data.checked === false) {
                data.checked = true;
                this.tagCal(id, this.MODE.insert);
                element.classList.remove('dlp-label-silence');
                if (element.querySelector('i.right') === null) element.insertAdjacentHTML('beforeend', `<i class="right">${_component.check}</i>`);
                this.selectToChildren(stack + 1, data.nodes);
                this.selectToSelected(element, stack);
                this.SELECTED_DOM.scrollTop = this.SELECTED_DOM.scrollHeight;
            } else {
                element.classList.remove('dlp-label-silence');
                this.expand(data,element, true);
                this.selectToChildren(stack + 1, data.nodes);
            }
        }
        if (Array.isArray(data.parentNodes) && data.parentNodes.length > 0) {
            let parentNodes = data.parentNodes.slice(0);
            this.selectToParent(parentNodes, data.checked);
        }
    }

    selectToSelected(element, stack) {
        let div = document.createElement('div');
        div.className = 'dlp dlp-text dlp-label';
        div.setAttribute('data-id', element.getAttribute('data-id'));
        div.setAttribute('stack', stack);
        div.textContent = element.textContent;
        let object = this;
        div.addEventListener('click', function () {
            object.select(element, stack);
        });
        this.SELECTED_DOM.append(div);
    }

    selectToParent(nodes, checked) {
        let stack = nodes.length - 1;
        let node = nodes.pop();
        let parentNode = nodes[stack - 1];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let to_first_index = null;
        this.dimensional_data[stack].forEach((data, index) => {
            let D = currentStackDocuments[index];
            let parents = data.parentNodes;
            if (checked === true || checked === undefined) {
                if (parents.length > 0 && (parents[stack - 1] !== parentNode)) {
                    D.classList.add('dlp-label-silence');
                    this.expand(data,D, false);
                } else if (parents.length === 0 && parseInt(D.getAttribute('data-id')) !== node) {
                    D.classList.add('dlp-label-silence');
                    this.expand(data,D, false);
                } else {
                    D.classList.remove('dlp-label-silence');
                    if (parseInt(D.getAttribute('data-id')) === node) {
                        if (to_first_index === null) to_first_index = index;
                        this.expand(data,D, true);
                    } else {
                        this.expand(data,D, false);
                    }
                }
            }
            if (checked === true && node === data.key && data.mark !== true) {
                data.mark = true;
                D.insertAdjacentHTML('beforeend', `<i class="right">${_component.check_circle}</i>`);
            }
            if (checked === false && node === data.key) {
                let nodes = this.dimensional_data[stack][index].nodes;
                let cancel = true;
                for (let d of this.dimensional_data[stack + 1]) {
                    if (nodes.indexOf(d.key) !== -1 && (d.checked === true || d.mark === true)) {
                        cancel = false;
                        break;
                    }
                }
                if (cancel && (D.querySelector('i.right') instanceof HTMLElement)) {
                    data.mark = false;
                    D.querySelector('i.right').remove();
                }
            }
        });
        if (to_first_index !== null) this.STACKS[stack].scrollTop = to_first_index * 27;
        if (nodes.length > 0) {
            this.selectToParent(nodes, checked);
        }
    }

    selectToChildren(stack, nodes) {
        if (stack > (this.dimensional_data.length - 1)) return;
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let children = [];
        let to_first_index = null;
        this.dimensional_data[stack].forEach((data, index) => {
            let D = currentStackDocuments[index];
            if (nodes === null) {
                D.classList.add('dlp-label-silence');
                return;
            }
            if (nodes.indexOf(parseInt(D.getAttribute('data-id'))) !== -1) {
                D.classList.remove('dlp-label-silence');
                let child = data.nodes;
                if (Array.isArray(child)) {
                    child.forEach((c) => {
                        if (children.indexOf(child) === -1) children.push(c);
                    });
                }
                if (to_first_index === null) to_first_index = index;
                this.expand(data,D, true);
            } else {
                D.classList.add('dlp-label-silence');
                this.expand(data,D, false);
            }
        });
        if (to_first_index !== null) this.STACKS[stack].scrollTop = to_first_index * 27;
        this.selectToChildren(stack + 1, children);
    }

    expand(data,dom, open = true) {
        if(data.expand === open) return;
        data.expand = open;
        if (open) {
            let left_mark = dom.querySelector('i.left');
            if (left_mark) left_mark.innerHTML = _component.caret_right_circle;
            return;
        }
        let left_mark = dom.querySelector('i.left');
        if (left_mark) left_mark.innerHTML = _component.caret_right;
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

    search(search) {
        if (search.value === '') {
            if (this.SELECT_COVER_DOM instanceof HTMLElement) {
                this.SELECT_COVER_DOM.remove();
                this.SELECT_COVER_DOM = null;
                this.COVER_STACK_HASH_DOM = [];
            }
            return;
        } else if (!(this.SELECT_COVER_DOM instanceof HTMLElement)) {
            this.COVER_STACK_HASH_DOM = [];
            this.SELECT_COVER_DOM = document.createElement('div');
            this.SELECT_COVER_DOM.className = 'dot-select-cover dlp-scroll dot-select-cascade';
            for (let stack = 1; stack <= this.dimensional_data.length; stack++) {
                let div = document.createElement('div');
                div.className = 'dot-cascade-stack dlp-scroll';
                this.SELECT_COVER_DOM.append(div);
            }
            this.CONTENT_DOM.parentNode.append(this.SELECT_COVER_DOM);
        }
        this.dimensional_data.forEach((data, stack) => {
            this.searchPushTag(search, data, stack);
        });
    }

    searchCoverClick(stack, data, dom) {
        if (data.nodes !== null) {
            let nextStack = stack + 1;
            Array.isArray(this.dimensional_data[nextStack]) &&
            this.searchPushTag(data.nodes, this.dimensional_data[nextStack], nextStack);
            return;
        }
        (dom instanceof HTMLElement) && dom.click();
    }

    searchPushTag(search, data, stack) {
        data.forEach((d, k) => {
            if (Array.isArray(search)) {
                if (search.indexOf(d.key) === -1) return;
            } else {
                if (d.val.indexOf(search.value) === -1) return;
            }
            if (Array.isArray(this.COVER_STACK_HASH_DOM[stack]) && this.COVER_STACK_HASH_DOM[stack].indexOf(d.key) !== -1) return;
            let div = document.createElement('div');
            div.className = 'dlp dlp-text dlp-label';
            div.textContent = d.val;
            if (d.nodes !== null) div.insertAdjacentHTML('afterbegin', `<i class="left">${_component.caret_right}</i>`);
            div.addEventListener('click', () => this.searchCoverClick(stack, d, this.STACKS[stack].childNodes[k]));
            this.SELECT_COVER_DOM.childNodes[stack].prepend(div);
            if (!Array.isArray(this.COVER_STACK_HASH_DOM[stack])) {
                this.COVER_STACK_HASH_DOM[stack] = [d.key];
                return;
            }
            this.COVER_STACK_HASH_DOM[stack].push(d.key);
        });
    }

    checkAll(stack, nodes, check) {
        if (stack > (this.dimensional_data.length - 1)) return;
        if (!Array.isArray(nodes) || nodes.length <= 0) return;
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let children = [];
        let to_first_index = null;
        currentStackDocuments.forEach((D, index) => {
            if (nodes.indexOf(parseInt(D.getAttribute('data-id'))) !== -1) {
                let checked = this.dimensional_data[stack][index].checked;
                if (check === true) {
                    checked === false && D.click();
                } else if (check === false) {
                    checked === true && D.click();
                }
                let child = this.dimensional_data[stack][index].nodes;
                if (Array.isArray(child)) {
                    child.forEach((c) => {
                        if (children.indexOf(child) === -1) children.push(c);
                    });
                }
                if (to_first_index === null) to_first_index = index;
            }
        });
        if (to_first_index !== null) this.STACKS[stack].scrollTop = to_first_index * 27;
        this.checkAll(stack + 1, children, check);
    }
}

class ComponentLine {
    constructor(name, columns, data, options = {}) {
        this.DOM = document.getElementById(name);
        this.DOM.addEventListener("contextmenu", (e) => {
            e.preventDefault();
        });
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
        let foot = '<tr>';
        let columns = this.COLUMNS;
        for (let column in columns) {
            if (!columns.hasOwnProperty(column)) continue;
            let val = columns[column];
            if (val.type === 'hidden') {
                continue;
            }
            if (val.style) {
                head += `<th style="${val.style}">${val.name}</th>`;
                foot += `<th style="${val.style}"><input class="dlp-input" data-column="${column}" placeholder=":${val.name}"/></th>`;
                continue;
            }
            head += `<th>${val.name}</th>`;
            foot += `<th><input class="dlp-input" data-column="${column}" placeholder=":${val.name}"/></th>`;
        }
        head += '<th class="operate-column" style="width: 48px;"></th></tr>';
        foot += '<th class="insert_handel operate-column" style="width: 48px;"></th></tr>';

        this.DOM.insertAdjacentHTML('afterbegin', `<table class="dlp dlp-table" style="height: 100%"><thead>${head}</thead></table>`);
        this.TABLE_DOM = this.DOM.getElementsByTagName('table')[0];
        return foot;
    }

    makeBody() {
        let records = [];
        let tbody = document.createElement('tbody');
        let object = this;
        let columns = this.COLUMNS;
        if (Array.isArray(this.DATA) === false) return;
        this.DATA.forEach(function (value, key) {
            let tr = document.createElement('tr');
            tr.setAttribute('sortable-item', 'sortable-item');
            let record = {};
            for (let column in columns) {
                if (!columns.hasOwnProperty(column)) continue;
                if (columns[column].type === 'hidden') {
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
        let object = this;
        let i = document.createElement('i');
        i.style.cursor = 'pointer';
        i.insertAdjacentHTML('afterbegin', _component.write);
        i.addEventListener('click', function () {
            let inputs = object.DOM.getElementsByTagName('tfoot')[0].getElementsByTagName('input');
            let insert = {};
            let tr = document.createElement('tr');
            tr.setAttribute('sortable-item', 'sortable-item');
            tr.setAttribute('data-key', object.DATA.length.toString());
            for (let input of inputs) {
                let td = document.createElement('td');
                let column = input.getAttribute('data-column');
                insert[column] = input.value;

                object.makeTd(td, object.COLUMNS[column].type, input.value, column);
                if (object.COLUMNS[column].style) {
                    td.style = object.COLUMNS[column].style;
                }
                tr.appendChild(td);
                input.value = '';
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
        let object = this;
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
                    if (!attributes.hasOwnProperty(attribute)) continue;
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
        let object = this;
        if (this.OPTIONS.sortable) {
            let M = document.createElement('i');
            M.setAttribute('style', 'cursor: pointer;margin-right:5px;');
            M.setAttribute('sortable-handle', 'sortable-handle');
            M.insertAdjacentHTML('afterbegin', _component.move);
            td.appendChild(M);
        }

        if (this.OPTIONS.delete) {
            let D = document.createElement('span');
            D.setAttribute('style', 'cursor: pointer;display: inline-block;');
            D.insertAdjacentHTML('afterbegin', _component.trash);
            D.addEventListener('click', function () {
                let tr = this.parentNode.parentNode;
                let tbody = tr.parentNode;
                let key = tr.getAttribute('data-key');

                object.DATA.splice(key, 1);
                tbody.removeChild(tr);
                object.DATA_INPUT.value = JSON.stringify(object.DATA);
                for (let node in tbody.childNodes) {
                    if (!tbody.childNodes.hasOwnProperty(node)) continue;
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
        let object = this;
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
        let html = `<div id="dlp-plane" class="dlp-plane-gauze"><div style="width: ${window.innerWidth * this.OPTIONS.W}px;"><div class="dlp plane-header"></div><div class="plane-body dlp-scroll" style="max-height:${window.innerHeight * this.OPTIONS.H + 'px'};min-height:${window.innerHeight * this.OPTIONS.H / 2 + 'px'};"></div></div></div>`;
        document.body.insertAdjacentHTML('beforeEnd', html);
        this.DOM = document.getElementById('dlp-plane');
        /*X*/
        let X = document.createElement('i');
        X.insertAdjacentHTML('afterbegin', _component.close);
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
        _component.loading(this.MODEL_BODY_DOM);
        let object = this;
        _component.request(this.URL, 'GET', {}, function (response) {
            _component.loading(object.MODEL_BODY_DOM,true);
            let fragment = document.createRange().createContextualFragment(response);
            document.querySelector('#dlp-plane .plane-body').appendChild(fragment);
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
        let object = this;
        _component.request(this.XHR_URL, this.METHOD, formdata, function (response) {
            if (typeof object.CALLBACK == 'function') {
                object.CALLBACK(response);
                return;
            }
            if (response.code === 0) {
                window.location.reload();
            } else {
                _component.alert(response.message, 3, function () {
                    element.removeAttribute('disabled');
                    element.innerText = '提交';
                });
            }
        });
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
        this.item.classList.add('is-dragging');
        this.itemHeight = this.items[1].offsetTop;
        this.startTouchY = this.getDragY(e);
        this.startTop = this.item.offsetTop;

        const offsetsTop = this.items.map(item => item.offsetTop);

        this.items.forEach((item, index) => {
            item.style.position = 'absolute';
            item.style.top = '0';
            item.style.left = '0';
            item.style.transform = `translateY(${offsetsTop[index]}px)`;
            item.style.zIndex = (item === this.item) ? '2' : '1';
        });

        this.positions = this.items.map((item, index) => index);
        this.position = Math.round((this.startTop / this.listHeight) * this.items.length);

        this.touch = e.type === 'touchstart';
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
            if (index === this.position || index !== newPosition) return;
            this.swapElements(this.positions, this.position, index);
            this.position = index;
        });
        this.items.forEach((item, index) => {
            if (item === this.item) return;
            item.style.transform = `translateY(${this.positions.indexOf(index) * this.itemHeight}px)`;
            item.style.transition = `transform ${this.options.animationSpeed}ms ${this.options.animationEasing}`;
        });

        e.preventDefault();
    }

    dragEnd() {
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

        window.removeEventListener((this.touch ? 'touchmove' : 'mousemove'), this.dragMove);
        window.removeEventListener((this.touch ? 'touchend' : 'mouseup'), this.dragEnd, false);
    }

    swapElements(array, a, b) {
        let temp = array[a];
        array[a] = array[b];
        array[b] = temp;
    }

    getDragY(e) {
        return e.touches ? (e.touches[0] || e.changedTouches[0]).pageY : e.pageY;
    }
}

class ComponentCascadeLine {
    constructor(name, select,url) {
        if (!Array.isArray(select)) {
            console.error('CascadeLine param select must be array!');
            return;
        }
        this.name = name;
        this.DOM = document.getElementById(name);
        this.URL = url;
        this.make().makeSelect(select);
    }

    make() {
        let html = `<div class="dlp-dot" style="position: relative;"><div class="dot-top"><input type="text" class="dlp dot-search" placeholder="搜索名称"></div><div class="dot-body"><div  class="dot-select dot-select-cascade dlp-scroll"></div></div></div>`;
        this.DOM.insertAdjacentHTML('afterbegin', html);
        this.DOM.addEventListener("contextmenu", (e) => {
            e.preventDefault();
        });
        this.CONTENT_DOM = document.querySelector(`#${this.name} .dot-select`);
        return this;
    }

    makeSelect(select) {
        this.dimensional_data = [];
        _component.dimensional(this.dimensional_data, select);
        for (let stack in this.dimensional_data) {
            if (!this.dimensional_data.hasOwnProperty(stack)) continue;
            stack = parseInt(stack);
            let data = this.dimensional_data[stack];
            let stackDom = document.createElement('div');
            stackDom.className = 'dot-cascade-stack dlp-scroll';
            data.forEach((v, k) => {
                if (Array.isArray(v.nodes) && v.nodes.length !== 0) {
                    v.nodes = v.nodes.map((N) => N.key);
                    v.expand = false;
                } else {
                    v.nodes = null;
                }
                let labelDom = this.insertLabelDom(v,k,stack);
                if (v.nodes !== null) {
                    labelDom.insertAdjacentHTML('afterbegin', `<i class="left">${_component.caret_right}</i>`);
                }
                stackDom.append(labelDom);
            });
            this.CONTENT_DOM.append(stackDom);
        }
        this.STACKS = this.CONTENT_DOM.childNodes;
        return this;
    }

    insertLabelDom(data,index,stack) {
        let div = document.createElement('div');
        div.className = 'dlp dlp-text dlp-label';
        div.textContent = data.val;
        div.setAttribute('data-id', data.key.toString());
        div.setAttribute('data-k', index.toString());
        div.addEventListener('click', this.select.bind(this, div, stack));
        div.addEventListener("contextmenu", (e) => {
            e.preventDefault();
            e.target.click();
            _component.contextmenu(e, [
                {
                    title: '新增', func: () => {
                        this.nodeInsert(e,data,stack,index);
                    }
                },
                {
                    title: '修改', func: () => {
                        this.nodeUpdate(e,data,stack,index);
                    }
                },
                {
                    title: '删除', func: () => {

                    }
                }
            ]);
        });
        return div;
    }

    select(element, stack) {
        let k = parseInt(element.getAttribute('data-k'));
        let data = this.dimensional_data[stack][k];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let parentNode = data.parentNodes[data.parentNodes.length - 1];

        this.dimensional_data[stack].forEach((data, index) => {
            let D = currentStackDocuments[index];
            if (data.parentNodes.indexOf(parentNode) !== -1) {
                D.classList.remove('dlp-label-silence');
            } else {
                D.classList.add('dlp-label-silence');
            }
            this.expand(data,currentStackDocuments[index], false);
        });
        this.expand(data,element, true);
        element.classList.remove('dlp-label-silence');
        this.selectToChildren(stack + 1, data.nodes);
        if (Array.isArray(data.parentNodes) && data.parentNodes.length > 0) {
            let parentNodes = data.parentNodes.slice(0);
            this.selectToParent(parentNodes);
        }
    }

    selectToParent(nodes) {
        let stack = nodes.length - 1;
        let node = nodes.pop();
        let parentNode = nodes[stack - 1];
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let to_first_index = null;
        this.dimensional_data[stack].forEach((data, index) => {
            let D = currentStackDocuments[index];
            let parents = data.parentNodes;
            if (parents.length > 0 && (parents[stack - 1] !== parentNode)) {
                D.classList.add('dlp-label-silence');
                this.expand(data,D, false);
            } else if (parents.length === 0 && parseInt(D.getAttribute('data-id')) !== node) {
                D.classList.add('dlp-label-silence');
                this.expand(data,D, false);
            } else {
                D.classList.remove('dlp-label-silence');
                if(parseInt(D.getAttribute('data-id')) === node){
                    if (to_first_index === null)to_first_index = index;
                    this.expand(data,D, true);
                }else {
                    this.expand(data,D, false);
                }
            }
        });
        if (to_first_index !== null) this.STACKS[stack].scrollTop = to_first_index * 27;
        if (nodes.length > 0) {
            this.selectToParent(nodes);
        }
    }

    selectToChildren(stack, nodes) {
        if (stack > (this.dimensional_data.length - 1)) return;
        let currentStackDocuments = this.STACKS[stack].childNodes;
        let children = [];
        let to_first_index = null;
        this.dimensional_data[stack].forEach((data, index) => {
            let D = currentStackDocuments[index];
            if (nodes === null) {
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
                if (to_first_index === null) to_first_index = index;
                this.expand(data,D, true);
            } else {
                D.classList.add('dlp-label-silence');
                this.expand(data,D, false);
            }
        });
        if (to_first_index !== null) this.STACKS[stack].scrollTop = to_first_index * 27;
        this.selectToChildren(stack + 1, children);
    }

    expand(data,dom, open = true) {
        if(data.expand === open) return;
        data.expand = open;
        if (open) {
            let left_mark = dom.querySelector('i.left');
            if (left_mark) left_mark.innerHTML = _component.caret_right_circle;
            return;
        }
        let left_mark = dom.querySelector('i.left');
        if (left_mark) left_mark.innerHTML = _component.caret_right;
    }

    panel(){
        let html = `<div class="dot-cascade-panel"><div class="dlp plane-header"></div><div class="plane-body dlp-scroll"></div></div>`;
        this.DOM.childNodes[0].insertAdjacentHTML('beforeEnd', html);
        let panelDom = this.DOM.childNodes[0].lastChild;
        this.PLANE_DOM = panelDom;
        /*X*/
        let X = document.createElement('i');
        X.insertAdjacentHTML('afterbegin', _component.close);
        X.addEventListener('click', function () {
            panelDom.remove();
        }, false);
        panelDom.querySelector('.plane-header').append(X);
        this.PLANE_BODY = panelDom.querySelector('.plane-body');
        _component.loading(this.PLANE_BODY);
    }

    panelContent(response,data,xhr,method,callback) {
        _component.loading(this.PLANE_BODY,true);
        let fragment = document.createRange().createContextualFragment(response);
        this.PLANE_BODY.appendChild(fragment);
        let submit = document.createElement('button');
        submit.className = 'dlp-btn-round';
        submit.insertAdjacentHTML('afterbegin',_component.sub_check);
        submit.addEventListener('click',this.submitEvent.bind(this, submit,data,xhr,method,callback));
        this.PLANE_BODY.append(submit);
    }

    submitEvent(element,data,xhr,method,callback) {
        if(this.submit_block) return;
        this.submit_block = true;
        element.innerHTML = _component.sub_loading;
        let form = this.DOM.getElementsByTagName('form')[0];
        let formdata = new FormData(form);
        formdata.set('node-key',data.key);
        formdata.set('node-val',data.val);
        formdata.set('_method', method);
        let object = this;
        _component.request(xhr, 'POST', formdata, function (response) {
            object.submit_block = false;
            element.innerHTML = _component.sub_check;
            if(response.code !== 0){
                return _component.alert(response.message,3);
            }
            callback(response);
        },function () {
            object.submit_block = false;
        });
    }

    nodeInsert(e,data,stack,k){
        this.panel(e,data);
        let object = this;
        let nextStack = parseInt(stack) + 1;
        _component.request(this.URL+'/create', 'GET', {id:data.key}, function (response) {
            object.panelContent(response,data,object.URL,'POST',(response)=>{
                let key = parseInt(response.data.key);
                let val = response.data.val;
                if(!Array.isArray(data.nodes)) data.nodes = [];
                data.nodes.push(key);
                let parents = data.parentNodes.slice(0);
                parents.push(data.key);
                if(!Array.isArray(object.dimensional_data[nextStack])){
                    object.dimensional_data[nextStack] = [
                        {expand:false, key:key, val:val, nodes:null, parentNodes:parents}];
                    let v = object.dimensional_data[nextStack][0];
                    let stackDom = document.createElement('div');
                    stackDom.className = 'dot-cascade-stack dlp-scroll';
                    stackDom.append(object.insertLabelDom(v,0,nextStack));
                    object.CONTENT_DOM.append(stackDom);
                }else if(data.nodes.length === 0){
                    object.dimensional_data[nextStack].push(
                        {expand:false, key:key, val:val, nodes:null, parentNodes:parents});
                }else {

                }
                object.PLANE_DOM.remove();
            });
        });
    }

    nodeUpdate(e,data,stack,k){
        this.panel(e,data);
        let object = this;
        _component.request(this.URL+'/'+data.key+'/edit', 'GET', {val:data.val}, function (response) {
            object.panelContent(response,data,object.URL+'/'+data.key,'PUT',(response)=>{
                let val = response.data.val;
                data.val = val;
                for (let node of e.target.childNodes){
                    if(node instanceof HTMLElement) continue;
                    node.nodeValue = val;
                }
                object.PLANE_DOM.remove();
            });
        });
    }

    nodeDelete(){

    }
}
