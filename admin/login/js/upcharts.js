function UpChart(data) {
    var myChart = echarts.init(document.getElementById('main'));
    let i = data.indexOf('[')+1;
    data = data.substring(i);
    data = data.replace(']', '');
    console.log(data);
    var b = data.split(',');
    myChart.setOption({
        xAxis: {},
        series: [{
            // 根据名字对应到相应的系列
            name: '销量',
            data: b,
        }]
    });

}