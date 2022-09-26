import {emailValidation } from './functions.js'
$(function() {

    // ============================= Email Validation EventListener =======================================
  $('#email').keyup(function() {
    emailValidation()
    $('.emptyEmail').remove()
    });

// ================================= Submit Form eventListener ================================
    $('#formUpdate').on("submit", function(e) {
        e.preventDefault();
        $('.noFileError').html('')
        $('.emptyEmail').remove()
        
        if($('#email').val().length < 1) {
          $('.inputDiv').append('<span class="emptyEmail emptyEmailError text-danger">Please insert your email.</span>')
          return;
        } else if ($('#email').hasClass('is-invalid')) {
          return;
        } else if($('#password').val().length < 1) {
          return;
        } else {
          $(this).off('submit').submit();
        }
              
      })
})