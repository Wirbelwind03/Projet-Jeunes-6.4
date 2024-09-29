$(document).ready(function() 
{
    // Change les références selon l'onglet choisie
    $('.tab-button').click(function() 
    {
      $("#main-loader").show();

      goBackToRefferalsList();
      hideReferrals();
      showReferralsFromTab(this);

      $("#main-loader").hide();
    });

    // Retour à la liste des références
    $('.option-back').click(function() 
    {
      $("#main-loader").show();

      goBackToRefferalsList();
      hideReferrals();
      showReferralsFromTab(".tab-button.active");

      $("#main-loader").hide();
    });

    // Afficher le formulaire pour envoyer au consultant
    $('.option-send-to-consultant').click(function() 
    {
      $("#overlay").show();
      $('.send-to-consultant-form-container').show();
    });

    $('.send-to-consultant-form-container .exit-button').click(function() {
      $('#overlay').hide();
      $('.send-to-consultant-form-container').hide();
    });

    // Evénement pour l'option "Exporter au format PDF"
    $(".option-export-to-pdf").click(function(){
      var referralHash = $('.referral-content').attr('id');

      window.jsPDF = window.jspdf.jsPDF;

      // Create a new jsPDF instance
      var doc = new jsPDF()
      
      // Source HTMLElement or a string containing HTML.
      var elementHTML = $('#' + referralHash).html();

      var excludedPart = $('#juniors-skills').html(); // Replace 'excludedPart' with the ID or class of the part you want to ignore
      var modifiedHTML = elementHTML.replace(excludedPart, '');

      // Modify the HTML string to change the text color
      var modifiedHTML = modifiedHTML.replace(/<(span|p)([^>]*)>/g, '<$1$2 style="color: black;">');

      // Add a new page
      doc.addPage();

      doc.setTextColor("#fb3199");
      doc.text(10, 10, "MES SAVOIRS ETRE"); // Adjust the coordinates (10, 10) as per your desired position

      doc.html(modifiedHTML, {
        callback: function(doc) {


          // Save the PDF
          doc.save('document-html.pdf');
        },
        margin: [10, 10, 10, 10],
        autoPaging: 'text',
        x: 0,
        y: 0,
        width: 190, // target width in the PDF document
        windowWidth: 500 // window width in CSS pixels
      });
    })

    // Evénement pour supprimer une référence
    $('.option-delete').click(function() 
    {
      $("#overlay").show();
      $("#wrap-loader").show();
      var referralHash = $('.referral-content').attr('id').replace('referral-content-', '');
      $("#" + referralHash).remove();
      makeAjaxRequestPromise('/../../src/libs/delete-referral.php', "POST", {referralHash: referralHash})
      .then(function(response){
        if (response !== "failed"){
          $("#overlay").hide();
          $("#wrap-loader").hide();
          goBackToRefferalsList();
        }
        else {
          throw new Error(response);
        }
      })
      .catch(function(error){
        console.log(error); 
     });
    });

    // Ajouter toutes les références lorsque la page est chargée
    addReferrals();

    // Ajouter toutes les références au tableau
    function addReferrals(){
      // Empêcher l'utilisateur de cliquer sur les autres onglets pendant le chargement
      $('.tab-button').prop('disabled', true);
      var responseData;
      
      // Recupérer les références de l'utilisateur connectée
      makeAjaxRequestPromise('/../../src/libs/get-user-referrals.php', "POST")
      .then(function(response) 
      {
        if (response !== "failed"){
          const jsonReferrals = JSON.parse(response);
          responseData = jsonReferrals;
                        
          for(var referralHash in jsonReferrals["referralsAll"]) 
          {
            // Recupérer la référence dans le json
            referral = jsonReferrals["referralsAll"][referralHash];
            // Ajouter la référence au tableau html
            addReferral(referralHash, jsonReferrals, referral);
          }
  
          // Ré-activer les onglets
          $('.tab-button').prop('disabled', false);
        }
        else {
          throw new Error(response);
        }
      })
      .catch(function(error){
        console.log(error); 
     });
    }
    
    // Ajoute une référence au tableau
    // referralHash : Hashage de la référence
    // referrals : Données qui contient tous les références
    // referral : La référence qu'on ajoute au tableau
    function addReferral(referralHash, referrals, referral)
    {
      // Ajouter une nouvelle ligne au tableau avec le hashage comme ID
      let newRow = $(`<tr class="clickable-row" id="${referralHash}"></tr>`).appendTo("#referrals");
      
      // Evénement lorsque l'utilisateur clique sur une référence
      newRow.on('click', function() {
        // Cacher la liste de référence
          $(".referrals-table").hide();
          // Empêcher l'utilisateur de cliquer sur les autres onglets pendant le chargement
          $('.tab-button').prop('disabled', true);
          // Afficher la barre de chargement
          $("#main-loader").show();

          // Réinitialiser le formulaire des savoirs-êtres ( pour que les cases cochées ne s'empile pas)
          document.getElementById('juniors-referral-form').reset();

          var row = $(this);
          var referralHash = row.attr('id');

          // Mettre à jour la valeur "read" de la référence
          makeAjaxRequestPromise("/../../src/libs/referral-read.php", "POST", {referralHash: referralHash})
          .then(function(response){
            if (response !== "false") {
              // Références de l'utilisateur
              const jsonReferrals = JSON.parse(response);
              var referral = jsonReferrals["referralsAll"][referralHash];
              
              // Montrer le contenu de la référence
              showReferralContent(referralHash, jsonReferrals, referral);
              // Changer la couleur lorsque l'utilisateur clique la référence
              if (referral.validated == true) {
                  row.css("background-color", "rgba(0, 255, 0, 0.05)");
                  row.css("font-weight", "normal");
              } else {
                  row.css("font-weight", "normal");
              }

              // Afficher les options liées à la référence
              $("#referrals-header-content-options").show();
              // Ré-activer les onglets
              $('.tab-button').prop('disabled', false);
              // Cacher le barre de chargement
              $("#main-loader").hide();
            }
            else {
              throw new Error(response);
            }
          })
          .catch(function(error){
            console.log(error); 
         });
      });
          

      let newCell; 
      
      // Afficher celui qui envoyer/reçu la référence
      newCell = $(`<td class="referral-receiver-name"></td>`).appendTo(newRow);
      if (jQuery.inArray(referralHash, referrals["referralsReceived"]) !== -1)
          $(`<span>De : ${referral.juniorName} ${referral.juniorFirstName}</span>`).appendTo(newCell);
      else
          $(`<span>À : ${referral.referentName} ${referral.referentFirstName}</span>`).appendTo(newCell);

      // Afficher brievement l'engagement
      newCell = $(`<td class="referral-text"><span class">${referral.commitment}</span></td>`).appendTo(newRow);
      
      // Afficher la date en replaçant les "-" par des "/""
      date = referral.date.split(" ")[0].replace(/-/g, "/");
      newCell = $(`<td><div class="referral-date"><span class">${date}</span></div></td>`).appendTo(newRow);

      // Couleur pour les lignes
      switch (true) {
        case referral.validated == true && referral.read == false:
          newRow.css("background-color", "rgba(0, 255, 0, 0.15)");
          newRow.find('td span').css("font-weight", "bold");
          break;
        case referral.validated == true && referral.read == true:
          newRow.css("background-color", "rgba(0, 255, 0, 0.05)");
          break;
        case referral.validated == false && referral.read == true:
          break;
        case referral.validated == false && referral.read == false:
          newRow.css("background-color", "var(--color-two)");
          newRow.find('td span').css("font-weight", "bold");
          break;
        default:
            break;
      }
    }

    // Cacher tous les références
    function hideReferrals(){
        // Cacher tous les lignes
        $("#referrals  > tr").each(function(index, tr) { 
            $(this).hide();
        });
    }

    function showReferralsFromTab(tab)
    {
      // Empêcher l'utilisateur de cliquer sur les autres onglets pendant le chargement
      $('.tab-button').prop('disabled', true); 
      var referralsType = $(tab).attr('id');
      makeAjaxRequestPromise('/../../src/libs/get-user-referrals.php', "POST")
      .then(function(response) 
      {
        if (response !== "failed"){
          const jsonReferrals = JSON.parse(response);
        
          switch(referralsType){
            // Afficher tous les références en attente de validation
            case "referralsSended":
                $("#referrals > tr").each(function(index, tr) {
                  var hash = $(this).attr('id'); // Récupérer le hashage à partir de l'ID
                  if (jQuery.inArray(hash, jsonReferrals["referralsValidated"]) === -1) { // Si le hashage à été trouver dans la liste
                    $(this).show();
                  }
                });
                break;
  
            // Afficher les références validées
            case "referralsValidated":
                $("#referrals > tr").each(function(index, tr) {
                  var hash = $(this).attr('id'); // Récupérer le hashage à partir de l'ID
                  if (jQuery.inArray(hash, jsonReferrals["referralsValidated"]) !== -1) { // Si le hashage à été trouver dans la liste
                    $(this).show();
                  }
                });
                break;
  
            default:
                // Afficher tous les lignes
                $("#referrals  > tr").each(function(index, tr) { 
                  $(this).show();
                });
                break;
          }

          $('.tab-button').prop('disabled', false);
        }
        else {
          throw new Error(response);
        }
      })
      .catch(function(error){
        console.log(error); 
      }); 
    }

    // Retour à la liste de références
    function goBackToRefferalsList(){
      $(".referral-content").removeAttr("id"); // Cacher le contenu de la référence
      $(".referral-content").hide(); // Cacher le contenu de la référence
      $(".referrals-table").show(); // Afficher la liste des références
      $("#referrals-header-content-options").hide();
    }
});

