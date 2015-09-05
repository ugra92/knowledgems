function renderResponseCard(questions){
    container = $('.answers');
    container.empty();
    $.each(questions, function(i, obj){
        console.log(obj);
        var col = $('<div>', {'class': 'col-md-6 col-lg-4'});
        var card = $('<div>', {'id':'profile-card', 'class':'card'});
        var cardImgDiv= $('<div>', {'class':'card-image waves-effect waves-block waves-light'});
        var title = $('<p>', {'class':'activator','text':obj.title});
        var imgAvatar = $('<img>', {'class':'circle responsive-img activator card-profile-image','src':obj.owner.profile_image});
        var cardContent = $('<div>', {'class':'card-content'});
        var buttonActivator = $('<a>', {'class':'btn-floating activator btn-move-up waves-effect waves-light darken-2 right'});
        var icoActivator = $('<i>', {'class':'fa fa-plus'});
        var span = $('<span>', {'class':'card-title activator grey-text text-darken-4', 'text':obj.title});
        var info = $('<p>', {'text':obj.tags[0], 'class':'card-title activator grey-text text-darken-4'});
        var cardReveal = $('<div>', {'class':'card-reveal'});
        var cardRevealTitle = $('<span>', {'class':'card-title grey-text text-darken-4', 'text':obj.title});
        var cardRevealClose = $('<i>', {'class':'fa fa-times'});
        container.append(col.append(card.append(cardImgDiv.append(title)).append(cardContent.append(imgAvatar).append(buttonActivator.append(icoActivator)).append(info)).append(cardReveal.append(cardRevealTitle.append(cardRevealClose)))));
    });
}


var avgRating = 0;
var ratingCounter = 0;
var ratingTotal = 0;
var tags = [];
function renderResponseList(questions){
    tags = [];
    container = $('.answers');
    container.empty();
    $.each(questions, function(i, obj){
        ratingCounter++;
        ratingTotal += obj.score;
        var title = obj.title;
        var views = obj.view_count;
        var linkQ = obj.question_id;
        var answCount = obj.answer_count;
        var score = obj.score;
        tags = tags.concat(obj.tags);

        //var tags = $.each(obj.tags, function(i, tag){
        //    tags+= tag+" ";
        //});
        var avatar;
        if(obj.owner.profile_image === undefined){
            avatar = "http://demo.patternlab.io/images/fpo_avatar.png";
        }else{
            avatar = obj.owner.profile_image;
        }
        var answerID = obj.accepted_answer_id;
        var date = new Date(obj.creation_date * 1000) ;
        var markup = "<div class='col-lg-6 col-sm-6'>" +
            "<ul id='issues-collection' class='collection card'>" +
            "<li class='collection-item avatar clearfix'>" +
            "<i class='fa fa-bug circle red darken-2'></i>" +
            "<a href=http://stackoverflow.com/questions/"+linkQ+" class='collection-header'><span class=''>"+title +"</span></a>" +
            "<a href='#' class='secondary-content'>"+''+"</a>" +
            "<p class='date right'>"+date.toDateString()+"</p>"+
            "</li>" +
            "<li class='collection-item'>" +
            "<div class='row'>" +
            "<div class='col s2'>"+
            "<img src='"+ avatar +"' alt='' class='circle responsive-img valign profile-image'>"+
            "</div>"+
            "<div class='col s4'> By <a href='#' class='valign'>"+ obj.owner.display_name +"</a></div>"+
            "<div class='col s6'>" +
            "<p  class='collections-title'><b>Answer count: </b>"+answCount+"</p>"+
            "<p  class='collections-title'><b>Score: </b>"+score+"</p>"+
            "<p class='collections-content'><a href='http://stackoverflow.com/a/"+answerID +"' class='acceptedAnsw'>See accepted answer</a></p>" +
            "</div>" +
            "</div>"+
            "</li>" +
            "</ul>" +
            "</div>";
        container.append(markup);
    });

    analize(tags);
    avgRating = ratingTotal/ratingCounter;
    $('#avgRating').html(Math.round(avgRating * 100) / 100);
    $('#grafik').empty();
    var barChartData = {
        labels : tagWords,
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(230,97,107,1)",
                highlightStroke: "rgba(220,220,220,1)",
                data : tagsNum
            }
        ]

    }
    var myBar;
    var ctx = document.getElementById("grafik").getContext("2d");
    if( myBar == 'undefined'){
        myBar= new Chart(ctx).Bar(barChartData, {
            responsive : true
        });
    }else{
        //myBar.destroy();
        myBar= new Chart(ctx).Bar(barChartData, {
            responsive : true
        });
    }

    console.log(myBar);

}

var words = [];
var counts = [];

var tagWords= [];
var tagsNum= [];

function analize(result) {
    for (var i=0; i<result.length; i++) {
        if (array_contains(words, result[i])) {
            counts[result[i]]++;
        } else {
            words.push(result[i]);
            counts[result[i]] = 1;
        }
    }
    separateArrays(counts);
}

function array_contains(array, value) {
    for (var i=0; i<array.length; i++)
        if (array[i] == value)
            return true;
    return false;
}

function separateArrays(data){
    for (var property in data) {
        if ( ! data.hasOwnProperty(property)) {
            continue;
        }
        tagWords.push(property);
        tagsNum.push(data[property]);
    }
    console.log(tagWords);
    console.log(tagsNum);
}



