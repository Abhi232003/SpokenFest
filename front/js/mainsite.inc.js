var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-])+\.([A-Za-z]{2,4})$/;
var password = /^(?=.\d)(?=.[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/;
var alpha_regrex = /^[A-Za-z ]+$/;
var alpha_regrex2 = /^[a-zA-Z'-`’]+$/;
var regex = /^[0-9]+$/;
$(document).ready(function () {
    $('#submitPartnerWithForm').click(function () {
        var PartnerWith_flag = 0;
        var partnerName = $("#partnerName").val();
        var partnerEmail = $("#partnerEmail").val();
        var partnerPhone = $("#partnerPhone").val();
        var partnerType = $("#partnerType").val();
        if (partnerName == "") {
        $("#partnerName_validate").html('Please enter name.');
        PartnerWith_flag = PartnerWith_flag +1;
        } else if (!alpha_regrex.test(partnerName)) {
            $("#partnerName_validate").html('Name field contains only alphabet.');
            PartnerWith_flag = PartnerWith_flag +1;
        } else {
            PartnerWith_flag = 0;
        }
        if (partnerEmail == "" && pattern.test(partnerEmail) == false) {
            $("#partnerEmail_validate").html('Please enter email.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else {
            $("#partnerEmail_validate").html("");
            PartnerWith_flag = 0;
        }
        if (partnerPhone == "") {
            $("#partnerPhone_validate").html('Please enter mobile no.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else if (!regex.test(partnerPhone)) {
            $("#partnerPhone_validate").html('Please enter valid mobile no.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else if (partnerPhone.length !== 10) { // Check the length of partnerPhone
            $("#partnerPhone_validate").html('Please enter valid mobile no.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else {
            PartnerWith_flag = 0;
        }
        if (partnerType == 0) {
            $("#partnerType_validate").html('Please select your partner.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else {
            $("#partnerType_validate").html("");
            PartnerWith_flag = 0;
        }
        if (partnerComment == "") {
            $("#partnerComment_validate").html('Please enter comment.');
            PartnerWith_flag = PartnerWith_flag + 1;
        } else {
            $("#partnerComment_validate").html("");
            PartnerWith_flag = 0;
        }
        if (PartnerWith_flag == 0) {
            if (alpha_regrex.test(partnerName) == true && partnerPhone != ''  && partnerComment !='' && partnerType != ''  && partnerEmail != '' && pattern.test(partnerEmail) == true) {
                var form = $('#partnerWithForm')[0];
                var formData = new FormData(form);
                $.ajax({
                    url: base_url + 'home/partnerForm',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == "ok") {
                            $('.mfp-close').trigger('click');
                            $.magnificPopup.open({
                                items: {
                                  src: '#partner-thankyou'
                                },
                                type: 'inline',
                                enableEscapeKey: false,
                                closeOnBgClick: false
                              });
                            $("#partnerWithForm").trigger("reset");
                            }else if(data.success=="emailMatch"){
                                $("#partnerEmail").focus();
                                $("#partnerEmail").val('');
                                $(".EmailExist_validate").html("The email already exist field must contain a unique value.");
                                $(".EmailExist_validate").show();
                                $(".EmailExist_validate").delay(2000).fadeOut();
                            }else if(data.success=="mobileMatch"){
                                $("#mobileNumber").focus();
                                $("#mobileNumber").val('');
                                $(".mobileExist_validate").html("The mobile number already exist.");
                                $(".mobileExist_validate").show();
                                $(".mobileExist_validate").delay(2000).fadeOut();
                            } else {
                                $("#partnerSuccessMSG").css({ "color": "red", "font-size": "15px", "font-weight": "800", "margin-top": "10px", "text-align": "center" });
                                $("#partnerSuccessMSG").html("Something went wrong ,please try again!");
                                $("#partnerSuccessMSG").show();
                                $("#partnerSuccessMSG").delay(5000).fadeOut();
                        }
                    }
                });
            }
        }
    });
    $("#partnerName").keyup(function () {
        var partner_Name = $("#partnerName").val();
        if (partner_Name == "") {
            $("#partnerName_validate").html('Please enter full name.');
        } else {
            $("#partnerName_validate").html('');
        }
    });
    $("#partnerEmail").keyup(function () {
        var Email = $("#partnerEmail").val();
        if (Email == "") {
            $("#partnerEmail_validate").html('Please enter email.');
        } else if (pattern.test(Email) == false) {
            $("#partnerEmail_validate").html('Please enter valid email.');
            PartnerWith_flag = 0;
        } else {
            $("#partnerEmail_validate").html('');
        }
    });
    $("#partnerPhone").keyup(function () {
        var user_Mobile = $("#partnerPhone").val();
        if (user_Mobile == "") {
            $("#partnerPhone_validate").html('Please enter mobile no.');
            PartnerWith_flag = 0;
        }
        else if (user_Mobile.password <= 8 && user_Mobile.password >= 12) {
            $("#partnerPhone_validate").html('Please enter valid mobile no..');
            PartnerWith_flag = 0;
        }
        else if (user_Mobile != "") {
            $("#partnerPhone_validate").html('');
        } else {
            $("#partnerPhone_validate").html('');
        }
    });
})










$( '.numberOnly' ).keypress( function ( e ) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if ( unicode != 8 ) { 
      if ( unicode < 48 || unicode > 57 ){ 
         return false 
      }
    }
 });
  $(document).on('keypress', '.SpaceNot', function(e) {
     if (e.keyCode == 32) return false;
 });
$(document).on('keyup blur', '.textalpha', function () {
    var node = $(this);
    var varID = $(this).attr('id');
    $('#' + varID).val($('#' + varID).val().replace(/[^A-Za-z_\s]/, ''), function (str) {
        return '';
    });
});
$(document).on('keydown', '.textalpha', function (event) {
    var keyCode = event.keyCode || event.which;
    if (!((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 32 || keyCode === 95)) {
        event.preventDefault();
    }
});