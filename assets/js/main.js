import { urlPath } from "../../config/config.js"
$(function() {
// ============================================= Carousel =====================================

    $.get(`${urlPath}/backend/api/Reward/read.php`, function(data) {
      data.forEach(imgObj => {
        $('.swiper-wrapper').append(`<div class="swiper-slide"><img class='swiper-image w-75 h-auto' src='${urlPath}/assets/img/award_Images/${imgObj.img_name}'></div>`)
        // $('.swiper-image').css('box-sizing', 'border-box')
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 3,
          spaceBetween: 30,
          freeMode: true,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
        });
     
      });

    }).fail(function(err){
       console.log('An error occured', err)
    })


    
})