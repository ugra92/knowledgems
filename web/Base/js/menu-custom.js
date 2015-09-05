$('.menu-item').on('click', function(){
    console.log('click');
    $(this).next().toggle();
});
