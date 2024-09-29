$(document).ready(function() 
{
    makeAjaxRequestPromise("/../../src/libs/get-user.php", 'GET')
    .then(function(response)
    {
        if (response !== "failed") {
            const userJsonData = JSON.parse(response);
            fillFormFromData("settings-form", userJsonData);
        }
        else {
            throw new Error(response);
        }
    })
    .catch(function(error){
        console.log(error); 
     });

    $('#save-settings').click(function() 
    { 
        $("input").css("color", ""); // On remet à la couleur de défaut
        $('.error-text').remove(); // On enlève tous les message d'erreur

        if (checkFormData()){    
            submitFormData();        
        }
    })

    // Evénément pour le button pour changer de photo de profile
    $('#modify-profil-picture-button').click(function() 
    {
        // Ouvrir la fenêtre pour parcourir les fichiers
        $('#imageFile').click();
    });

    // Si l'utilisateur a changé la photo de profil
    $("#imageFile").change(function() {
        // On cache le button pour modifer la photo de profil
        $('#modify-profil-picture-button').hide();
        // On affiche la barre de chargemnet lorsque l'utilisateur change de photo de profil
        $('#modify-profil-picture-loader').show();

        // On recupère le premier fichier
        var fileInput = $("#imageFile")[0];
        var file = fileInput.files[0];
        
        var formData = new FormData();
        formData.append("imageFile", file);

        // Appeler le fichier php pour mettre une image
        makeAjaxRequestPromise("/../../src/libs/image-upload.php", 'POST', formData, false, false)
        .then(function(response)
        {
            if (response !== "failed"){
                // Rafraichir l'image de profil
                $(".profil-picture").attr("src", response + "?" + new Date().getTime())

                // On cache la barre de chargemnet lorsque l'utilisateur change de photo de profil
                $('#modify-profil-picture-loader').hide();
                // On affiche le button pour modifer la photo de profil
                $('#modify-profil-picture-button').show();
            }
            else {
                throw new Error(response);
            }
        })
        .catch(function(error){
            console.log(error); 
        });
    });

    // On vérifie si le formulaire est bien remplie
    function checkFormData() 
    {
        $("input").css("color", ""); // On remet à la couleur de défaut
        $('.error-text').remove(); // On enlève tous les message d'erreur

        var fieldsToValidate = [
            { name: 'birthDate', id: "birth-date"},
            { name: 'mail', id: "mail"},
            { name: 'confirmNewPassword', id: "confirm-new-password"}
        ];

        isValid = validateFields(fieldsToValidate);

        return isValid;
    }

    function validateFields(fieldsToValidate){
      isValid = true;
      isValid2 = true;

      $.each(fieldsToValidate, function(index, field) {
        var field = fieldsToValidate[index];
        var value = getFieldIDValue(field.id);
        
        // Affiche les messages d'erreur pour les saisies
        switch (field.name) {        
            case "mail":
                if (value === '') {
                    createErrorMessageBox("Cette valeur ne doit pas être vide", field.id);
                    isValid = false;
                }
                else if (!/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(value)) {
                    createErrorMessageBox("Veuillez entrer une adresse e-mail valide", field.id);
                    isValid = false;
                }
                break;

            case "birthDate":
                var date = new Date(value);
                if (value === '') {
                    createErrorMessageBox("Cette valeur ne doit pas être vide", field.id);
                    isValid = false;
                }
                // Si l'utilisateur a mis une date de naissance 
                else if (getAge(date) < 16){
                    createErrorMessageBox("Vous devez avoir plus de 16 ans", field.id);
                    isValid = false;
                // Si l'utilisateur a mis une date de naissance  
                } else if (getAge(date) > 30){
                    createErrorMessageBox("Vous devez avoir moins de 30 ans", field.id);
                    isValid = false;
                }
                break;

            case "confirmNewPassword":
                 if (getFieldIDValue("new-password") !== value) {
                    createErrorMessageBox("Le mot de passe n'est pas le même", field.id);
                    isValid = false;
                }
                break;

            default:
                break
          }
      });
      
      isValid2 = checkNumberOfSelectedCheckBoxes("settings-form", 4);

      return isValid && isValid2;
    }

    // Envoie le formulaire
    function submitFormData()
    {
        $("#save-settings-loader").show();
        $('#save-settings').hide();

        // On enregistre les modificationss
        makeAjaxRequestPromise("/../../src/libs/settings-save.php", 'POST', $('#settings-form').serialize())
        .then(function(response)
        {
            console.log(response);
            switch (response){
                // Pour n'importe quel type d'erreur
                case "1":
                    throw new Error(response);
                // Erreur si le mail est déjà utilisé par un utilisateur de même type
                case "2":
                    createErrorMessageBox("Ce mail est déjà utilisée", "mail");
                    throw new Error("L'email est déjà pris");
                default:
                    break;
            }
            $("#save-settings-loader").hide();
            $('#save-settings').show();
        })
        .catch(function(error){
            console.log(error); 
        });
    }
});