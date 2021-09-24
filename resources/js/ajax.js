'use strict';

(function ($) {
  var AddReviews = function (){
    var $addReviewsButton = $('.Add-reviews');
    return {
      init: function () {
        $addReviewsButton.on('click', function(e){
          e.preventDefault();
          var route = $(this).data('nextPageUrl');
          axios.post(route).then(res => {console.log(res)});
        })
      }
    }
  }
  AddReviews().init();
})(jQuery)