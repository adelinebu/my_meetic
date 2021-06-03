$(function(){
    $(".main li").hover(
        function(){
            $('>ul.sub:not(:animated)', this).slideDown(500);
        },
        function(){
            $('>ul.sub',this).slideUp(300);
        }
    );
})