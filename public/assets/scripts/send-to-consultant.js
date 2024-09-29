$(document).ready(function() 
{
    $('#send-to-consultant-button').click(function() 
    {
      if (checkFormData()){
          submitFormData();
      }
    });

    // Regarde si le formulaire est bien remplie
    function checkFormData() 
    {
      $("input").css("color", ""); // On remet à la couleur de défaut
      $('.error-text').remove(); // On enlève tous les message d'erreur

      var fieldsToValidate = [
        { name: 'consultantName', id: "consultant-name"},
        { name: 'consultantFirstName', id: "consultant-first-name"},
        { name: 'consultantMail', id: "consultant-mail"},
      ];

      return validateFields(fieldsToValidate);
    }

    // Valide les champs du formulaire
    function validateFields(fieldsToValidate){
      isValid = true;
      

      $.each(fieldsToValidate, function(index, field) {
        var field = fieldsToValidate[index];
        var value = getFieldIDValue(field.id);
        
        // Affiche les messages d'erreur pour les saisies
        switch (field.name) {
            case "consultantName":
            case "consultantFirstName":
                if (value === '') {
                  createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                  isValid = false;
                }
                else if (!/^[a-zA-Z]+$/.test(value)) {
                  createErrorMessageBox("Cette valeur ne doit contenir que des lettres.", field.id);
                  isValid = false;
                }
                break;
            case "consultantMail":
              if (value === '') {
                console.log("test");
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

    // Envoie le formulaire
    function submitFormData()
    {   
      $("#send-to-consultant-button-loader").show();
      $("#send-to-consultant-button").hide();
      var referralHash = $('.referral-content').attr('id').replace('referral-content-', '');
      makeAjaxRequestPromise('/../../src/libs/send-to-consultant.php', 'POST', $("#send-to-consultant-form").serialize() + "&referralHash=" + referralHash)
      .then(function(response)
      {
        switch(response){
          case "failed":
            $("#send-to-consultant-button-loader").hide();
            $("#send-to-consultant-button").show();
            throw new Error(response);
          default:
            $("#send-to-consultant-button-loader").hide();
            $("#overlay").hide();
            $('.send-to-consultant-form-container').hide();
            $("#send-to-consultant-button").show();
            break;
        }
      })
      .catch(function(error){
        console.log(error); 
     });
    }
});