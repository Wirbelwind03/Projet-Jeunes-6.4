$(document).ready(function() 
{
    $('#send-button').click(function() {
        if (checkFormData()){
            submitFormData();
        }
    });

    function checkFormData() 
    {
      $("input").css("color", ""); // On remet à la couleur de défaut
      $('.error-text').remove(); // On enlève tous les message d'erreur

      var fieldsToValidate = [
          { name: 'referentName', id: "referent-name"},
          { name: 'referentFirstName', id: "referent-first-name"},
          { name: 'referentMail', id: "referent-mail"},
          { name: 'commitment', id: "commitment"},
          { name: 'duration', id: "duration"},
          { name: 'environment', id: "environment"},
      ];

      isValid = validateFields(fieldsToValidate);

      isValid = checkNumberOfSelectedCheckBoxes("referral-request-form", 4);
      if (!isValid){
        $("#juniors-skills-tab-text").css("color", "red");
      }

      return isValid;
    }

    function validateFields(fieldsToValidate)
    {
      isValid = true;

      $.each(fieldsToValidate, function(index, field) {
        var field = fieldsToValidate[index];
        var value = getFieldIDValue(field.id);
        
      
        // Affiche les messages d'erreur pour les saisies
        switch (field.name) {        
            case "referentMail":
              if (value === '') {
                createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                isValid = false;
              }
              else if (!/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(value)) {
                createErrorMessageBox("Veuillez entrer une adresse e-mail valide.", field.id);
                isValid = false;
              }
              break;        
            default:
              if (value === '') {
                createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                isValid = false;
              }
          }
      });

      return isValid;
    }

    function submitFormData()
    {
      $("#send-button").hide();
      $("#send-loader").show();
      
      // On regarde si le référent est enregistré dans la base de données 
      makeAjaxRequestPromise("/../../src/libs/referral-request.php", "POST", $('#referral-request-form').serialize())
      .then(function(response){
        if (response !== 'failed'){
          $("#send-loader").hide();
          window.location.href = 'profil.php';
        }
        else{
          $("#send-button").show();
          $("#send-loader").hide();
          throw new Error(response);
        }
      })
      .catch(function(error){
        console.error(error);
      });
    }
});