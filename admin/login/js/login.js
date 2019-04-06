
$(document).ready(function () {
        // 基于准备好的dom，初始化echarts实例
       var  myChart = echarts.init(document.getElementById('main'));
// 指定图表的配置项和数据
        var option = {
            title: {
                text: '本月销售统计'
            },
            tooltip: {},
            legend: {
                data: ['销量（瓶）']
            },
            xAxis: {
                data: ["果粒橙", "营养快线", "可乐", "雪碧", "冰红茶", "绿茶", "冰糖雪梨", "脉动", "芬达", "醒目", "小茗同学"],
                axisLabel: {
                    interval: 0,
                    formatter: function (val) {
                        return val.split("").join("\n");
                    }
                }
            },
            yAxis: {},
            series: [{
                name: '销量（瓶）',
                type: 'bar',
                barWidth: '25',              //---柱形宽度
                data: [5, 20, 36, 10, 10, 20, 20, 36, 10, 10, 20]
            }]
        };
// 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }
);


function CurentTime() {
    var now = new Date();
    var year = now.getFullYear();       //年
    var month = now.getMonth() + 1;     //月
    var day = now.getDate();            //日
    var hh = now.getHours();            //时
    var mm = now.getMinutes();          //分
    var ss = now.getSeconds();            //秒
    var clock = year + "-";
    if (month < 10)
        clock += "0";
    clock += month + "-";
    if (day < 10)
        clock += "0";
    clock += day + " ";
    if (hh < 10)
        clock += "0";
    clock += hh + ":";
    if (mm < 10) clock += '0';
    clock += mm + ":";
    if (ss < 10) clock += '0';
    clock += ss;
    // console.log($('#realtime'));
    $('#realtime')[0].innerText = clock;
}

function snow() {
    //  1、定义一片雪花模板
    var flake = document.createElement('div');
    // 雪花字符 ❄❉❅❆✻✼❇❈❊✥✺
    flake.innerHTML = '❆';
    flake.style.cssText = 'position:absolute;color:#fff;';
    //获取页面的高度 相当于雪花下落结束时Y轴的位置
    var documentHieght = window.innerHeight;
    //获取页面的宽度，利用这个数来算出，雪花开始时left的值
    var documentWidth = window.innerWidth;
    //定义生成一片雪花的毫秒数
    var millisec = 30;
    //2、设置第一个定时器，周期性定时器，每隔一段时间（millisec）生成一片雪花；
    setInterval(function () { //页面加载之后，定时器就开始工作
        //随机生成雪花下落 开始 时left的值，相当于开始时X轴的位置
        var startLeft = Math.random() * documentWidth;
        //随机生成雪花下落 结束 时left的值，相当于结束时X轴的位置
        var endLeft = Math.random() * documentWidth;
        //随机生成雪花大小
        var flakeSize = 15 + 20 * Math.random();
        //随机生成雪花下落持续时间
        var durationTime = 4000 + 7000 * Math.random();
        //随机生成雪花下落 开始 时的透明度
        var startOpacity = 0.5 + 0.3 * Math.random();
        //随机生成雪花下落 结束 时的透明度
        var endOpacity = 0.2 + 0.2 * Math.random();
        //克隆一个雪花模板
        var cloneFlake = flake.cloneNode(true);
        //第一次修改样式，定义克隆出来的雪花的样式
        cloneFlake.style.cssText += `
            left: ${startLeft}px;
            opacity: ${startOpacity};
            font-size:${flakeSize}px;
            top:-25px;
               transition:${durationTime}ms;
           `;
        //拼接到页面中
        document.body.appendChild(cloneFlake);
        //设第二个定时器，一次性定时器，
        //当第一个定时器生成雪花，并在页面上渲染出来后，修改雪花的样式，让雪花动起来；
        setTimeout(function () {
            //第二次修改样式
            cloneFlake.style.cssText += `
                left: ${endLeft}px;
                top:${documentHieght}px;
                opacity:${endOpacity};
              `;
            //4、设置第三个定时器，当雪花落下后，删除雪花。
            setTimeout(function () {
                cloneFlake.remove();
            }, durationTime);
        }, 0);

    }, millisec);
}

function logout() {
    //function clearCookie()
    var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
    if (keys) {
        for (var i = keys.length; i--;)
            document.cookie = keys[i] + '=0;expires=' + new Date(0).toUTCString()
    }
    location.href = "http://localhost:8888/AutoPayPro/admin/login/index.html";

}
;
;
;
;








