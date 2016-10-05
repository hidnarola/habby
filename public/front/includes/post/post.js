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
});