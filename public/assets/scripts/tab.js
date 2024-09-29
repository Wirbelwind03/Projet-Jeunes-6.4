$(document).ready(function() 
{   
    // Cache le contenu de tous les onglets
    $('.tab-content').hide();
    // Active le premier onglet
    $('.tab-button:first').addClass('active');
    // Affiche le contenu du premier onglet
    $('.tab-content:first').show();

    // Evenement lorsqu'on clique sur un onglet
    $('.tab-button').click(function() {
        var id = $(this).attr('id');

        // Si l'onglet n'est pas active, on met la class "active"
        if (!$(this).hasClass('active')){
            // On enlève la classe "active" de tous les autres onglets
            $('.tab-button').removeClass('active');
            // ON ajoute la classe "active" à l'onglet cliqué 
            $(this).addClass('active');
            
            // On cache le contenu de tous les onglets
            $('.tab-content').hide();
            // On affiche le contenu de l'onglet actuel
            $('#' + id + '-content').show();
        }

    });
    
});