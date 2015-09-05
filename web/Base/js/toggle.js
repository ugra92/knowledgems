$('.wminimize').on('click', function(e){
    e.preventDefault();
    $(this).parent().parent().siblings().toggle();
    $(this).children().toggleClass('fa-chevron-up fa-chevron-down')
});
