


//购买商品数量减一，剩余商品数目加一
function subplus(temp1) {
    let multmp = $("#item-1")[0].innerText;
    let multmpleft = $("#item-1-left")[0].innerText;
    if (temp1 == "sub") {
        if (parseInt(multmp) > 0) {
            $("#item-1")[0].innerText = parseInt(multmp) - 1;
            //console.log(multmp);
            $("#item-1-left")[0].innerText = parseInt(multmpleft) + 1;
        }
    }
    else if (temp1 == "plus") {
        if (parseInt(multmpleft) > 0) {
            $("#item-1")[0].innerText = parseInt(multmp) + 1;
            //console.log(multmp);
            $("#item-1-left")[0].innerText = parseInt(multmpleft) - 1;
        }
    }
}
function f() {
    
}
//页面跳转
function test(str) {
    // window.confirm("你点击了申请") ;
    if (str == "pay") {
        window.open("pay.html", target = "_parent");
    }

    else if (str == "request") {
        window.open("request.html", target = "_parent");
    }
}