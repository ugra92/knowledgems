$(document).ready(function(){

});
view = $('#view');
ace.require("ace/ext/language_tools");
var editor = ace.edit("code-html");
var css = ace.edit("code-css");
var js = ace.edit("code-js");
editor.getSession().setMode("ace/mode/html");
css.getSession().setMode("ace/mode/css");
js.getSession().setMode("ace/mode/javascript");
editor.setTheme("ace/theme/monokai");
css.setTheme("ace/theme/monokai");
js.setTheme("ace/theme/monokai");

var context = "var iframe = document.getElementById('view');" +
    " var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;";

$("#dugme").on('click', function () {
//            var parsedJs = parse(js.getSession().getValue());
    view.contents().find('body').html(editor.getSession().getValue()+"<"+"script>"+context+"</"+"script>");
});
css.on('change', function () {
    var bootstrap="<link rel='stylesheet' href='{{ asset('Base/css/bootstrap.min.css') }}'>";
    view.contents().find('head').html(bootstrap+"<style>"+css.getSession().getValue()+"</style>");
});

$("#dugme").on('click', function () {
    if(js.getSession().getValue()!=''){
        var parsedJs = parse(js.getSession().getValue());
        console.log(parsedJs);
        var jquery= "<script src='{{ asset('Base/js/jquery-2.1.3.js') }}'><\/script>";
        view.contents().find('body').html(""+jquery+""+editor.getSession().getValue()+"<"+"script>"+context+parsedJs+"<\/script>");
    }
});

function parse(code){
    var code = code.replace(/'/g, '"');
    var regex = /(\$\("(#|\.).+"\))|(\$\(".+"\))/g;
    var selectors = code.match(regex);
    if(selectors!=null){
        var tmpSelectors = [selectors.length];
        for (var i =0; i<selectors.length; i++){
            tmpSelectors[i] = selectors[i].substring(3, selectors[i].length-2);
            tmpSelectors[i]= "$(innerDoc).find('"+tmpSelectors[i]+"')";
            var code= code.replace(selectors[i], tmpSelectors[i]);
        }
        return code.replace(/(')/gm,"\'");
    }
    else {
        return "";
    }
}

//            KEY TO MAKE IT WORK
//        var iframe = document.getElementById('view');
//        var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
//        var a = $(innerDoc).find('#a');
//        a.click(function(){
//            alert('daads');
//        });
//        a.text('Novi');