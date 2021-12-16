import { updatedImageValidation, emailValidation } from './functions.js'
$(function() {
  
  // ============================= Email Validation EventListener =======================================
  $('#email').keyup(function() {
  emailValidation()
  $('.emptyEmail').remove()
  });
  

// ================================================== Upload Area ==============================
  $('.uploadArea input').change(function () {
    $('.uploadArea p').text($('#file').get(0).files[0].name);    
  });
    
// ------------------------------- Submit form -----------------------    
  $('#formUpdate').on("submit", function(e) {
    e.preventDefault();
    $('.noFileError').html('')
    $('.emptyEmail').remove()
    
    if(!updatedImageValidation()) {
      return;
    } 

    if($('#email').val().length < 1) {
      $('.inputDiv').append('<span class="emptyEmail emptyEmailError text-danger">Please insert your email.</span>')
      return;
    }
    else if ($('#email').hasClass('is-invalid')) {
      return;
    }
    else if ($('#file').get(0).files.length === 0) {
      $('.noFileError').html('<span class="emptyEmailError text-danger">No files selected.</span>').css("display", "flex")
      return;
    }  else {
      $(this).off('submit').submit();
    }

            
  })
  // -------------- Attempt times if the client proceed to upload invalid images -------------------
  let remainingTimes = localStorage.getItem('RemainingTimes')
  let blocked = localStorage.getItem('Blocked')
  let blockedTime = localStorage.getItem('BlockedTime')
  if(remainingTimes) {
    if(blocked) {
      $('.sendInfoBtn').attr('disabled','disabled');
      $('.uploadFooter').append('<p class="text-danger blockedText">You are blocked for 24 hours.</p>')
      let currentTime = Math.round(new Date().getTime()/1000)
      let timeSuspension = currentTime - blockedTime
      if(parseInt(timeSuspension) > 86400) {
        localStorage.removeItem('RemainingTimes');
        localStorage.removeItem('Blocked');
        localStorage.removeItem('BlockedTime');
        $('.sendInfoBtn').prop("disabled", false);
        $('.blockedText').remove()
      }
    } 
  } 
  else {
    remainingTimes = 3;
  }
  
//  ================== API call manipulation (loader and printing messages of errors or success) ================================== 
  if($('#databaseSuccess').hasClass('Done')) {
    $('#test').modal('show')
    $('.progress-container').css('display', 'block')
    $('.closeButton').css('display', 'none')
    $('.closeBtn').css('display', 'none')

    new Promise(function(resolve, reject){
  // ------------- ProgressBar animation-------------
        $(".progress .progress-bar").animate({
            width: "100%"
        }, 1500 )
    // --------------- Time delay to finish the progressBar ------------
        setTimeout(function(){
            $('#databaseSuccess').removeClass('Done');
            resolve("End of third promise")
        }, 2000)
    })
    .then((data) => {
      // ------------- Change display elements to the progressBar ------------------
      $('.progress-container').css('display', 'none')
      $('.closeButton').css('display', 'flex')
      $('.closeBtn').css('display', 'flex')
  // ------------------ Print messages if the proces is successful or not -------------------  
      if($('#databaseSuccess').hasClass('APIsuccess')) {
        $('.imgVerBodyText').html('<span class="text-success">You have successfully applied for our giveaway game. Thank you for participating. You will receive additional information by email.<i class="far fa-check-circle text-success"></i></span>')

      } else if($('#databaseSuccess').hasClass('APIerror')) {
        $('.imgVerBodyText').html('<span class="text-danger">OOPS! A problem occure, please try again or come back later. <i class="far fa-times-circle text-danger"></i></span>');

      } else if ($('#databaseSuccess').hasClass('APIstatus_invalid')) {
  // ---------------------- check how many times visitor have upload invalid image ---------------------------
        remainingTimes--;
        if(parseInt(remainingTimes) == 0) {
          $('.imgVerBodyText').html(`<span class="text-danger">You upload an invalid Receipt image 3 time. You are blocked for 24 hours.</span>`);
          if(blocked) {
            
          } else {
            localStorage.setItem('Blocked', 'blocked')
            localStorage.setItem('BlockedTime', Math.round(new Date().getTime()/1000))
            $('.sendInfoBtn').attr('disabled','disabled');
            $('.uploadFooter').append('<p class="text-danger">You are blocked for 24 hours.</p>')
          }
        } else {
          $('.imgVerBodyText').html(`<span class="text-danger">You upload an invalid Receipt image. <i class="far fa-times-circle text-danger"></i></span>`);
          $('.imgVerBody').append(`<p class="text-danger">You have ${remainingTimes} more times left to try, before you get blocked for 24 hours.</p>`);

          localStorage.setItem('RemainingTimes', remainingTimes)
        }
        // --------------------- Backend Email Validation -------------------------
      } else if($('#databaseSuccess').hasClass('EmailRequired')) {
        $('.imgVerBodyText').html('<span class="text-danger">Email is required.<i class="far fa-times-circle text-danger"></i></span>');
      } else if($('#databaseSuccess').hasClass('InvalidFormat')) {
        $('.imgVerBodyText').html('<span class="text-danger">Please insert a valid Email format.<i class="far fa-times-circle text-danger"></i></span>');
        // ------------------------- Backend File Validation ----------------
      } else if($('#databaseSuccess').hasClass('FileSize')) {
        $('.imgVerBodyText').html('<span class="text-danger">The receipt image must not be greater than 2048 Kb.<i class="far fa-times-circle text-danger"></i></span>');
      } else if($('#databaseSuccess').hasClass('FileError')) {
        $('.imgVerBodyText').html('<span class="text-danger">An error occured.Please try again.<i class="far fa-times-circle text-danger"></i></span>');
      } else if($('#databaseSuccess').hasClass('FormatError')) {
        $('.imgVerBodyText').html('<span class="text-danger">The receipt image must be a file of type: .jpg, .png, .jpeg, .gif<i class="far fa-times-circle text-danger"></i></span>');
      }
    })

  } 
  else if ($('#databaseSuccess').hasClass('Error')) {
    $('.progress-container').css('display', 'none')
    $('.imgVerBodyText').html('<span class="text-danger">OOPS. Something went wrong, please try again. <i class="far fa-times-circle text-danger"></i></span>')
  }

 
})