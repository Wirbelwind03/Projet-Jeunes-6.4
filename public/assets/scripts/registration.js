function checkFormData(step) 
{
    var isValid = true;

    $("input").css("color", ""); // On remet à la couleur de défaut
    $('.error-text').remove(); // On enlève tous les message d'erreur
        
    var fieldsToValidate = [
        { name: 'name', id: "name"},
        { name: 'firstName', id: "firstname"},
        { name: 'birthDate', id: "birthdate"},
        { name: 'mail', id: "mail"},
        { name: 'password', id: "password"},
        { name: 'confirmPassword', id: "confirm-password"}
    ];
    
    switch (step){
      case 0:
        $.each(fieldsToValidate, function(index, field) {
          var field = fieldsToValidate[index];
          var value = getFieldIDValue(field.id);
          
          // Affiche les messages d'erreur pour les saisies
          switch (field.name) {
              case "name":
              case "firstName":
                if (value === '') {
                  createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                  isValid = false;
                }
                else if (!/^[a-zA-Z]+$/.test(value)) {
                  createErrorMessageBox("Cette valeur ne doit contenir que des lettres.", field.id);
                  isValid = false;
                }
                break;

              case "birthDate":
                var date = new Date(value);
                if (value === '') {
                  createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                  isValid = false;
                } else if (getAge(date) < 16){
                  createErrorMessageBox("Vous devez avoir plus de 16 ans", field.id);
                  isValid = false;
                } else if (getAge(date) > 30){
                  createErrorMessageBox("Vous devez avoir moins de 30 ans", field.id);
                  isValid = false;
                }
                break;
          
              case "mail":
                if (value === '') {
                  createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                  isValid = false;
                }
                else if (!/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(value)) {
                  createErrorMessageBox("Veuillez entrer une adresse e-mail valide.", field.id);
                  isValid = false;
                }
                break;
          
              case "confirmPassword":
                if (value === '') {
                  createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                  isValid = false;
                }
                else if (getFieldIDValue("password") !== value) {
                  createErrorMessageBox("Le mot de passe n'est pas le même.", field.id);
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
        break;
      case 1:
        isValid = checkNumberOfSelectedCheckBoxes("myform", 4);
        break;
      default:
        break;
    }
    
    return isValid;
}

// Envoie le formulaire
function submitFormData()
{
  $("#ask-account-exist-message").hide();
  $("#registration-end-message").show();
  makeAjaxRequestPromise('/../../src/libs/registration.php', 'POST', $('#myform').serialize())
  .then(function(response){
    switch(response){
      case "2":
        createErrorMessageBox("L'email est déjà pris", "mail");
        throw new Error("L'email est déjà pris");
      case "1":
        throw new Error(response);
      default:
        window.location.href = 'home.php';
        break;
    }
  })
  .catch(function(error){
    console.log(error); 
 });
}