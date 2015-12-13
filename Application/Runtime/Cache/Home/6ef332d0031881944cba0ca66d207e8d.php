<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title><?php echo ($article['title']); ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="" http-equiv="keywords">
    <meta content="" http-equiv="description">
    <script src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo ($siteInfo['webFolder']); ?>static/css/front/front.js" type="text/javascript"></script>
    <link href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/layout.css" type="text/css" rel="stylesheet">
    <script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
</head>
<body>

<script>
    $(function () {
        $('#container1').highcharts({                   //图表展示容器，与div的id保持一致
            chart: {
                type: 'column'                         //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '英国铁路安全事故统计'      //指定图表标题
            },
            xAxis: {
                categories: ['2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2008', '2010', '2011', '2012', '2013']   //指定x轴分组
            },
            yAxis: {
                title: {
                    text: '数量'                  //指定y轴的标题
                }
            },
            series: [{                                 //指定数据列
                name: '死亡人数',                          //数据列名
                data: [80, 73, 73, 59, 69, 66, 70, 67, 68, 41, 53, 48, 36]                        //数据
            }, {
                name: '高风险事件',
                data: [69, 65, 53, 63, 46, 45, 42, 49, 42, 18, 33, 34, 32]
            }]
        });

        $('#container2').highcharts({                   //图表展示容器，与div的id保持一致
            chart: {
                type: 'column'                         //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '英国铁路安全事故统计'      //指定图表标题
            },
            xAxis: {
                categories: ['2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2008', '2010', '2011', '2012', '2013']   //指定x轴分组
            },
            yAxis: {
                title: {
                    text: '数量'                  //指定y轴的标题
                }
            },
            series: [{                                 //指定数据列
                name: '伤亡总数',                          //数据列名
                data: [14071, 13981, 14837, 14421, 13977, 13558, 13159, 13055, 12668, 13001, 13556, 13039, 13096]                        //数据
            }]
        });

        $('#container3').highcharts({                   //图表展示容器，与div的id保持一致
            chart: {
                type: 'column'                         //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '英国航空与水上交通死亡人数统计'      //指定图表标题
            },
            xAxis: {
                categories: ['2003', '2004', '2005', '2006', '2007', '2008', '2008', '2010', '2011', '2012', '2013']    //指定x轴分组
            },
            yAxis: {
                title: {
                    text: '人数'                  //指定y轴的标题
                }
            },
            series: [{                                 //指定数据列
                name: '航空',                          //数据列名
                data: [15, 19, 25, 16, 31, 14, 36, 8, 8, 8, 23]                        //数据
            }, {
                name: '水上交通',
                data: [28, 19, 41, 52, 63, 33, 37, 27, 36, 0, 0]
            }]
        });

        $('#container4').highcharts({                   //图表展示容器，与div的id保持一致
            chart: {
                type: 'column'                         //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '煤矿事故死亡率'      //指定图表标题
            },
            xAxis: {
                categories: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']   //指定x轴分组
            },
            yAxis: {
                title: {
                    text: 'something'                  //指定y轴的标题
                }
            },
            series: [{                                 //指定数据列
                name: '美国',                          //数据列名
                data: [1, 1, 4, 5, 2, 7, 9, 1, 3, 2, 4, 4]                        //数据
            }, {
                name: '英国',
                data: [5, 7, 3, 6, 2, 9, 3, 5, 5, 6, 7, 11]
            }]
        });
    });
</script>

<div style="width:1000px;" align="center">

    <div style="float:left; width:500px; " >
        <div id="container1"></div>
    </div>
    <div style="float:left; width:500px; " >
        <div id="container2"></div>
    </div>
    <div style="float:left; width:500px; " >
        <div id="container3"></div>
    </div>
    <div style="float:left; width:500px; " >
        <div id="container4"></div>
    </div>
</div>
</body>
</html>