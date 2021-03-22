$(function () {
  // DatePicker
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy年mm月dd日",
      minDate: new Date(2020, 1 - 1, 1),
      maxDate: new Date(2025, 12 - 1, 31),
    });
    $( "#datepicker2" ).datepicker({
      dateFormat: "yy年mm月dd日",
      minDate: new Date(2020, 1 - 1, 1),
      maxDate: new Date(2025, 12 - 1, 31),
    });
  } );
  // DatePicker

  // ここから検索窓トグル
  $('#search-toggle-btn').on("click",function() {
    $('#search-toggle-menu').slideToggle();
    if($(this).hasClass('fas fa-search-plus')){
      $(this).removeClass('fas fa-search-plus');
      $(this).addClass('fas fa-search-minus');
    } else {
      $(this).removeClass('fas fa-search-minus');
      $(this).addClass('fas fa-search-plus');
    };
  });
  // ここまで検索窓トグル

  // ここからタグ作成・編集モーダル
  $('.modal-open-btn').on("click",function() {
    let target = $(this).attr('data-type');
    if(target == '@create'){
      $("#edit-modal").addClass('modal-hide');
      $("#create-modal").removeClass('modal-hide');
    } else if(target == '@edit'){
      $("#edit-modal").removeClass('modal-hide');
      $("#create-modal").addClass('modal-hide');

      let tagId = $(this).attr('data-id');
      $("#edit-modal-form").attr("action", `/task_tags/${tagId}/edit`)

      let tagName = $(this).attr('data-name');
      $("#edit-modal-name").attr("value", `${tagName}`)
    };
  });
})