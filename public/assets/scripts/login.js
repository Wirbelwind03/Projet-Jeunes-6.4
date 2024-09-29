$(document).ready(function() 
{
    var userType = $(".login-container").attr('id');

    // Evénement pour le button pour se connecter
    // Essaie de faire connecter l'utilisateur
    $('#login-button').click(function() 
    {
        if (checkFormData()){
          submitFormData();
        }
    });

    // Vérifie si le formulaire est bien remplie
    function checkFormData() 
    {
      $("input").css("color", ""); // On remet à la couleur de défaut
      $('.error-text').remove(); // On enlève tous les message d'erreur

      // Les champs a validée
      var fieldsToValidate = [
          { name: 'mail', id: "mail"},
          { name: 'password', id: "password"}
      ];

      isValid = validateFields(fieldsToValidate);

      // On retoure si ce formulaire est valide
      return isValid;
    }

    // Regarde si chaque champ est valide
    // fieldsToValidate : Les champs a validée
    function validateFields(fieldsToValidate){
      isValid = true;

      $.each(fieldsToValidate, function(index, field) {
        var field = fieldsToValidate[index];
        var value = getFieldIDValue(field.id);
        
        // Affiche les messages d'erreur pour les saisies
        switch (field.name) {        
            case "mail":
              // Si le champ pour le mail est vide
              if (value === '') {
                createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                isValid = false;
              }
              // Si l'utilisateur a rentrée un mauvais email
              else if (!/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(value)) {
                createErrorMessageBox("Veuillez entrer une adresse e-mail valide.", field.id);
                isValid = false;
              }
              break;        
            default:
              // Si le champs est vide
              if (value === '') {
                createErrorMessageBox("Cette valeur ne doit pas être vide.", field.id);
                isValid = false;
              }
          }
      });

      // On retoure si ce formulaire est valide
      return isValid;
    }

    function submitFormData()
    {
      // On cache le button pour se connecter
      $('#login-button').css('display', 'none');
      // On affiche la barre de chargement pour se connecter
      $('.loader').css('display', 'block');
      
      // On regarde si l'utilisateur est enregistré dans la base de données
      makeAjaxRequestPromise("/../../src/libs/get-user.php", "POST", {userMail: getFieldIDValue("mail"), userType: userType})
      .then(function(response)
      {
        if (response !== "failed"){
          // On fait connecter l'utilsateur
          return makeAjaxRequestPromise("/../../src/libs/login.php", "POST", $('#myform').serialize() + "&userType=" + userType);
        } 
        // Si le compte n'existe pas dans le fichier JSON
        else {
          $('.loader').css('display', 'none'); // Cacher le chargement
          $('#login-button').css('display', 'block'); // Afficher le button pour se connecter
          createErrorMessageBox("Erreur lors de l'authentification.", "login-button", false);
          throw new Error("Le compte n'existe pas");
        }
      })
      .then(function(response)
      {
        // Cacher le chargement
        $('.loader').css('display', 'none'); 
        
        if (response !== "failed"){
          window.location.href = 'home.php';
        }
        // Si l'utilisateur a rentré le mauvais mot de passe
        else
        {
          $('#login-button').css('display', 'block');
          createErrorMessageBox("Erreur lors de l'authentification.", "login-button", false);
          throw new Error("Erreur d'authentification");
        }
      })
      .catch(function(error) {
        console.log(error);
      });
    }
});