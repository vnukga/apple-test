$(document).ready(function() {
    $('.apple-fall').on('click', function () {
        const id = ($(this).attr('data-id'));
        send('/apple/apple/fall', id);
    })
})

function send(url,id){
    $.post(
        url,
        {
            id: id,
        },
        onAjaxSuccess
    );
}


function onAjaxSuccess(data)
{
    // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
    console.log(data);
}