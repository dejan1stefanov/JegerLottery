import { urlPath } from "../../config/config.js"
import { printAwardedCard, statusIcon, printCard, printRejectedCard, appendAndRemoveCard, appendAndRemoveAllCards, notificationSuccessToast, notificationErrorToast} from './functions.js'
import "./awardPopup.js"
import "./reject.js"
import "./adminNavbar.js"

$(function() {
    let pendingCards = null

    // ================================================ AJAX ===========================================
    // ----------------------------- Ajax get pending Cards to be awarded or rejected ---------------------------
    let url = `${urlPath}/backend/api/Images/read.php`
    $.get(url, function(data) {
        let statusFromAPI = ''
        
        // ---------------------- filter and append the Pending cards --------------
        pendingCards = data.filter(function(card) {
            return card.approval == 'Pending'
        })
        pendingCards.forEach(imageObj => {
            statusFromAPI = statusIcon(imageObj.img_status)            
            $('#pendingCards').append(printCard(imageObj, statusFromAPI))
        });
        // ---------------------- filter and append the Awarded cards --------------
        let awardCards = data.filter(function(card) {
            return card.approval.award
        })
        awardCards.forEach(imageObj => {
            statusFromAPI = statusIcon(imageObj.img_status)            
            $('#awardCards').append(printAwardedCard(imageObj, statusFromAPI))
        });
        // ---------------------- filter and append the Rejected cards --------------
        let rejectCards = data.filter(function(card) {
            return card.approval == 'reject'
        })
        rejectCards.forEach(imageObj => {
            statusFromAPI = statusIcon(imageObj.img_status)            
            $('#rejectCards').append(printRejectedCard(imageObj, statusFromAPI))
        });
            
    

    }).fail(function(err){
        //notification toast
        notificationErrorToast('An error occured. Please reload the page and try again.')
    })

    // ================================= Check Errors from php ========================
    if($('#comunication').hasClass('Error')) {
        //notification toast
        notificationErrorToast('An error occured or maybe the table is empty. Please try to export the file again or check the database.')
    }

// ====================================== event Listeners ===================================
    // --------------------------- show big size image when click on the image card --------------------------
    $(document).on('click', '.card-img-top', function(e) {
        // let imgID = $(this).data('id')
       let srcImage = $(this).attr('src')
       let htmlImg = `<img class="bigSizeImage" src="${srcImage}">`
       $('.imageFrame').html(htmlImg)
       $('#shadowBg').css('display', 'flex')
       $('.imageFrame').css('display', 'flex')
       $('.bigSizeImage').css('display', 'flex')

    })

    // ----------------------------- close big size image when click on the background ------------------
    $('#shadowBg').on('click', function(e) {
        $('#shadowBg').css('display', 'none')
        $('.imageFrame').css('display', 'none')
        $('.bigSizeImage').css('display', 'none')
    })
   
    // -------------------------------------------------- AWARD Button --------------------------------
    $(document).on('click', '.awardBtn', function(e) {
        e.preventDefault();
        let cardID = $(this).data('id')
        let parentCards = $('.parentCard')
        let cardImage = $('.card-img-top')
        for(let i=0; i < cardImage.length; i++) {
            if(cardImage.eq(i).data('id') == cardID) {
                let imageCard = cardImage.eq(i)
                let imgSrc = imageCard.attr('src')
                $('.awardModalImage').html(`<img id="myimage" class="awardedImage w-100 zoomA" src="${imgSrc}" data-id="${cardID}"></img>`)
            }
        }
        
    })

// ------------------------------------------ REJECT Button -------------------------------------
    $(document).on('click', '.rejectBtn', function(e) {
        e.preventDefault();
        let cardID = $(this).data('id')
        let parentCards = $('.parentCard')
       
    //convert the sending data in JSON
        let myJSON = {
            id: cardID,
            approval: "reject"
        }
        let test = JSON.stringify(myJSON);
        
         $.ajax({
            url: `${urlPath}/backend/api/Images/updateReject.php`,
            method: "PUT",
            data: test,
            "Content-type": "application/json",

            success: function(data){      
                appendAndRemoveCard(data, parentCards, cardID, "reject")
                //notification toast
                notificationSuccessToast('The receipt has been rejected')
                
            },
            error: function(err){
                //notification toast
                notificationErrorToast('An error occured. Please try again.')
            }
        })

    })

    // ------------------------------------- Get One Random -------------------------------
    $('.oneRandomBtn').on("click", function(e) {
        let penCard = pendingCards[Math.floor(Math.random()*pendingCards.length)];
        let statusFromAPI = statusIcon(penCard)
        $('#pendingCards').empty()
        $('#pendingCards').append(printCard(penCard, statusFromAPI))
    })

    // ------------------------------------- Reject All Receipts -------------------------------
    $('#rejectAllForSure').on("click", function(e) {
        console.log("rej")
        e.preventDefault();
        let parentCards = $('#pendingCards .parentCard')
          
    //convert the sending data in JSON
        let myJSON = {
            approval: "reject"
        }
        let jsonFormat = JSON.stringify(myJSON);
                
        $.ajax({
            url: `${urlPath}/backend/api/Images/updateAll.php`,
            method: "PUT",
            data: jsonFormat,
            "Content-type": "application/json",
            
            success: function(data){ 
                appendAndRemoveAllCards(data, parentCards, "reject")
                //notification toast
                notificationSuccessToast('All the receipts have been rejected.')
            },
            error: function(err){
                //notification toast
                notificationErrorToast('An error occured. Please try again.')
            }
        })

    })

    // --------------------------------------- Filter cards all, guaranteed, not sure ----------------------------
    $('#filterGuaranted').on("change", function(e) {
        $('#pendingCards').empty()
        console.log($('#filterGuaranted').val())
        if($('#filterGuaranted').val() == "all") {
            pendingCards.forEach(imageObj => {
                let statusFromAPI = statusIcon(imageObj.img_status)            
                $('#pendingCards').append(printCard(imageObj, statusFromAPI))
            });
        } else if($('#filterGuaranted').val() == "guaranted") {
            $('#pendingCards').empty()
            let guarantedCards = pendingCards.filter(function(card) {
                return card.img_status == 1
            })
            guarantedCards.forEach(imageObj => {
                let statusFromAPI = statusIcon(imageObj.img_status)            
                $('#pendingCards').append(printCard(imageObj, statusFromAPI))
            });

        } else if ($('#filterGuaranted').val() == "notSure") {
            $('#pendingCards').empty()
            let notSureCards = pendingCards.filter(function(card) {
                return card.img_status == 2
            })
            notSureCards.forEach(imageObj => {
                let statusFromAPI = statusIcon(imageObj.img_status)            
                $('#pendingCards').append(printCard(imageObj, statusFromAPI))
            });
        }


    }) 
    

})