
//配置项
var setting = {
};

var zNodes;//数据变量


//ajax提交数据，请求后台PHP处理返回出目录结构json数据
$.ajax({
    url:"/cmf/admin/tree",
    type: "get",
    async: false,
    dataType:"json",
    success: function (data) {
        //alert(data);
        zNodes=data;    //将请求返回的数据存起来
        //alert(zNodes);
    },
    error: function (){//请求失败处理函数
        alert('请求失败');
    },
})

/*
zNodes = [
    {"name":"\u56fd\u9645\u5b89\u5168\u751f\u4ea7\u4fe1\u606f\u7ba1\u7406",
        "children":[{"name":"\u7f8e\u56fd","children":[
            {"name":"\u6cd5\u5f8b\u6cd5\u89c4","children":null},
            {"name":"\u673a\u6784\u4f53\u5236","children":null},
            {"name":"\u89c4\u5212\u79d1\u6280","children":null},
            {"name":"\u5b89\u5168\u76d1\u7ba1","children":null}]}
        ]
    },
    {"name":"\u56fd\u9645\u5408\u4f5c\u9879\u76ee\u4fe1\u606f\u7ba1\u7406","children":null},
    {"name":"\u5916\u4e8b\u5de5\u4f5c\u4fe1\u606f\u7ba1\u7406","children":null},
    {"name":"\u6293\u53d6\u5185\u5bb9","children":null}
];
*/

//初始化ztree目录结构视图！
$(document).ready(function(){

    zTreeObj = $.fn.zTree.init($("#articleTree"), setting, zNodes);
});