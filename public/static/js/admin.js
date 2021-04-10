var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded',function(){
    if(route == "comic_edit")
    {
        var btn_comics_file_image = document.getElementById('btn_comics_file_image');
        var comics_file_image = document.getElementById('comics_file_image');
        btn_comics_file_image.addEventListener('click',function(){
            comics_file_image.click();
        },false);
        
        comics_file_image.addEventListener('change',function(){
            document.getElementById('form_comics_image').submit();
        });
    }

    route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');
});

$(document).ready(function(){
    editor_init('editor');
})

function editor_init(field){
    CKEDITOR.replace(field,{
        toolbar:[
        {name:'clipboard',items:['Cut','Copy','Paste','PasteText','-','Undo','Redo']},
        {name:'basicstyles',items:['Bold','Italic','BulletedList','Strike','Image','Link','Unlink','Blockquote']},
        {name:'document',items: ['CodeSnippet','EmojiPanel','Preview','Source']}
        ]
    });
}