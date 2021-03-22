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

  // ここからコメント投稿欄 ファイル選択中はコメント欄ブロック
  $('#comment_image').on('change',function(){
    // ファイルが選択されているかどうかで分岐
    if (Object.keys(this.files).length > 0) {
      selectFile = this.files[0];
      $('.fa-image').css('color', '#4ab37d');
      // テキスト入力を不可にする処理(入力済みの内容を取得保持。)
      $('textarea').prop('disabled', true);
      textValue = $('#comment_text').val();
      $('#comment_text').val("");
      $('textarea').prop('placeholder', "画像選択中");
    } else {
      selectFile = [];
      $('.fa-image').css('color', '');
      // テキスト入力を可能にする処理
      $('textarea').prop('disabled', false);
      $('#comment_text').val(`${textValue}`);
      $('textarea').prop('placeholder', "Aa");
    }
  });

})