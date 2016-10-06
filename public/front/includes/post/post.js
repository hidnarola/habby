$('document').ready(function(){
	$('.post_section').on('click','.user_like',function(){
		var t = $(this);
		post_id = t.parents('.pst_full_sec').data('post_id');

		$.ajax({
			url : base_url+'user/post/add_like/'+post_id,
			success : function(str){
				var like = parseInt(t.find('.like_cnt').html());
				if(str == 1)
				{
					// User liked images
					t.find('.like_cnt').html((like+1));
					t.find('.like_img').attr('src',base_url+'public/front/img/liked_img.png');
				}
				else if(str == -1)
				{
					// User disliked the post
					t.find('.like_cnt').html((like-1));
					t.find('.like_img').attr('src',base_url+'public/front/img/like_img.png');
				}
				else
				{
					// like failed
					console.log('fail');
				}
			}
		});
	});

	$('.post_section').on('click','.pstbtn',function(){
		var t = $(this);
		post_id = t.parents('.pst_full_sec').data('post_id');

		$.ajax({
			url:base_url+'user/post/save_post/'+post_id,
			success : function(str){
				if(str == 1)
				{
					t.html('saved')
				}
				else
				{
					t.html('save failed');
				}
			}
		});
	});

	$('.post_section').on('click','.user_coin',function(){
		var t = $(this);
		post_id = t.parents('.pst_full_sec').data('post_id');

		$.ajax({
			url:base_url+'user/post/add_coin/'+post_id,
			success: function(str){
				var coin = parseInt(t.find('.coin_cnt').html());
				if(str == 1)
				{
					t.find('.coin_cnt').html((coin+1));
					t.find('.img-coin').attr('src',base_url+'public/front/img/coined_icon.png');
				}
				else if(str == 2)
				{
					t.find('.coin_cnt').html((coin-1));
					t.find('.img-coin').attr('src',base_url+'public/front/img/coin_icon.png');
				}
				else
				{
					console.log('fail');
				}
			}
		});
	});

	// Image uploading script
    $("#uploadFile").on("change", function()
    {
    	console.log('on change fired');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader){
        	$('.message').html("No file selected.");
        	$('.message').show();
        	return; // no file selected, or no FileReader support
        }
        	
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
            	$('.message').hide();
                $("#imagePreview").css("background-image", "url("+this.result+")");
                // $('#imagePreview').addClass('imagePreview');
            }
        }
        else
        {
        	$('.message').html("Please select proper image");
        	$('.message').show();
        }
    });

});