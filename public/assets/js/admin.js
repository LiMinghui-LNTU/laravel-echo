//---------获取消息------------
function getMessage(id) {
    $("#people-list").slideUp();
    $("#paginate-nav").slideUp();
    $("#reply-panel").slideDown();
}

function goBack() {
    $("#reply-panel").slideUp();
    $("#paginate-nav").slideDown();
    $("#people-list").slideDown();
}