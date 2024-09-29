$(document).ready(function() 
{
    // Onglet actuelle
    var currentTab = 0;

    var tabs = $(".tab");

    if( $('.tab').length ){
        showTab(currentTab);
    }
    
    // Evénément pour le click d'un button suivant
    // Met l'onglet suivant
    $('.next-button').click(function() {
        nextPreviousTab(1);
    });

    // Evénément pour le click d'un button précédent
    // Met l'onglet précédent
    $('.previous-button').click(function() {
        nextPreviousTab(-1);
    });

    $('.exit-button').click(function() {
        resetForm();
    });
    
    // Affiche l'onglet actuel
    function showTab(n) 
    {
        $(tabs[n]).css("display", "flex");

        if( $('#previous-button').length ){
            if (n == 0) {
                // Cache le button "précédent" si on est à la première onglet
                $("#previous-button").css("visibility", "hidden");
            } else {
                // Montre le button "précédent" pour les autres onglets
                $("#previous-button").css("visibility", "visible");
            }
        }

        if( $('#next-button').length ){
            if (n == (tabs.length - 1)) {
                // Change le texte du button "suivant" si on est à la dernière onglet
                $("#next-button").text("VALIDER");
            } else {
                // Montre le text "suivant" pour le button pour les autres onglets
                $("#next-button").text("SUIVANT");
            }
        }

        // Change l'onglet affichée
        changeActive(n, "tab");
        
        if( $('.circle-step').length )
            changeActive(n, "circle-step");
    }

    // Change l'onglet
    function nextPreviousTab(n)
    {
        // Empêcher l'utilisateur d'avancer à l'onglet suivant
        if (n === 1 && !validateForm()){
            return false;
        }

        // Cache l'onglet précédent
        $(tabs[currentTab]).css("display", "none");
        // On change d'onglet
        currentTab += n;
        
        // Si on a validé la dernière onglet, on envoit le formulaire
        if (currentTab >= tabs.length) {
            submitFormData();
            showComplete();
            return false;
        }
        
        // Change l'onglet affichée
        showTab(currentTab);
        // Faire defiler la page en haut de l'onget
        scrollToClass("tab active");        
    }

    // Fait valider le formulaire
    function validateForm() 
    {  
        // Si le formulaire de l'onglet actuelle n'est pas complété
        if (!checkFormData(currentTab))
            return false;

        if (!$(".circle-step").eq(currentTab).hasClass("complete")) {
            $(".circle-step").eq(currentTab).addClass("complete");
        }

        return true;
    }

    function showComplete(){
        $("#ask-account-exist-message").css("display", "none");
        $("#previous-button").css("visibility", "hidden");
        $("#next-button").css("visibility", "hidden");
        $(".circle-steps").css("display", "none");        
    }

    // On réinitialise le formulaire
    function resetForm(){
        $("#myform").trigger("reset");
        $(".circle-step").removeClass("complete");
        $(tabs[currentTab]).css("display", "none");
        currentTab = 0;
        changeActive(0, "tab");
        showTab(0);
    }
});

