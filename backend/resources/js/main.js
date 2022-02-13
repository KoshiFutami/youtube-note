// フォームで画像を選択時に、プレビューを表示
$(function() {
    $('input[name=thumbnail]').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function() {
            $('#thumbnailPreview > img').attr('src', reader.result);
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


// ドロップダウンメニューの表示
$(function() {
    const $userThumbnail = $('#js-user-thumbnail');
    const $userNavDropdown = $('#js-usernav-dropdown');
    const $userNavDropdownBg = $('#js-usernav-dropdown-bg');
    const ACTIVE_CLASS = 'is-active';

    $userThumbnail.on('click', function() {
        $userNavDropdown.toggleClass(ACTIVE_CLASS);
        $userNavDropdownBg.toggleClass(ACTIVE_CLASS);
    });
    $userNavDropdownBg.on('click', function() {
        $userNavDropdown.removeClass(ACTIVE_CLASS);
        $(this).removeClass(ACTIVE_CLASS);
    });
});

// フォームのパスワード表示・非表示を切り替え
$(function() {
    const $passwordToggle = $('.js-password-toggle');
    $passwordToggle.on('click', function(e) {
        e.preventDefault();
        
        if ($(this).prev('input').get(0).type === 'password') {
            $(this).prev('input').get(0).type = 'text';
            $(this).text('visibility_off');
        } else {
            $(this).prev('input').get(0).type = 'password';
            $(this).text('visibility');
        }
    });
});


// メモのブックマーク処理
$(function() {
    const $bookmarkButton = $('.button-bookmark');
    let noteId;

    $bookmarkButton.on('click', function() {
        let $this = $(this);
        noteId = $(this).data('note-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/notes/' + noteId + '/bookmark',
            method: 'POST',
            data: {
                'note_id': noteId
            }
        })
        .done(function (data) {
            console.log('It successed!');

            if ($this.hasClass('is-bookmarked')) {
                toastrMessage = "このメモをブックマークから削除しました。";
            } else {
                toastrMessage = "このメモをブックマークに保存しました。";
            }
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "750",
                "hideDuration": "7500",
                "timeOut": "4000",
                "showEasing": "linear",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success(toastrMessage);

            $this.toggleClass('is-bookmarked');

        })
        .fail(function () {
            console.log('It failed!');
        });
    });
});