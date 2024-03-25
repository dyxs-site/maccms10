document.write('<script>
    // 自动提交百度收录
    (function(){
        var curProtocol = window.location.protocol.split(\':\')[0];
        var bp = document.createElement(\'script\');
        bp.src = (curProtocol === \'https\' ? \'https://zz.bdstatic.com/linksubmit/push.js\' : \'http://push.zhanzhang.baidu.com/push.js\');
        document.getElementsByTagName("script")[0].parentNode.insertBefore(bp, document.getElementsByTagName("script")[0]);
    })();
    
    // 百度统计
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f46a2caaf84b781dc103b13289d90383";
        document.getElementsByTagName("script")[0].parentNode.insertBefore(hm, document.getElementsByTagName("script")[0]);
    })();
    
    // tj1736 统计
    (function() {
        var apiUrl = "https://api.cgyx.tv:66";
        var token = "f7dd072abb9af17700b0b8a1bd8b8e1dc43e13838257436c31c30f4495aba5a79382ef3b36808ab90351f85de968be49838554c9b1e809e46631bdd330fc2189";
        var cltj = document.createElement("script");
        cltj.src = apiUrl + "/tj/tongji.js?v=1.3";
        document.getElementsByTagName("script")[0].parentNode.insertBefore(cltj, document.getElementsByTagName("script")[0]);
    })();
</script>')