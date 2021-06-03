$(document).ready(function(){
    $("#connexion").click(function(){
        $('#connexion-form p').each( function () {
            $('#connexion-form p').remove();
        })
        
        $("input").each(function () {
            let $this = $(this);
            let inputName = $this.attr("name");
            if ($this.val() == "") {
                $this.before("<p class='vide'>"+`Le champ ${inputName} doit être rempli et valide`+"</p>");
                return false;
            }
        });

        let data = $("#connexion-form").serialize();

        let req = $.ajax({
            url: "../controler/connexion.php",
            type: "post",
            data: data,
        });

        
        req.done((res) => {
            if (res){
              localStorage.setItem("id_membre", res);
               window.open('./compte.html', '_blank');
               $("span").html("Connexion validée, ravis de vous revoir !"); 

            } else {
                window.location.href("./connexion.html");
               $("span").html("La connexion a échouée, merci de vérifier vos identifiants."); 
            }
            
        });


    });
});