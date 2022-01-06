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
