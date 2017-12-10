$(document).ready(function(){
  $('.closeMsg').hide();
  $('.previewMsg').hide();

  $('.openMsg').click(function(){
    var id = $(this).attr("type");
    $('#'+id+'preview').show();
    $('#'+id+'closeBtn').show();
    $('#'+id+'openBtn').hide();
    $('#'+id+'subject').hide();
    $('#'+id+'item').removeClass('text-white bg-primary');
    $('#'+id+'closeBtn').click(function(){
        $('#'+id+'preview').hide();
        $('#'+id+'openBtn').show();
        $('#'+id+'subject').show();
        $(this).hide();
      });
    $.get('markAsRead/'+id, function (data) {
      $('#unread').html(data+' unread');
    });
  });

  $('.openMsgSent').click(function(){
    var id = $(this).attr("type");
    $('#'+id+'previewSent').show();
    $('#'+id+'closeBtnSent').show();
    $('#'+id+'openBtnSent').hide();
    $('#'+id+'subjectSent').hide();
    $('#'+id+'closeBtnSent').click(function(){
        $('#'+id+'previewSent').hide();
        $('#'+id+'openBtnSent').show();
        $('#'+id+'subjectSent').show();
        $(this).hide();
      });
  });


});
