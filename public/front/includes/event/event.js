$(function () {
    $('#start_time').datetimepicker({
        locale: 'en'
    });
    $('#end_time').datetimepicker({
        locale: 'en'
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        var i = 0;
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                if (/^image/.test(files[key].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        // $('#imagePreview').addClass('imagePreview');
                        $('.message').hide();
                        $('.image_wrapper').show();
                        $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                        $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                        ++i;
                    }
                }
                else
                {
                    this.files = '';
                    $('.message').html("Please select proper image");
                    $('.message').show();
                }
            }
        }
    });
    // Video uploading script
    $('#uploadVideo').on("change", function () {
        $('.message').html();
        $('.video_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (/^video/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.video_wrapper').show();
                    $('.message').hide();
                    $('.video_wrapper').append("<img class='videoPreview" + i + "' id='imagePreview' src='" + $('.video_wrapper').data('default_image') + "'/>");
//                    $('.videoPreview'+i).css("background-image", ;
                    ++i;
                }
            }
            else
            {
                $('.message').html("Please select proper video");
                $('.message').show();
            }
        }
    });
    // Add comment to the post
});