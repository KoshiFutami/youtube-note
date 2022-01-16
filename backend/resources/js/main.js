// フォームで画像を選択時に、プレビューを表示
$(function() {
    $('input[name=thumbnail]').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function() {
            $('#thumbnailPreview img').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    });
});

// ボタンを押してナビゲーションを表示
$(function() {
    const $noteNav = $('#js-note-nav');
    const $noteNavButton = $('#js-note-nav-button');
    const $noteNavBg = $('#js-note-nav-bg');
    const $noteNavEdit = $('#js-note-nav-edit');
    const $noteEdit = $('#js-note-edit');
    const $noteEditBg = $('#js-note-edit-bg');
    const $noteEditClose = $('#js-note-edit-close');
    const $noteEditCancel = $('#js-note-edit-cancel');
    const ACTIVE_CLASS = 'is-active';
    const FIXED_CLASS = 'is-fixed';

    // 入力エラー時に強制的にアクティブクラスを付与
    if($noteEdit.hasClass(ACTIVE_CLASS)) {
        $noteEditBg.addClass(ACTIVE_CLASS);
        $('html, body').css('overflow', 'hidden');
    } 

    $noteNavButton.on('click', function() {
        $noteNav.addClass(ACTIVE_CLASS);
        $noteNavBg.addClass(ACTIVE_CLASS);
    });

    $noteNavEdit.on('click', function() {
        $noteEdit.addClass(ACTIVE_CLASS);
        $noteEditBg.addClass(ACTIVE_CLASS);
        $('html, body').css('overflow', 'hidden');
    });

    $noteNavBg.on('click', function() {
        $noteNav.removeClass(ACTIVE_CLASS);
        $noteNavBg.removeClass(ACTIVE_CLASS);
    });

    $noteEditClose.on('click', function() {
        closeNoteEdit();
    });
    $noteEditBg.on('click', function() {
        closeNoteEdit();
    });
    $noteEditCancel.on('click', function() {
        closeNoteEdit();
    });


    function closeNoteEdit() {
        $noteEdit.removeClass(ACTIVE_CLASS);
        $noteEditBg.removeClass(ACTIVE_CLASS);
        $noteNav.removeClass(ACTIVE_CLASS);
        $noteNavBg.removeClass(ACTIVE_CLASS);
        $('html, body').css('overflow', 'auto');
    }

});

