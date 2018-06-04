$().ready(function () {

    $('#newpart').validate({

        rules: {
            nomP: "required",
            pnomP: "required",
            matricule: "required",
            nomR:"required",
            pnomR: "required",
            contactR: "required"

        },

        messages: {
            nomP: "Veuillez entrer le nom",
            pnomP: "Veuillez entrer le prénom",
            matricule: "Veuillez entrer le numéro d'inscription",
            nomR:"Veuillez entrer le nom du tuteur",
            pnomR: "Veuillez entrer le prénom du tuteur",
            contactR: "Veuillez entrer le contact du tuteur"
        }
    })

});