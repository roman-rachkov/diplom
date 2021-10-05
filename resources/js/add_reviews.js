'use strict';

(function ($) {
  var AddReviews = function (){
    var $addReviewsButton = $('.Add-reviews');
    var $comments = $('.Comments');
    return {
      init: function () {
        $addReviewsButton.on('click', function(e){
          e.preventDefault();
          var route = $(this).data('route');
          var nextPage = $(this).data('page') + 1;

          axios.post(route, {'current_page': nextPage}).then(res => {
            if (res.data.last_page == res.data.current_page) {
              $addReviewsButton.hide();
              return;
            }
            $(this).data('page', res.data.current_page);
            res.data.data.forEach(comment => {
              let $commentClone = $('.Comment').first().clone();
              $commentClone.find('.Comment-title').html(comment.user.name);
              $commentClone.find('.Comment-date').html(comment.comment_date);
              $commentClone.find('.Comment-content').html(comment.review);
              $commentClone.appendTo($comments);
            })
          });
        })
      }
    }
  }
  AddReviews().init();
})(jQuery)