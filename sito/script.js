$(document).ready(function(){
    $.ajax({
        url: 'controlloSchermate.php?url='+window.location.href,
        type: 'get',
        success: function(data){
            if(data.trim()){
                var arr = JSON.parse(data);

                if(arr.tipo == 'header' && arr.html)
                    visualizzaHeader(arr.html);
                if(arr.tipo == 'popup' && arr.html)
                    visualizzaPopup(arr.html);
            }
        }
    });
});

function visualizzaHeader(testo){
    var html = '<div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-autohide="false">';
    html += '<div class="toast-header">';
    html += '<strong class="mr-auto">Notifica</strong>';
    html += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
    html += '<span aria-hidden="true">&times;</span></button></div>';
    html += '<div class="toast-body">';
    html += testo;
    html += '</div></div>';

    $("body").append(html);
    $(".toast").toast('show');
}

function visualizzaPopup(testo){
    var html = '<div class="modal" tabindex="-1" role="dialog">';
    html += '<div class="modal-dialog d-flex" style="align-items:center; height:90vh" role="document">';
    html += '<div class="modal-content text-center">';
    html += '<div class="modal-body">';
    html += testo;
    html += '</div></div></div></div>';

    $("body").append(html);
    $(".modal").modal('show');
}