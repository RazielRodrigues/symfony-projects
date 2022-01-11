$(document).ready(function() {
   
        $('.userLikesVideo').show();
        $('.userDoesNotLikeVideo').show();
        $('.noActionYet').show();
    
        
        $('.toogle-likes').on('click', function(e) {
            e.preventDefault();
    
            var $link = $(e.currentTarget);
    
            $.ajax({
                method: 'POST',
                url: $link.attr('href')
            }).done(function(data) {
                switch (data.action)
                {
                    case 'liked':
                    var number_of_likes_str =  $('.number-of-likes-' + data.id);
                    var number_of_likes = parseInt( number_of_likes_str.html().replace(/\D/g,'') ) + 1;
                    number_of_likes_str.html('(' + number_of_likes + ')');
                    $('.likes-video-id-'+data.id).show();
                    $('.dislikes-video-id-'+data.id).hide();
                    $('.video-id-'+data.id).hide();
        
                    break;
                    case 'disliked':
                    var number_of_dislikes_str =  $('.number-of-dislikes-' + data.id);
                    var number_of_dislikes = parseInt( number_of_dislikes_str.html().replace(/\D/g,'') ) + 1;
                    number_of_dislikes_str.html('(' + number_of_dislikes + ')');
                    $('.dislikes-video-id-'+data.id).show();
                    $('.likes-video-id-'+data.id).hide();
                    $('.video-id-'+data.id).hide();
    
                    break;
                    case 'undo liked':
                    var number_of_likes_str =  $('.number-of-likes-' + data.id);
                    
                    var number_of_likes = parseInt( number_of_likes_str.html().replace(/\D/g,'') ) - 1;
                    number_of_likes_str.html('(' + number_of_likes + ')');
                    $('.video-id-'+data.id).show();
                    $('.dislikes-video-id-'+data.id).hide();
                    $('.likes-video-id-'+data.id).hide();
    
                    break;
    
                    case 'undo disliked':
                    var number_of_dislikes_str =  $('.number-of-dislikes-' + data.id);
                    var number_of_dislikes = parseInt( number_of_dislikes_str.html().replace(/\D/g,'') ) - 1;
                    number_of_dislikes_str.html('(' + number_of_dislikes + ')');
                    $('.video-id-'+data.id).show();
                    $('.dislikes-video-id-'+data.id).hide();
                    $('.likes-video-id-'+data.id).hide();
                    
    
                    break;
    
                }
                
            })
        });
    
    });
