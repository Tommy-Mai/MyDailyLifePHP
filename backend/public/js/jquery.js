$(function () {
  // DatePicker
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

  // ここからメモ作成・編集モーダル
  $('.modal-open-btn-memo').on("click",function() {
    let target = $(this).attr('data-type');
    if(target == '@create'){
      $("#edit-modal").addClass('modal-hide');
      $("#create-modal").removeClass('modal-hide');
    } else if(target == '@edit'){
      $("#edit-modal").removeClass('modal-hide');
      $("#create-modal").addClass('modal-hide');

      let memoId = $(this).attr('data-id');
      $("#edit-modal-form-memo").attr("action", `/users/memo/${memoId}/edit`)

      let memoName = $(this).attr('data-name');
      $("#edit-modal-name").attr("value", `${memoName}`)

      let memoDescription = $(this).attr('data-description');
      $('textarea[id="edit-modal-description"]').val(`${memoDescription}`)
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

  // Topページのswiper
  if (document.URL.match('/')) {
    var mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        SimulateTouch: false,
        shortSwipes: false,
        longSwipes: false,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        speed: 2000,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },

        on: {
            //スライド切り替え開始時に実行
            transitionStart: function(){

                //以前アクティブだったスライドのインデックス番号を取得する
                var previousIndex = this.previousIndex;
                //取得したインデックス番号を持つスライド要素を取得する
                var previousSlide = document.getElementsByClassName('swiper-slide')[previousIndex];
                //n秒後に「is-play」のクラス属性を削除する
                setTimeout(function() {
                    previousSlide.firstElementChild.classList.remove('is-play');
                }, 2000);
            },

            //スライド切り替え完了後に実行
            transitionEnd: function(){
                //現在アクティブ状態にあるスライドのインデックス番号を取得する
                var activeIndex = this.activeIndex;
                //取得したインデックス番号を持つスライド要素を取得する
                var activeSlide = document.getElementsByClassName('swiper-slide')[activeIndex];
                //スライド要素に「is-play」のクラス属性を追加する
                activeSlide.firstElementChild.classList.add('is-play');
            },
        }
    });
  };

  // ページトップボタン
  jQuery(function() {
    var appear = false;
    var pageTop = $('#page-top_btn');
    $(window).on('scroll',function () {
      if ($(this).scrollTop() > 100) {  //100pxスクロールしたら
        if (appear == false) {
          appear = true;
          pageTop.stop().animate({
            'bottom': '10px' //下から10pxの位置に
          }, 300); //0.3秒かけて現れる
        }
      } else {
        if (appear) {
          appear = false;
          pageTop.stop().animate({
            'bottom': '-50px' //下から-50pxの位置に
          }, 300); //0.3秒かけて隠れる
        }
      }
    });
    pageTop.on('click',function () {
      $('body, html').animate({ scrollTop: 0 }, 300); //0.5秒かけてトップへ戻る
      return false;
    });
  });
})
