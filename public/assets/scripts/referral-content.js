function showReferralContent(referralHash, referrals, referral){
    // Afficher le contenu de la référence
    $(".referral-content").show(); 
    $('.referral-content').css('display', 'flex');
    $('.referral-content').addClass("show");

    // On récupère le hashage de la référence
    $('.referral-content').attr("id", "referral-content-" + referralHash);

    // Si la référence n'est pas validée, on cache les options
    if (referral["validated"] === false){
        $(".option-send-to-consultant").hide(); 
        $(".option-export-to-pdf").hide(); 
        $(".option-export-to-html").hide(); 
    } 
    // Si la référence est validée, on affiche les options que peut faire l'utilisateur
    else if (referral["validated"] === true){
        $(".option-send-to-consultant").show(); 
        $(".option-export-to-pdf").show(); 
        $(".option-export-to-html").show(); 
    }
    
    $("#referral-text").text(referral.commitment);

    // Remplie le contenu de la référence à partir du formulaire
    fillFormFromData("juniors-referral-form", referral);

    $("#referral-duration").text(referral.duration);

    $("#referral-environment").text(referral.environment);

    getProfilPicture("juniors", referral.juniorMail)
    .then(function(response){
        $("#referral-content-profil-picture").attr('src', response);
    });
    
    // Afficher les informations du Jeune qui a envoyé la référence
    $("#referral-content-header-sender-name").text(referral.juniorName + " " + referral.juniorFirstName);
    $("#referral-content-header-sender-name").addClass("juniors-color");
    $("#referral-content-header-sender-mail").text("<" + referral.juniorMail + ">");

    // Afficher les informations du Référent qui a reçu la référence
    $("#referral-content-header-referent-name").text(referral.referentName + " " + referral.referentFirstName)
    $("#referral-content-header-referent-mail").text("<" + referral.referentMail + ">");
    
    if (jQuery.inArray(referralHash, referrals["referralsSended"]) !== -1){
        $("#referral-content-header-receiver-name").text(referral.referentName + " " + referral.referentFirstName);
        $("#referral-content-header-receiver-name").addClass("referents-color");
    }
    // Changer le texte de celui qui à reçu la référence
    else if (jQuery.inArray(referralHash, referrals["referralsReceived"]) !== -1){
        $("#referral-content-header-receiver-name").text("moi");
        $("#referral-content-header-receiver-name").addClass("user-color");
    }

    // Afficher le button pour valider la référence
    if (jQuery.inArray(referralHash, referrals["referralsValidated"]) !== -1){
        $("#referral-validation-button").hide();
    } else{
        $("#referral-validation-button").show();
    }
}