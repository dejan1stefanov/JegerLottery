// $(function() {
    export function updatedImageValidation() {
        if ($('#file').val().length > 0) {
          let imageSize = ($('#file')[0].files[0].size)
          let failName = $('#file').get(0).files[0].name
      
      // --------------------------------------------- File format validation ------------------------------------
          if(!failName.includes(".png") && !failName.includes(".jpg") && !failName.includes(".jpeg") && !failName.includes(".gif")) {
            $('.uploadArea').css({
              border: "2px dashed #ff1930"
           })
           $('.uploadArea p').css({
             color: "#ff1930"
           })
           $('.errorSuccess').text('The receipt image must be a file of type: .jpg, .png, .jpeg, .gif').css({display: "flex", color: "#ff1930", "font-size": "12px"})
            return false;
          }
      // ------------------------------------------- File Size validation -------------------------------------
          if (imageSize >= 2048000) {
            $('.uploadArea').css({
               border: "2px dashed #ff1930"
            })
            $('.uploadArea p').css({
              color: "#ff1930"
            })
            $('.errorSuccess').text('The receipt image must not be greater than 2048 Kb').css({display: "flex", color: "#ff1930", "font-size": "12px"})
                return false;
          } else {          
              $('.uploadArea').css({
                border: "2px dashed rgb(7, 206, 7)"
              })
              $('.uploadArea p').css({
                color: "rgb(7, 206, 7)"
              })
               $('.errorSuccess').text('The receipt image was uploaded').css({display: "flex", color: "rgb(7, 206, 7)", "font-size": "12px"})
              }
              return true;
        }
      }
  // -------------------------------------- Email validation -------------------------    
    export  function emailValidation() {
        // ----------------------- Valid or invalid classes on email --------------------
        $('#email').removeClass('is-invalid')
        $('#email').removeClass('is-valid')
        $('.valid-feedback').remove()
        $('.invalid-feedback').remove()
      
        let inputVal = $('#email').val();
        let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(!emailReg.test(inputVal)) {
            let invalidHtml = `<div class="invalid-feedback">
                                    Please insert a valid email.
                                </div>`
            $('#email').addClass('is-invalid')
            $('.inputDiv').append(invalidHtml)
            
        } else {
            let validHtml = `<div class="valid-feedback">
                                Looks good!
                            </div>`
            $('#email').addClass('is-valid')
            $('.inputDiv').append(validHtml)
      
            if($('#email').val().length < 1) {
              $('#email').removeClass('is-invalid')
              $('#email').removeClass('is-valid')
              $('.valid-feedback').remove()
              $('.invalid-feedback').remove()
            }
        }
      
        
      }
// ------------------------------- Icon for the status ---------------------------------
    export  function statusIcon(statusFromAPI) {
        if(parseInt(statusFromAPI) == 1) {
            return "guaranteed.png"
        } else {
            return "notSure.png"
        }
    
    }
// ------------------------- Reward Info ---------------------
   export function printRewardInfo(curReward) {
      return `<div>
      <p class="text-center">DESCRIPTION:</p>
      <p class="text-center fontweightBold">${curReward.description}</p>
      <p class="text-center">AVAILABLE:</p>
      <p class="text-center fontweightBold inStock">X ${curReward.availability}</p>
  </div>`

  }
// ---------------------- Get the parametar from URL -------------------  
  export function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;
  
      for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');
  
          if (sParameterName[0] === sParam) {
              return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
          }
      }
      return false;
  };

  export function appendAndRemoveCard(data, parentCards, cardID, cardType) {
      //  Append the card in to the Approved tab 
        data.forEach(imageObj => {
            let statusFromAPI = statusIcon(imageObj.img_status)
            if(cardType == "reject") {           
                $('#rejectCards').append(printRejectedCard(imageObj, statusFromAPI))
            } else if (cardType == "award") {
                $('#awardCards').append(printAwardedCard(imageObj, statusFromAPI))
            } else if (cardType == "Pending") {
                $('#pendingCards').append(printCard(imageObj, statusFromAPI))
            }
        });
        //Remove the rejected card from pending tab
        for(let i = 0 ; i < parentCards.length; i++) {
            if(parentCards.eq(i).data('id') == cardID) {
                let Card = parentCards.eq(i)
                Card.remove()
            }
        }
  }
  export function appendAndRemoveAllCards(data, parentCards, cardType) {
      //  Append the card in to the Approved tab 
        data.forEach(imageObj => {
            let statusFromAPI = statusIcon(imageObj.img_status)
            if(cardType == "reject") {           
                $('#rejectCards').append(printRejectedCard(imageObj, statusFromAPI))
            } else if (cardType == "award") {
                $('#awardCards').append(printAwardedCard(imageObj, statusFromAPI))
            } else if (cardType == "Pending") {
                $('#pendingCards').append(printCard(imageObj, statusFromAPI))
            }
        });
        //Remove the rejected card from pending tab
        for(let i = 0 ; i < parentCards.length; i++) {
                let Card = parentCards.eq(i)
                Card.remove()
        }
  }


//   ====================================== Toast Notification ====================================
    export function notificationSuccessToast(message) {
        let html = `<div id='successToast' class="toast animate__animated animate__fadeInDown" data-delay="3000">
                    <div class="toast-header row">
                    <div class='col-2'>
                        <i class="fas fa-check-square text-success"></i>
                    </div>
                    <div class='col-10 d-flex justify-content-end align-items-center'>
                        <small>2 seconds ago</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </div>
                    <div class="toast-body text-light">
                    ${message}
                    </div>
                </div>`
        $('#successToast').remove()
        $('#errorToast').remove()
        $('#toastDiv').append(html)
        $('#successToast').toast('show')
        $('#successToast').fadeIn(2000)
    }
    export function notificationErrorToast(message) {
        let html = `<div id='errorToast' class="toast animate__animated animate__fadeInDown" data-delay="5000">
                    <div class="toast-header row">
                    <div class='col-2'>
                    <i class="fas fa-times-circle text-danger"></i>
                    </div>
                    <div class='col-10 d-flex justify-content-end align-items-center'>
                        <small>2 seconds ago</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </div>
                    <div class="toast-body text-light">
                    ${message}
                    </div>
                </div>`
        $('#successToast').remove()
        $('#errorToast').remove()
        $('#toastDiv').append(html)
        $('#errorToast').toast('show')
        $('#errorToast').fadeIn(2000)
    }
// ======================================================= CARDS ==============================
    export function printAwardedCard(imageObj, statusFromAPI) {
        return `<div class="col-sm-6 col-lg-4 parentCard" data-id="${imageObj.id}">                                  
                    <div class="card mb-5 shadow">
                        <div class="img-card-parent">
                            <img src="../backend/images/${imageObj.image}" class="card-img-top" data-id="${imageObj.id}">
                            <img src="../assets/img/${statusFromAPI}" class="iconStyle">
                        </div>
                    <div class="card-body px-0 pb-0">
                        <div class="textCard px-3 overflow-auto">                                           
                            <h6 class="card-title">${imageObj.email}</h6>
                            <p>Rewarded by <span class="text-danger">${imageObj.approval.award.admin}</span></p>
                            <div class="row">
                                <div class="col-6">
                                    <img src="../assets/img/award_Images/${imageObj.approval.award.img_name}" class="w-100">
                                </div>
                                <div class="col-6">
                                    <p>${imageObj.approval.award.name}</p>
                                </div>
                            </div>
                            <p>Receipt text:</p>
                            <p class="card-text font13px">${imageObj.text}</p>                                            
                        </div>
                        <div class="timeOfUpdateing d-flex justify-content-center p-2 border-top border-bottom bg-light">
                            <span class="font13px">${imageObj.updatedTime}</span>
                        </div>
                    </div>
                    </div>                                   
                </div>`
    }

   export function printCard(imageObj, statusFromAPI) {
      return `<div class="col-sm-6 col-lg-4 parentCard" data-id="${imageObj.id}">                                  
                  <div class="card mb-5 shadow">
                      <div class="img-card-parent">
                          <img src="../backend/images/${imageObj.image}" class="card-img-top" data-id="${imageObj.id}">
                          <img src="../assets/img/${statusFromAPI}" class="iconStyle">
                      </div>
                  <div class="card-body px-0 pb-0">
                      <div class="textCard px-3 overflow-auto">                                           
                          <h6 class="card-title">${imageObj.email}</h6>
                          <p>Receipt text:</p>
                          <p class="card-text font13px">${imageObj.text}</p>                                            
                      </div>
                      <div class="timeOfUpdateing d-flex justify-content-center p-2 border-top border-bottom bg-light">
                          <span class="font13px">${imageObj.updatedTime}</span>
                      </div>
                      <div class="cardButtons d-flex justify-content-around py-2 bg-light">
                          <button class="btn btn-success btn-sm awardBtn" data-id="${imageObj.id}" data-toggle="modal" data-target="#awardModal">Award</button>
                          <button class="btn btn-danger btn-sm rejectBtn" data-id="${imageObj.id}">Reject</button>
                      </div>
                  </div>
                  </div>                                   
              </div>`
  }
   export function printRejectedCard(imageObj, statusFromAPI) {
      return `<div class="col-sm-6 col-lg-4 parentCard" data-id="${imageObj.id}">                                  
                <div class="card mb-5 shadow">
                    <div class="img-card-parent">
                        <img src="../backend/images/${imageObj.image}" class="card-img-top" data-id="${imageObj.id}">
                        <img src="../assets/img/${statusFromAPI}" class="iconStyle">
                    </div>
                <div class="card-body px-0 pb-0">
                    <div class="textCard px-3 overflow-auto">                                           
                        <h6 class="card-title">${imageObj.email}</h6>
                        <p>Receipt text:</p>
                        <p class="card-text font13px">${imageObj.text}</p>                                            
                    </div>
                    <div class="timeOfUpdateing d-flex justify-content-center p-2 border-top border-bottom bg-light">
                        <span class="font13px">${imageObj.updatedTime}</span>
                    </div>
                    <div class="cardButtons d-flex justify-content-around py-2 bg-light">
                        <button class="btn btn-primary btn-sm restoreBtn" data-id="${imageObj.id}" >Restore</button>
                        <button class="btn btn-danger btn-sm deletePerBtn" data-id="${imageObj.id}" data-toggle="modal" data-target="#deletePermanentModal">Delete Permanently</button>
                    </div>
                </div>
                </div>                                   
            </div>`
  }

      
// })