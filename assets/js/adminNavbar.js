import { urlPath } from "../../config/config.js"
$(function() {
// ============================== Ajax call for admin username ============================
    let adminID = $('#adminID').data('admin')
    //convert the sending data in JSON
    let myJSON = {
        id: adminID
    }
    let jsonFormat = JSON.stringify(myJSON);
    $.ajax({
        url: `${urlPath}/backend/api/Admin/read.php`,
        method: "POST",
        data: jsonFormat,
        "Content-type": "application/json",
        
        success: function(data){
                $('.adminName').html(`<b>${data}</b>`)
        },
        error: function(err){
            console.log("ova e err", err)
        }
    })

// ======================= Click on the name and icon =======================
    $('.iconNamePar').on("click", function(e) {
        $('.adminDropdown').css('display', 'flex').addClass('show')
    })
// =========================== Close the Dropdown ===========================
    $('#mainSection').on('click', function(e) {
        if($('.adminDropdown').hasClass('show')) {
            $('.adminDropdown').css('display', 'none')
            $('.adminDropdown').removeClass('show')
        }
    })
    
// =============================== Log Out ==========================
    $('#logout').on('click', function(e) {
        //show white bg
        $('#shadowBg').css({
            'display': 'flex',
            'background-color': 'white'
        })
        //show spinner
        $('.spinner').css('display', 'flex')
        //relocation to logout page
        window.location = `${urlPath}/admin/Logout.php`;

    })


})
