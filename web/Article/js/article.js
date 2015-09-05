$('.category-check').on('change', function(){
    $('.articles-all').css('opacity', 0.15);
    var parameters='';
    $('.category-check').each(function(){
        if($(this).is(':checked')){
            parameters+= $(this).attr('name')+',';
        }
    });
    $.post( "{{ path('json-articles-post') }}", {parameter:parameters}, function( data ) {
        success(data);
    });

    function success(obj){
        $('.articles-all').css('opacity',1);
        $('.articles-all').empty();
        $.each(obj, function(i,val){
            var panelBody = renderDiv('panel-body');
            var profileActivity = renderDiv('profile-activity');
            var actTime = renderDiv('act-time');
            var activityBody = renderDiv('activity-body act-in articles-timeline');
            var text = renderDiv('text');
            var textInner= " <a href='#' class='activity-img'><img class='avatar' src='http://www.thebalsagroup.org/wp-content/uploads/2014/10/Five-Promotional-Items-For-the-Savvy-Businessman.png' alt=''></a>" +
                " <p class='attribution'><a href='#'>"+val.name+"</a>"+val.createdAt+"</p>" +
                " <h5>"+ val.heading+ "</h5>"+
                "<p>"+val.content.substring(0,150)+"</p>";
            $('.articles-all').append(panelBody.html(profileActivity.html(actTime.html(activityBody.html(text.html(textInner))))));
            console.log(val);
        });
    }
});
function renderDiv(klasa, tekst){
    if(tekst=='undefined'){
        tekst= '';
    }
    return $('<div>', {
        "class": klasa,
        "text": tekst
    });
}