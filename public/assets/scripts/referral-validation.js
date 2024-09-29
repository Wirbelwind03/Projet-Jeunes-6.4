$(document).ready(function() 
{    
    $('.exit-button').click(function() {
        document.getElementById('referral-validation-form').reset();
        $('#overlay').hide();
        $('.referral-validation').hide();
    });

    $('#referral-validation-button').click(function() {
        $('#overlay').show();
        $('.referral-validation').show();
        var referralHash = $('.referral-content').attr('id').replace('referral-content-', '');
        makeAjaxRequestPromise('/../../src/libs/get-user-referrals.php', "POST")
        .then(function(response)
        {
            if (response !== "failed"){
                const jsonReferrals = JSON.parse(response);
                var referral = jsonReferrals["referralsAll"][referralHash];
                fillFormFromData("referral-validation-form", referral);
            }
            else {
                throw new Error(response);
            }
        })
        .catch(function(error){
            console.log(error)
        });
    });
});

function checkFormData(step) 
{
    var isValid = true;

    $("input").css("color", ""); // On remet à la couleur de défaut
    $('.error-text').remove(); // On enlève tous les message d'erreur

    switch (step)
    {
        case 2:
            isValid = checkNumberOfSelectedCheckBoxes("referral-validation-form", 4);
            $(".error-text").css("display", "block");
            break
        default:
            break;
    }
    
    
    return isValid;
}

function submitFormData()
{
    $("#referral-validated-message").show();
    var referralHash = $('.referral-content').attr('id').replace('referral-content-', '');
    makeAjaxRequestPromise('/../../src/libs/referral-validation.php', "POST", $('#referral-validation-form').serialize() + "&referralHash=" + referralHash)
    .then(function(response)
    {
        if (response !== "failed"){
            $('#overlay').hide();
            $('.referral-validation').hide();
            $("#referral-validated-message").hide();
            $("#referral-validation-button").hide();
            document.getElementById('referral-validation-form').reset();
        }
        else {
            $('#overlay').hide();
            $('.referral-validation').hide();
            $("#referral-validated-message").hide();
            throw new Error(response);
        }
    })
    .catch(function(error){
       console.log(error); 
    });
}