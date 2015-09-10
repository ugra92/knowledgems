
$('.notification-li').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.post('/notification/see', {id:id}, function(data) {
        console.log(data);
        window.location.href = "article/" + id;
    });
});
