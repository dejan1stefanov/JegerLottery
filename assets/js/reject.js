import { urlPath } from "../../config/config.js"
import { appendAndRemoveCard, notificationSuccessToast, notificationErrorToast} from './functions.js'

$(function () {
// ================================================ Restore rejected card =============================
    $(document).on('click', '.restoreBtn', function(e) {
        e.preventDefault();
        let cardID = $(this).data('id')
        let parentCards = $('.parentCard')
        let successfulUpdate = false
    //convert the sending data in JSON
        let myJSON = {
            id: cardID,
            approval: "Pending"
        }
        let test = JSON.stringify(myJSON);
        
         $.ajax({
        url: `${urlPath}/backend/api/Images/updateReject.php`,
        method: "PUT",
        data: test,
        "Content-type": "application/json",

        success: function(data){
            appendAndRemoveCard(data, parentCards, cardID, "Pending")
            successfulUpdate = true   

        },
        error: function(err){
            //notification toast
            notificationErrorToast('An error occured. Please try again.')
        }
    })
})

    // ============================================ Permanent Delete ======================================
    let deletedCardID = ""
    // ---------------- Delete Permanent Button -------------------
    $(document).on('click', '.deletePerBtn', function(e) {
        deletedCardID = $(this).data('id')
    })
    // ---------------- Delete Permanent Button Popup -------------------
    $('#deleteForSure').on('click', function(e) {
        e.preventDefault();
        let parentCards = $('.parentCard')
    //convert the sending data in JSON
        let myJSON = {
            id: deletedCardID,
        }
        let test = JSON.stringify(myJSON);
        
         $.ajax({
            url: `${urlPath}/backend/api/Images/delete.php`,
            method: "DELETE",
            data: test,
            "Content-type": "application/json",

            success: function(data){
                //Remove the deleted cards
                for(let i = 0 ; i < parentCards.length; i++) {
                    if(parentCards.eq(i).data('id') == deletedCardID) {
                        let Card = parentCards.eq(i)
                        Card.remove()
                    }
                }
                //notification toast
                notificationSuccessToast('The receipt has been deleted.')
            },
            error: function(err){
                //notification toast
                notificationErrorToast('The receipt could not be deleted. Please try again.')
            }
        })

    })

    // =============================================== Delete All Rejected Confirm ============================

    $('#deleteAllForSure').on('click', function(e) {
        console.log('delete')
        let parentCards = $('.parentCard')
        $.ajax({
            url: `${urlPath}/backend/api/Images/deleteAllRejected.php`,
            method: "DELETE",
            "Content-type": "application/json",

            success: function(data){
                //Remove the deleted cards
                $('#rejectCards').empty()
                //notification toast
                notificationSuccessToast('All the receipts have been deleted.')
            },
            error: function(err){
                //notification toast
                notificationErrorToast('An error occured. Please try again.')
            }
        })

    })

})
