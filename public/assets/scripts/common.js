$(document).ready(function() {

  // Evénement pour le button "Changer la lumière de la page"
  $("#light-dark-mode-button").click(function(){
    let body = document.querySelector('body');
    switch(body.dataset.theme){
      case "light":
        body.dataset.theme = "dark";
        break;
      case "dark":
        body.dataset.theme = "light";
        break;
    }

    // Appel de la fonction php pour sauvergader l'option dans la session
    makeAjaxRequestPromise("/../../src/libs/set-light-dark-mode.php", "POST", {mode: body.dataset.theme})
    .then(function(response){
      if (response !== "failed"){
        $('img').each(function() {
          if ($(this).attr('src') !== undefined){
            // Récupérer le chemin de l'image
            var src = $(this).attr('src');

            //replaceEndOfString(src, "lightmode.png", "darkmode.png");
            //replaceEndOfString(src, "darkmode.png", "lightmode.png");

            // Changer les images en mode sombre
            if (src.endsWith("lightmode.png")) {
              var index = src.lastIndexOf("lightmode.png"); // On récupère l'indice où se trouve cette partie de chaine de caractère
              $(this).attr('src', src.substring(0, index) + "darkmode.png"); // On replace "lightmode.png" par "darkmode.png"
            } 
            // Changer les imanges en mode clair
            // On regarde si le nom de l'image finit par "darkmode.png"
            else if (src.endsWith("darkmode.png")) {
              var index = src.lastIndexOf("darkmode.png"); // On récupère l'indice où se trouve cette partie de chaine de caractère
              $(this).attr('src', src.substring(0, index) + "lightmode.png"); // On replace "darkmode.png" par "lightmode.png"
            }
          }
        });
      } 
      else {
        throw new Error(response);
      }
    })
    .catch(function(error){
      console.log(error); 
    });
  });  
});

// Remplace la fin d'une chaine de caractère
// string : Le chaine de caractère dans lequel on veut remplacer la fin
// stringToRemove : Le chaine de caractère à la fin qu'on veut enlever 
// replace : Le chaine de caractère qu'on va remplacer à la fin
function replaceEndOfString(string, stringToRemove, replace){
  if (string.endsWith(stringToRemove)) {
    var index = string.lastIndexOf(stringToRemove);
    return string.substring(0, index) + replace;
  } else {
    return string;
  }
}

// Met la classe "active" pour une class et les enlèves des autres classes
// n : Indice dans lequel on veut mettre la classe "active"
// className : Nom de la classe dans lequel on veut mettre la classe "actives"
function changeActive(n, className)
{
  var collections = $("." + className);
  collections.each(function() {
    $(this).removeClass("active");
  });
  collections.eq(n).addClass("active");
}

// Défile automatiquement la page jusqu'à une classe
// className : Nom de la classe où la page va défiler
function scrollToClass(className)
{
  var collections = document.getElementsByClassName(className);
  collections[0].scrollIntoView();
}

// Retourne le nombre de case qui ont été cocher
function getSelectedCheckBoxesCount(){
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  var selectedCount = 0;

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      selectedCount++;
    }
  }

  return selectedCount;
}

// Récupère une age à partir d'une date
// inputDate : La date
function getAge(inputDate){
  var currentDate = new Date(); // Récupère la date actuelle

  var ageInMilliseconds = currentDate - inputDate; // Calcul la différence entre deux dates en milliseconds
  var ageInYears = ageInMilliseconds / 1000 / 60 / 60 / 24 / 365.25; // Converti les milliseconds en années

  return ageInYears;
}

// Insert un nouvelle élément après un autre
// referenceNode : l'élément dans le lequel on veut insérér le nouveau élément
// newNode : Le nouveau élément qu'on veut rajouter
function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

// Créer un message d'erreur arpès une balise
// id : ID où on veut mettre notre message d'erreur après
// changeColor : Change la couleur du texte qui se trouve dans l'ID
function createErrorMessageBox(message, id, changeColor = true){
  console.log(id);
  var errorMessageBox = document.createElement('span');
  errorMessageBox.className = 'error-text'
  errorMessageBox.innerHTML = `<span style="color:red;">${message}</span>`;
  var div = document.getElementById(id);
  if (changeColor){
    div.style.color = "#ff0000";
  }
  insertAfter(div, errorMessageBox);
}

// Récupère la valeur d'une saisir à partir de son ID
function getFieldIDValue(fieldID){
  return $("#" + fieldID).val().trim();
}

// Vérifie le nombre de cases qui sont cochées à partir d'un ID de formulaire et d
// formID : ID du formulaire
// minimum : Le nombre de case à cochée au minimum
function checkNumberOfSelectedCheckBoxes(formID, maximum)
{
  if ($(".checkbox-requirement").length){
    var selectedCount = 0;

    // On récupère les cases du formulaire
    $("#" + formID + " :checkbox").each(function() {
      // Si la case est cochée, on la récupère
      if ($(this).is(':checked')){
        selectedCount++;
      }
    });
  
    // Si aucun case est cochée
    if (selectedCount == 0)
    {
        createErrorMessageBox("Vous devez cocher " + maximum.toString() + " cases.", 'checkbox-requirement');
        return false;
    }
    // Si le nombre de case à cochée ne dépasse pas le minimum
    else if (selectedCount > maximum)
    {
        createErrorMessageBox("Il vous en manque " + (selectedCount - maximum).toString() + " à décocher.", 'checkbox-requirement');
        return false;
    }
  }

  return true;
}

// Récupère la photo de profil d'un utilisateur
// userType : Type d'utilisateur (Jeune, Référent, Consultant)
// mail : Mail de l'utilisateur
function getProfilPicture(userType, mail)
{
  // Chemin pour la photo de profile
  var profilPicturePath = "../src/database/" + userType + "/" + mail + "/profil-picture.png";

  // Appel pour vérifier si la photo de profile existe
  return makeAjaxRequestPromise(profilPicturePath, "HEAD")
  .then(function(response){
    // Le fichier existe
    return profilPicturePath;
  })
  .catch(function(response){
    // Le fichier n'existe pas, on met une photo de profil par défaut
    return "assets/images/profil-picture.png";
  })
}

// Remplie un formulaire à partir d'un json
// formID : ID du formulaire
// jsonData : Le JSON dans lequel on récupère les informations du formulaire
function fillFormFromData(formID, jsonData)
{
  // Remplie les "input" dans un formulaire
  $("#" + formID + " input").each(function() {
    var fieldName = $(this).attr('name');

    // On vérifie si "name" de "input" est défini 
    if (fieldName != undefined)
    {
      // On enlève "[]" pour les cases à cocher
      fieldName = replaceEndOfString(fieldName, "[]", "");
      
      // Vérifie si la clé existe dans le JSON
      if (jsonData.hasOwnProperty(fieldName)) 
      {
        // Regarde quel type est "input"
        switch ($(this).attr('type')){
          // Si c'est une case à cocoher
          case "checkbox":
            // Coche les cases à partir d'un fichier json
            for (var i = 0; i < jsonData[fieldName].length; i++) {
              // Récupère le nom de la case à cocher
              var checkboxId = jsonData[fieldName][i];
          
              // Check the corresponding checkbox based on its ID
              $("#" + checkboxId).prop("checked", true);
            }    
            break;

          // Autres "input"
          default:
            $(this).val(jsonData[fieldName]);
            break;
        }
      }
    }
  });
  
  // Remplie les "textarea" dans un formulaire
  $("#" + formID + " textarea").each(function() {
    var fieldName = $(this).attr('name');

    // On vérifie si "name" de "input" est défini 
    if (fieldName != undefined){
      // Vérifie si la clé existe
      if (jsonData.hasOwnProperty(fieldName)) 
      {
        $(this).val(jsonData[fieldName]);
      }
    }

  });
}

// Fonction pour faire appel à ajax
function makeAjaxRequestPromise(url, method, data, processData = true, contentType = 'application/x-www-form-urlencoded; charset=UTF-8') 
{
  return new Promise(function(resolve, reject) {
    $.ajax({
      url: url,
      method: method,
      data: data,
      processData: processData,
      contentType: contentType,
      success: function(response) {
        resolve(response);
      },
      error: function(xhr, status, error) {
        reject(error);
      }
    });
  });
}