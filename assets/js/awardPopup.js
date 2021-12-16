import { urlPath } from "../../config/config.js"
import { printAwardedCard, statusIcon, printRewardInfo, getUrlParameter, appendAndRemoveCard, notificationSuccessToast, notificationErrorToast} from './functions.js'
$(function() {
    //the choosen reward ID
    let choosenRewardItemID = ""
    // ---------------------- Ajax get reward images and info ------------------------
let urlReward = `${urlPath}/backend/api/Reward/read.php`
$.get(urlReward, function(data) {
   
//    -------------- append option tags to the reward input ------------
    data.forEach(rewardObj => {
        let html = `<option value="${rewardObj.id}">${rewardObj.description}</option>`
        $('.selectReward').append(html)
        $('.awardParticipant').removeAttr('disabled');
         //selected value
         let value = $('.selectReward').val()
         //find the selected reward item
         let curReward = data.find(function(reward) {
             return reward.id == value
         })
         //set the id of the choosen reward item
         choosenRewardItemID = parseInt(curReward.id)
         //append the reward image
         $('.rewardImage').html(`<img class="w-100" src="../assets/img/award_Images/${curReward.img_name}">`)
         //append the reward info
         $('.rewardInfo').html(printRewardInfo(curReward))
         // if the reward is out of stock  
         if(curReward.availability == 0) {
            $('.inStock').html('<p class="text-danger">Out of Stock</p>')
            $('.awardParticipant').prop('disabled', true);
        } 
    });
// ------------------------------ Select option reward ----------------------------
    $('.selectReward').on('change', function(e) {
        $('.awardParticipant').removeAttr('disabled');
        //selected value
        let value = $('.selectReward').val()
        //find the selected reward item
        let curReward = data.find(function(reward) {
            return reward.id == value
        })
        //set the id of the choosen reward item
        choosenRewardItemID = parseInt(curReward.id)
        //append the reward image
        $('.rewardImage').html(`<img class="w-100" src="../assets/img/award_Images/${curReward.img_name}">`)
        //append the reward info
        $('.rewardInfo').html(printRewardInfo(curReward))
        // if the reward is out of stock   
        if(curReward.availability == 0) {
            $('.inStock').html('<p class="text-danger">Out of Stock</p>')
            $('.awardParticipant').prop('disabled', true);
        } 

    })

}).fail(function(err){
    //notification toast
    notificationErrorToast('An error occured. Please try again.')
})

 // -------------------------------------------------- AWARD Button --------------------------------
 $(document).on('click', '.awardParticipant', function(e) {
    e.preventDefault();
    let participantID = parseInt($('.awardedImage').data('id'))
    if(choosenRewardItemID) {

        // get the admin id
        // let adminID = parseInt(getUrlParameter('id'))
        let adminID = parseInt($('#adminID').data('admin'))

        //convert the sending data in JSON
        let myJSON = {
            id: participantID,
            approval: "award",
            images_id: participantID,
            admin_id: adminID,
            reward_id: choosenRewardItemID,
        }
        let test = JSON.stringify(myJSON);
        
        //ajax call to create new row in rewarded_images
         $.ajax({
        url: `${urlPath}/backend/api/Images/updateCreateAward.php`,
        method: "PUT",
        data: test,
        "Content-type": "application/json",

        success: function(data){
            //If succeed new ajax call to send email
        
                let parentCards = $('.parentCard')
                appendAndRemoveCard(data, parentCards, participantID, "award")
                //get email from the awarded Person
                let participantEmail = ""
                let participantAwardName = ""
                let participantAwardImg = ""
                data.forEach(imageObj => {
                    participantEmail = imageObj.email
                    participantAwardName = imageObj.approval.award.name
                });
                // make json format
                let myJSON = {
                    email: participantEmail,
                    award: participantAwardName
                }
                let jsonFormat = JSON.stringify(myJSON);
                    
            $.ajax({
                url: `${urlPath}/backend/api/Images/sendEmail.php`,
                method: "POST",
                data: jsonFormat,
                "Content-type": "application/json",
        
                success: function(data){
                    //notification toast
                    notificationSuccessToast('The rewarding was successful. An email was send to the particpant.')
                },
                error: function(err){
                    //notification toast
                    notificationErrorToast('We failed to send email to the participant. Please do it manualy.')
                }
            })
        },
        error: function(err){
            //notification toast
            notificationErrorToast('An error occured and we could not award the participant. Please try again.')
        }
    })
 
    } else {
        return;
    }

})

})