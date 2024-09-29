$(document).ready(function() 
{
    // Evénement pour l'option "Voir le profil"
    $('.option-see-profil').click(function() 
    {
      // Affiche le barre de chargement ainsi que le fond noir
      $("#overlay").show();
      $("#wrap-loader").show();

      // Récupère le type d'utilisateur
      userType = $(this).attr("id").split("-")[0];
      
      makeAjaxRequestPromise('/../../src/libs/get-user-referrals.php', "POST")
      .then(function(response) 
      {
        if (response !== "failed"){
          const jsonReferrals = JSON.parse(response);
          var referralHash = $('.referral-content').attr('id').replace('referral-content-', '');
          var referral = jsonReferrals["referralsAll"][referralHash];
          // Récupère le mail de l'utilisateur
          switch (userType) 
          {
            // Récupère l'email du Jeune en prenant la clé "juniorMail"
            case "juniors":
              userMail = referral["juniorMail"];
              break;
            
            // Récupère l'email du Référent en prenant la clé "referentMail"
            case "referents":
              userMail = referral["referentMail"];
              break;
            
            default:
              break;
          }
          return makeAjaxRequestPromise('/../../src/libs/get-user.php', "POST", {userMail: userMail, userType: userType});
        } 
        else {
          throw new Error(response);
        }
      })
      .then(function(response) 
      {
        if (response !== "failed")
        {
          // Affiche les informations de l'utilisateur
          const jsonUser = JSON.parse(response);

          getProfilPicture(userType, jsonUser["mail"])
          .then(function(response){
            $(".profil-card-profil-picture").attr('src', response);
          });
        
          showField(jsonUser, "name", "profil-card-name");
          showField(jsonUser, "firstname", "profil-card-first-name");
          showField(jsonUser, "birthDate", "profil-card-birth-date");
          showField(jsonUser, "mail", "profil-card-mail");
          showField(jsonUser, "socialMedias", "profil-card-social-medias");
  
          switch (userType) 
          {
            case "juniors":
              $('.user-type-color').css('color', "#fb3199");
              $('.user-type-border-color').css('border-color', "#AE035B");
              break;
            
            case "referents":
              $('.user-type-color').css('color', "#36b64b");
              $('.user-type-border-color').css('border-color', "#36b64b");
              break;
            
            default:
              break;
          }
            
          $('.profil-card-container').show();
          $('.profil-card-container').css("display", "flex");
  
          $("#wrap-loader").hide();
        }
        else {
          throw new Error(response);
        }
      })
      .catch(function(error){
        console.error(error);
      });
    });

    // Evénément lorsque l'utilisateur sort du formulaire
    $('.profil-card-container .exit-button').click(function() {
      $('#overlay').hide();
      $('.profil-card-container').hide();
    });

    function showField(jsonData, value, className)
    {
        if (jsonData.hasOwnProperty(value))
        {
            if (jsonData[value] != ""){
                $("." + className).text(jsonData[value]);
                return;
            }
        }
        $("." + className).text("Aucun");
        $("." + className).css("color", "gray");
        $("." + className).css("font-weight", "normal");
        $("." + className).css("font-style", "italic");
    }
});

