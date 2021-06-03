$(document).ready(function () {
    $("#inscription").click(function () {

        $('#form p').each( function () {
            $('#form p').remove();
        })
        
        $("input").each(function () {
            let $this = $(this);
            let inputName = $this.attr("name");
            if ($this.val() == "") {
                $this.before("<p class='vide'>"+`Le champ ${inputName} doit être rempli et valide`+"</p>");
                return false;
            }
        });

        if ($("input[type=radio]:checked").length == 0) {
            let $this = $(this);
            $this.before("<p class='vide'>"+"Merci de sélectionner un genre"+"</p>");
            return false;
        }

        if ($("input[type=checkbox]:checked").length == 0) {
            let $this = $(this);
            $this.before("<p class='vide'>"+"Merci de sélectionner au moins un loisir"+"</p>");
            return false;
        }

        let data = $("#form").serialize().slice(0, -1);

        if ($("input[type=checkbox]:checked")) {
            $("input[type=checkbox]:checked").each(function () {

                data += $(this).val() + ",";
            })
        }

        let req = $.ajax({
            url: "./../controler/inscription.php",
            type: "post",
            data: data.slice(0, -1)
        });

        req.done((res) => {
            console.log(res)
            if (!res) {
                $("span").addClass("invalidate");
                $("span").html("L'inscription n'a pas pu aboutir.");
            }


            if (res == "email existe") {
                $("span").addClass("invalidate");
                $("span").html("Votre adresse email est dejà utilisé pour un compte.");
            }


            if (res == "success")
                $("span").html("Inscription validée. Bienvenue !");

        })

    });

});