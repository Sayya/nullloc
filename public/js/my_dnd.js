var dragElem = null;
var items = document.getElementById('form_update').getElementsByClassName('dragitem');

function dragStartHandler(e) {
    dragElem = e.target;
    e.dataTransfer.setData('dragitem', dragElem.innerHTML);
    e.dataTransfer.setData('dragitem_sort', dragElem.getElementsByTagName('input')[0].value);
}

function dragOverHandler(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
}

function dropHandler(e) {
    // class="dragitem"の要素になるまで親要素を遡る
    let dropElem = (function (t) { return t.className.match(/dragitem/) ? t : arguments.callee(t.parentNode); })(e.target);
    // 要素同士をい入れ替える
    dragElem.innerHTML = dropElem.innerHTML;
    dropElem.innerHTML = e.dataTransfer.getData('dragitem');
    // sort_noを入れ替える
    let drag_tmp = Object.assign({}, dragElem.getElementsByTagName('input')[0].value)[0];
    let drop_tmp = Object.assign({}, dropElem.getElementsByTagName('input')[0].value)[0];
    dragElem.getElementsByTagName('input')[0].value = drop_tmp;
    dropElem.getElementsByTagName('input')[0].value = drag_tmp;
}

Array.prototype.forEach.call(items, function (item) {
    item.addEventListener('dragstart', dragStartHandler);
    item.addEventListener('dragover', dragOverHandler);
    item.addEventListener('drop', dropHandler);
});
