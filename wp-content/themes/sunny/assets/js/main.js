(function ($) {
  
  $(function(){

    let soniTheme = {
      postOffset: parseInt(theme_vars.native_posts_per_page)
    }

    $(".load-more").click(function(){
      $.ajax({
        url: theme_vars.ajax_endpoint,
        data: {action:'load_posts', offset: soniTheme.postOffset},
        dataType: 'json',
        success: function(res){
          if ( res.success ) {
            $('.post-wrp .posts').append(res.posts);

            if ( soniTheme.postOffset == res.lastOffset ){
              $(".load-more").hide();
            }

            soniTheme.postOffset += parseInt(theme_vars.native_posts_per_page);
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