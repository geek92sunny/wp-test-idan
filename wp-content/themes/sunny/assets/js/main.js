(function ($) {
  
  $(function(){

    const soniTheme = {
      postOffset: 0
    }

    $(".load-more").click(function(){
      $.ajax({
        url: theme_vars.ajax_endpoint,
        data: {action:'load_posts', offset: soniTheme.postOffset},
        dataType: 'json',

        success: function(res){
          if ( res.success ) {
            $('.post-wrp .posts').append(res.posts);

            if (res.posts_remain <= soniTheme.postOffset) {
              $(".load-more").hide();
            }

            soniTheme.postOffset = res.offset;
          } else {
            alert( res.message )
          }
        },
        
        error: function(){
          alert('Sorry, an error occurred!')
        }
      });
    });

  }); 

})(jQuery);
