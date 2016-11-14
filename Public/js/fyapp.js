jQuery.extend({
    initdata: function (fun) {
        $(function () {
            var appendstr = "";
            appendstr += '<div class="bigloading">';
            appendstr += '<div class="bigloadingcontent">';
            appendstr += '<img class="logo" src="/public/img/logo_302_94.png"/>';
            appendstr += '<br/>';
            appendstr += '<div class="loading"><div class="ball"></div>';
            appendstr += '</div>';
            appendstr += '</div>';
            appendstr += '</div>';
            $("body").append(appendstr);
            fun();
        })
    },
    showpage: function (messageToo) {
        $(".bigloading").fadeOut(150,function(){
            $(".bigloading").remove();
            });
    }
}); 