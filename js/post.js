function AjaxRequest(info) {
    $.ajax({ // инициaлизируeм ajax зaпрoс
        type: info['type'], // oтпрaвляeм в POST фoрмaтe, мoжнo GET
        url: '/'+info['url'],
        dataType: 'json', // oтвeт ждeм в json фoрмaтe
        data: info['data'], // дaнныe для oтпрaвки
        beforeSend: function (data) {
            if(info['field'] != '')  document.getElementById(info['field']).disabled = true;
        },
        success: function (data) {
            if (data['error']) { // eсли oбрaбoтчик вeрнул oшибку
                ShowError(data['error']);
                return false;
            }
            else { // eсли всe прoшлo oк
                data = data["result"];
                if(info['action'] === 'getComments') {
                    ShowComments(data);
                    document.getElementById('comments_list').innerHTML = '';
                    for (var i = 0; i < data.length; i++) AppendComment(data[i]);
                }
                else if(info['action'] === 'sendComment') {
                    var comments_list = document.getElementById('comments_list');
                    var HTML = comments_list.innerHTML;
                     var HTML = '<li class=list-group-item><span class="commentator"><strong>'+data['author']+'</strong></span>: <span class="comment_text">'+data['text']+'</span><span style="float: right;"><small>A moment ago</small></span></li>' + HTML;
                        comments_list.innerHTML = HTML;
                }
                return true;
            }

        },
            error: function (jqXHR) {
            return false;
            },
            complete: function (data) { // сoбытиe пoслe любoгo исхoдa
                if(info['field'] != '')
                    document.getElementById(info['field']).disabled = false;
            }

        });

}
// DELETE POST
function Delete(id) {
    var info = {};
    info['type'] = "POST";
    info['action'] = 'DeletePost';
    info['url'] = "post/delete/" + id;
    info['field'] = "";
    info['data'] = '';
    var result = AjaxRequest(info);
    window.location.href = "/";

}



// Comments
function getComments(id) {
    var container = document.getElementById('comments_container');
    var status = container.style.display;
    if(status === 'none') {
        var info = {};
        info['type'] = "GET";
        info['url'] = "comments/get/" + id;
        info['field'] = "comments_button";
        info['data'] = '';
        info['action'] = 'getComments';
        var result = AjaxRequest(info);
    }
    else container.style.display = 'none';
}

function SendComment(id) {
    var container = document.getElementById('button_send_comment');
    if(!container.isDisabled) {
        var info = {};
        info['type'] = "POST";
        info['data'] = {};
        info['action'] = 'sendComment';
            info['data']['text'] = document.getElementById('CommentTextForm').value;
            info['data']['name'] = document.getElementById('CommentNameForm').value;
            info['data']['post_id'] = id;

        info['url'] = "comments/post";
        info['field'] = "button_send_comment";

        if(info['data']['text'] !== "" && info['data']['name'] !== "" && info['data']['post_id']) {
            if(checkOnNumber(info['data']['post_id'])) {
                var result = AjaxRequest(info);
                document.getElementById("CommentTextForm").value = "";
            }
        }
        else ShowError("Fill in all comment block fields");

    }
    else container.isDisabled = true;
}



function ShowForm() {
    var block = document.getElementById('add_comment_block');
    var display = block.style.display;
    if(display === 'none') block.style.display = 'block';
    else block.style.display = 'none';
}

function ShowComments(data) {
  document.getElementById('comments_container').style.display = 'block';
}

function AppendComment(data) {
    var list = document.getElementById('comments_list');
    list.innerHTML += '<li class="list-group-item"><span class="commentator"><strong>'+data['author']+':</strong></span><span class="comment_text">'+data['text']+'</span><span style="float:right;"><small>'+data['datetime'].substr(0,16)+'</small></span></li>';
}


function checkOnNumber(id) {
    var regex = /[0-9]|\./;
    return regex.test(id)
}


function ShowError(message) {
    var div = document.createElement('div');
    div.id = 'alert_block';
    div.innerHTML = '<div class="error-message alert alert-danger" role="alert">'+message+'</div>';
    document.body.appendChild(div);
    $('#alert_block').show('slow');
    setTimeout(function() { $('#alert_block').hide('slow');
    }, 4000);
}