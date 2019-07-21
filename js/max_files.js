$(function() {

    var // Define maximum number of files.
        max_file_number = 4,
        // Define your form id or class or just tag.
        $form = $('form'),
        // Define your upload field class or id or tag.
        $file_upload = $('#imgInp', $form),
        // Define your submit class or id or tag.
        $button = $('.submit', $form);

    // Disable submit button on page ready.
    $button.prop('disabled', 'disabled');

    $file_upload.on('change', function () {
        var number_of_images = $(this)[0].files.length;
        if (number_of_images > max_file_number) {
            alert(`Maxymalnie ${max_file_number} pliki.`);
            $(this).val('');
            $button.prop('disabled', 'disabled');
        } else {
            $button.prop('disabled', false);
        }
    });
});