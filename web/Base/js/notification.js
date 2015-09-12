
$('.notification-li').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var notificationID = $(this).data('notificationid');
    var type = $(this).data('type');
    $.post('/web/notification/see', {id:notificationID}, function(data) {
       switch (type){
           case "video":{
               window.location.href = window.location.origin+"/web/video/" + id;
           }return;
           case "article":{
               window.location.href = window.location.origin+"/web/article/" + id;
           }return;
       }
    });
});
