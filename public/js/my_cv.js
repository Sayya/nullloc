// レスポンシブ対応
var cv_container = document.getElementById('cv-container');
var cv = document.getElementById('cv');
var ctx = cv.getContext('2d');

// cv.width = cv_container.clientWidth;
cv.width = 600;
cv.height = 600;

var add_btn = document.getElementById('addRect');
var clr_btn = document.getElementById('clearScreen');
var clr_btn = document.getElementById('clearScreen');

let drawings = [];
let pointeds = [];

drawAll(drawings);

let cnt_x = 0;
let cnt_y = 0;
function onAddClick (e) {
    // 最大２０ちょっと
    if (cnt_x < 300) {
        let txt = document.getElementById('insertText').value;

        drawings.push(new CVObj(ctx, txt, cnt_x+20, cnt_y+20, new CVTogObj(ctx)));
        drawAll(drawings);

        cnt_y += 20;
        cnt_x += 10;
        if (cnt_y > 300) {
            cnt_y = 0;
        }
    }
}

function onClrClick (e) {
    drawings = [];
    pointeds = [];
    cnt_x = 0;
    cnt_y = 0;
    drawAll(drawings);
}

add_btn.addEventListener('click', onAddClick, false);
clr_btn.addEventListener('click', onClrClick, false);

let mx_start = 0;
let my_start = 0;
function onMouseDown (e) {
    const cv_rect = e.target.getBoundingClientRect();
    mx_start = e.clientX - cv_rect.left;
    my_start = e.clientY - cv_rect.top;

    const reversed_drawings = reverse_safe(drawings);
    for (i = 0; i < drawings.length; i++) {
        if (doToggle(reversed_drawings[i])) {
            drawings.push(drawings.splice(drawings.length-(i+1), 1)[0]);
            break;
        }
        else if (doDrag(reversed_drawings[i])) {
            if (pointing) {
                pointed_obj.end_obj = drawings[drawings.length-(i+1)];
                dragging = false;
                dragged_obj = null;
            }
            else {
                drawings.push(drawings.splice(drawings.length-(i+1), 1)[0]);
            }
            break;
        }
    }
    if (pointing) {
        pointeds.push(pointed_obj);
        pointing = false;
        pointed_obj = null;
    }
}

let dragged_obj = null;
let dragging = false;
function doDrag(drawing) {
    is_dragged = drawing.x_start < mx_start &&
                 drawing.y_start < my_start &&
                 drawing.x_start + drawing.w > mx_start &&
                 drawing.y_start + drawing.h > my_start;
    if (is_dragged) {
        dragging = true;
        dragged_obj = drawing;
    }
    return is_dragged
}

let toggling= false;
function doToggle(drawing) {
    is_toggled = drawing.x_start + drawing.w - drawing.toggle.r < mx_start &&
                 drawing.y_start + drawing.h - drawing.toggle.r < my_start &&
                 drawing.x_start + drawing.w > mx_start &&
                 drawing.y_start + drawing.h > my_start;
    if (is_toggled) {
        toggling = true;
        dragged_obj = drawing;
    }
    return is_toggled
}

let pointed_obj = null;
let pointing = false;
function onDoubleClick(e) {
    const cv_rect = e.target.getBoundingClientRect();
    mx_start = e.clientX - cv_rect.left;
    my_start = e.clientY - cv_rect.top;

    const reversed_drawings = reverse_safe(drawings);
    for (i = 0; i < drawings.length; i++) {
        if (doDrag(reversed_drawings[i])) {
            pointed_obj = new CVLinObj(ctx);
            pointed_obj.start_obj = drawings[drawings.length-(i+1)];
            break;
        }
    }
    pointing = dragging;
    dragging = false;
}

function onMouseMove(e) {
    if (toggling) {
        const cv_rect = e.target.getBoundingClientRect();
        mx_offset = (e.clientX - cv_rect.left) - mx_start;
        my_offset = (e.clientY - cv_rect.top) - my_start;
    
        dragged_obj.expand(mx_offset, my_offset);
    }
    else if (dragging) {
        const cv_rect = e.target.getBoundingClientRect();
        mx_offset = (e.clientX - cv_rect.left) - mx_start;
        my_offset = (e.clientY - cv_rect.top) - my_start;
    
        dragged_obj.offset(mx_offset, my_offset);
    }
    else if (pointing) {
    }
    drawAll(drawings);
    drawMouse(e);
}

function onMouseUp(e) {
    if (toggling) {
        dragged_obj.change_siz();
        toggling= false;
        dragged_obj = null;
    }
    else if (dragging) {
        dragged_obj.change_pos();
        dragging = false;
        dragged_obj = null;
    }
    drawAll(drawings);
}

let cvImg = document.getElementById('cvImg');
let cvBlob = null;
function onMouseLeave(e) {
    onMouseUp(e);
    drawAll(drawings);
    ctob();
}

let file = null;
function ctob () {
    let cvURL = cv.toDataURL('image/png');
    let cvPNG = atob(cvURL.split(',')[1]);
    let buf = new Uint8Array(cvPNG.length);
    for (i = 0; i < cvPNG.length; i++) {
        buf[i] = cvPNG.charCodeAt(i);
    }
    cvBlob = new Blob([buf], { type: 'image/png' });
    //file = new File([cvBlob], 'image.png', { type: 'image/png' });
    let fd = new FormData();
    fd.append('file', cvBlob);

    $.ajax({
        url: "http://localhost"
    });
}

cv.addEventListener('mousedown', onMouseDown, false);
cv.addEventListener('dblclick', onDoubleClick, false);
cv.addEventListener('mousemove', onMouseMove, false);
cv.addEventListener('mouseup', onMouseUp, false);
cv.addEventListener('mouseleave', onMouseLeave, false);

////////////////////
// Canvas上のオブジェクト
////////////////////

function CVObj (ctx, txt, x_pos, y_pos, toggle) {
    this.text = txt;
    this.x_start = x_pos;
    this.y_start = y_pos;
    this.w = 200;
    this.h = 100;
    this.w_ini = 200;
    this.h_ini = 100;
    this.x_offset = 0;
    this.y_offset = 0;
    this.w_offset = 0;
    this.h_offset = 0;
    this.toggle = toggle;

    this.draw = function () {
        ctx.fillStyle = "white";
        ctx.fillRect(this.x_start + this.x_offset,
                     this.y_start + this.y_offset,
                     this.w + this.w_offset,
                     this.h + this.h_offset);
        ctx.strokeStyle = "black";
        ctx.strokeRect(this.x_start + this.x_offset,
                       this.y_start + this.y_offset,
                       this.w + this.w_offset,
                       this.h + this.h_offset);
        ctx.fillStyle = "black";
        ctx.font = "30px メイリオ";
        ctx.fillText(this.text,
                     this.x_start + this.x_offset + 30,
                     this.y_start + this.y_offset + 60,
                     this.w - 60);
        this.toggle.draw(this.x_start + this.x_offset,
                       this.y_start + this.y_offset,
                       this.w + this.w_offset,
                       this.h + this.h_offset);
    };

    this.offset = function (x, y) {
        this.x_offset = x;
        this.y_offset = y;
    };
    this.change_pos = function () {
        this.x_start += this.x_offset;
        this.y_start += this.y_offset;
        this.x_offset = 0;
        this.y_offset = 0;
    };
    this.expand = function (x, y) {
        this.w_offset = x;
        this.h_offset = y;
        if (this.w + this.w_offset < this.w_ini) {
            this.w_offset = this.w_ini - this.w;
        }
        if (this.h + this.h_offset < this.h_ini) {
            this.h_offset = this.h_ini - this.h;
        }
    };
    this.change_siz = function () {
        this.w += this.w_offset;
        this.h += this.h_offset;
        this.w_offset = 0;
        this.h_offset = 0;
    };
}

function CVTogObj (ctx) {
    this.r  = 10;
    this.draw = function (x, y, w, h) {
        ctx.fillStyle = "black";
        ctx.fillRect(x + w - this.r,
                     y + h - this.r,
                     this.r,
                     this.r);
    };
}

function CVLinObj (ctx) {
    this.start_obj = null;
    this.end_obj = null;
    this.draw = function () {
        if (this.start_obj !== null && this.end_obj !== null) {
            ctx.strokeStyle = "black";
            ctx.beginPath();
            so = this.start_obj;
            ctx.moveTo(so.x_start + so.x_offset + so.w / 2,
                       so.y_start + so.y_offset + so.h / 2);
            eo = this.end_obj;
            ctx.lineTo(eo.x_start + eo.x_offset + eo.w / 2,
                       eo.y_start + eo.y_offset + eo.h / 2);
            ctx.stroke();
        }
    };
}

function drawAll(drawings) {
    // クリア
    ctx.clearRect(0, 0, cv.width, cv.height)

    for(i = 0; i < pointeds.length; i++) {
        pointeds[i].draw();
    }
    for(i = 0; i < drawings.length; i++) {
        drawings[i].draw();
    }
}

////////////////////
// Utils
////////////////////

function reverse_safe (arr) {
    if (toString.call(arr) !== '[object Array]') return null;
    if(arr.length === 0) return arr;
    var copy = arr.slice();
    return copy.reverse();
}

// マウスカーソル追尾
function drawMouse (e) {
    const cv_rect = cv.getBoundingClientRect();
    x = e.clientX - cv_rect.left;
    y = e.clientY - cv_rect.top;

    ctx.strokeStyle = "black";
    ctx.beginPath();
    ctx.arc(x, y, 5, 0, Math.PI*2, false);
    ctx.stroke();
}
