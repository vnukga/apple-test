$(document).ready(function() {
    $('.apple-fall').on('click', function () {
        const id = ($(this).attr('data-id'));
        const url = '/apple/apple/fall';
        const data = {id: id};
        send(url, data);
    });
    $('.apple-eat').on('click', function () {
        const id = $(this).attr('data-id');
        cleanValidationErrors(id);
        const url = '/apple/apple/eat';
        const percents = $(this).parent().parent().find('input').val();
        if (percents.length === 0) {
            showValidationErrors(id, 'Нужно указать количество!');
        }
        if (percents > 100) {
            showValidationErrors(id, 'Количество не может быть больше 100!');
        } else {
            const data = {id: id, percents: percents};
            send(url, data);
        }
    })
})

function send(url,data){
    $.post(
        url,
        data
    ).done(function (response) {
        let item = $('#apple-item-' + data.id);
        updateItem(item, response)
    })
        .fail(function(xhr, textStatus, errorThrown) {
            let error = xhr.responseJSON.data;
            if(error.exception){
                alert(error.exception)
            }
            if(error.eaten){
                $('#apple-item-' + data.id).remove();
                alert(error.eaten);
            }
            if(error.status){
                $('#apple-item-' + data.id).find('.apple-status').text(error.status);
            }
    });
}

function updateItem(item, response) {
    let fellAt = response.data.fell_at;
    let status = response.data.status;
    let eaten = response.data.eaten;
    item.find('.apple-fell-at').text(fellAt);
    item.find('.apple-status').text(status);
    item.find('.apple-eaten').text(eaten);
}

function showValidationErrors(id, message) {
    let input = $('#apple-item-' + id).find('input');
    input.parent().addClass('has-error');
    let errorDiv = '<div class="invalid-feedback">' + message + '</div>';
    input.parent().parent().append(errorDiv);
}

function cleanValidationErrors(id) {
    let input = $('#apple-item-' + id).find('input');
    input.parent().removeClass('has-error');
    input.parent().parent().find('.invalid-feedback').remove();
}
