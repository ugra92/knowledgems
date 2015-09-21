$('.wminimize').on('click', function(e){
    e.preventDefault();
    $(this).parent().parent().siblings().slideToggle();
    $(this).children().toggleClass('fa-chevron-up fa-chevron-down')
});
