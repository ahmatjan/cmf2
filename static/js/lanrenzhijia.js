/* 代码整理：懒人之家 www.lanrenzhijia.com */
// search
/* 代码整理：懒人之家 www.lanrenzhijia.com */
function $$(id) {
    if (document.getElementById) {
        return document.getElementById(id);
    } else if (document.layers) {
        return document.layers[id];
    } else {
        return false;
    }
} (function() {
    function initHead() {
        setTimeout(showSubSearch, 0)
    };
    function showSubSearch() {
        $$("pt1").onmouseover = function() {
            $$("pt2").style.display = "";
            $$("pt1").className = "select select_hover"
        };
        $$("pt1").onmouseout = function() {
            $$("pt2").style.display = "none";
            $$("pt1").className = "select"
        };
        $$("s1").onclick = function() {
            selSubSearch(1);
            $$("q").focus()
        };
        $$("s2").onclick = function() {
            selSubSearch(2);
            $$("q").focus()
        };
        $$("s3").onclick = function() {
            selSubSearch(3);
            $$("q").focus()
        };
        $$("s4").onclick = function() {
            selSubSearch(4);
            $$("q").focus()
        };
        $$("s5").onclick = function() {
            selSubSearch(5);
            $$("q").focus()
        };
        $$("s6").onclick = function() {
            selSubSearch(6);
            $$("q").focus()
        };
        $$("s7").onclick = function() {
            selSubSearch(7);
            $$("q").focus()
        };
    };
    /* 代码整理：懒人之家 www.lanrenzhijia.com */
    function selSubSearch(iType) {
        hbb = [];
        hbb = {
				0 : ["搜索标题", "0"],
				1 : ["搜索标题", "0"],
				2 : ["搜索关键字", "1"],
				3 : ["搜索简介", "2"],
				4 : ["搜索内容", "3"],
				5 : ["搜索分类", "4"],
				6 : ["搜索附件", "5"],
				7 : ["搜索表格", "6"]				
        };
        $$("s0").innerHTML = hbb[iType][0];
        $$("pt2").style.display = "none";
        $$("catid").value = hbb[iType][1];
    };
    initHead();
})();

hbb = [];
hbb = {
				0 : ["搜索标题", "0"],
				1 : ["搜索标题", "0"],
				2 : ["搜索关键字", "1"],
				3 : ["搜索简介", "2"],
				4 : ["搜索内容", "3"],
				5 : ["搜索分类", "4"],
				6 : ["搜索附件", "5"],
				7 : ["搜索表格", "6"]	
};

if (GetCookie('sousuosss')) {
    var sss = GetCookie('sousuosss');
    $$("s0").innerHTML = hbb[sss][0];
    $$("catid").value = hbb[sss][1];
}

function bottomForm(search_form) {
    if (search_form.catid.value == 4) {
        search_form.action = "http://www.lanrenzhijia.com";
        document.search_form.submit();
        return false;
    } else if (search_form.catid.value == 5) {
        search_form.action = "http://www.lanrenzhijia.com";
        document.search_form.submit();
        return false;
    } else {
        search_form.action = "http://www.lanrenzhijia.com";
        document.search_form.submit();
        return false;
    }
}
