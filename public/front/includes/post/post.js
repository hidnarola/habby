$('document').ready(function(){
	$('.post_section').on('click','.user_like',function(){
		post_id = $(this).parents('.pst_full_sec').data('post_id');

		$.ajax({
			url : base_url+'user/post/add_like/'+post_id,
			methos : 'post',
			data : '',
			success : function(str){
				if(str == "1")
				{
					// User liked images
					
				}
				else
				{
					// like failed
				}
			}
		});
	});
});