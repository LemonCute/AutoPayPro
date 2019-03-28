var allmoney;

//购买商品数量减一，剩余商品数目加一
function subplus(temp1, num) {
    allmoney = $("#allMoney")[0].innerText;
    let multmp = $(".inputsm")[num].innerText;
    let multmpleft = $(".item-left")[num].innerText;
    let permoney = $('.item-1-left')[num].innerText;
    let quantity = $('#allQuantity')[0].innerText;

    if (temp1 == "sub") {
        if (parseInt(multmp) > 0) {
            $(".inputsm")[num].innerText = parseInt(multmp) - 1;
            $(".item-left")[num].innerText = parseInt(multmpleft) + 1;
            $("#allMoney")[0].innerText = (parseFloat(allmoney) - parseFloat(permoney)).toFixed(2);
            $('#allQuantity')[0].innerText = parseInt(quantity) - 1;
        }
    }
    else if (temp1 == "plus") {
        if (parseInt(multmpleft) > 0) {
            $(".inputsm")[num].innerText = parseInt(multmp) + 1;
            $(".item-left")[num].innerText = parseInt(multmpleft) - 1;
            $("#allMoney")[0].innerText = (parseFloat(allmoney) + parseFloat(permoney)).toFixed(2);
            $('#allQuantity')[0].innerText = parseInt(quantity) + 1;
        }
    }
    //购物车图标上下相同
    $('.balltxt')[0].innerText = parseInt($('#allQuantity')[0].innerText);
}


function doSubmitForm() {
    var form = document.getElementById('test-form');
    let str = $('.goodsitem');
    let num = $('.inputsm');
    let detail=[];
    for (let i = 0; i < str.length; i++) {
        detail[i] = str[i].innerText + "," + num[i].innerText;
    }
    console.log(detail);
    $('#allpic')[0].value = $("#allMoney")[0].innerText;
    $('#detail')[0].value = detail;
    form.submit();
}

/*
function showPay() {
    let str = $('.goodsitem');
    let num = $('.inputsm');
    let detail;
    for (let i = 0; i < str.length; i++) {
        detail = str[i].innerText + "," + num[i].innerText;
    }
    var jqxhr = $.post('../alipayPHP/index.php', {
        allpic: allmoney,
        detail: detail,
    }).done(function (data) {
        console.log("success");
    }).fail(function (xhr, status) {
        console.log('fail');
    }).always(function () {
        window.open('../alipayPHP/index.php')
    });

}


function test(str) {
    // window.confirm("你点击了申请") ;
    if (str == "pay") {
        window.open("pay.html", target = "_parent");
    }
    else if (str == "request") {
        window.open("request.html", target = "_parent");
    }
}
*/