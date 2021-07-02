$("document").ready(function(){

    // getting buttons from front
    var change_infos = $("#change_base_infos");
    var update_email = $("#update_email");
    var update_password = $("#update_password");

    // fire an event on change_info button clicked
    change_infos.click(function(event){
        event.preventDefault();
        console.log("Button " + change_infos.val() + " pressed");
        //getting fields values for profile base infos to be update
        submit = change_infos.val();
        nom = $("#nom").val();
        prenom = $("#prenom").val();
        bio = $("#bio").val();
        tel = $("#tel").val();
        password = $("#validate_password").val();
        //console.log(nom.val()+" "+prenom.val()+" "+tel.val()+" "+password.val());

        $.ajax({
            method: "POST",
            url: "/profile",
            data: {nom: nom, prenom: prenom, tel: tel, password: password,bio: bio ,change_base_infos: submit},
            success: function(data){ // 200 "ok"
                if (data !== "Mot de passe erroné"){
                    alert("profile à jour");
                    user = JSON.parse(data);
                    $("#profile-nom").text(user.nom);
                    $("#profile-prenom").text(user.prenom);
                    $("#profile-side-nom").text(user.nom);
                    $("#profile-side-prenom").text(user.prenom);
                    $("#profile-side-bio").text(user.bio);
                    if (user.bio){
                        $("#apropos").show();
                    }else{
                        $("#apropos").hide();
                    }
                }else{
                    alert(data);
                }
            },

            error: function(_err){ // 404 "not found" 500 501 "internal error"
                alert("error");
            },

        });
    });

    // fire an event on update_email button clicked
    update_email.click(function(event){
        event.preventDefault();
        console.log(update_email.val());

        oldemail = $("#old-email").val();
        console.log(oldemail);
        newemail = $("#new-email").val();
        console.log(newemail);
        passwordconfirm = $("#econfpassword").val();
        console.log(passwordconfirm);

        $.ajax({
            method: "POST",
            url: "/profile",
            data: {old_email: oldemail, new_email: newemail, passwordc: passwordconfirm, update_email: update_email.val()},
            success: function(data){
                user = JSON.parse(data);
                if (user.msg === "Email mis à jour avec succès"){
                    alert(user.msg);
                    $("#profile-side-email").text(user.email);
                }else{
                    alert(user.msg); // error
                }
                
            },

            error: function(_err){
                alert("error");

            }
        });
    });

    // fire an event on update_password button clicked
    update_password.click(function(event){
        event.preventDefault();
        console.log(update_password.val());

        oldpassword = $("#old-password").val();
        newpassword = $("#new-password").val();
        confirmepassword = $("#cnewpassword").val();

        $.ajax({
            method: "POST",
            url: "/profile",
            data: {old_password: oldpassword, new_password: newpassword, cnew_password: confirmepassword, update_password: update_password.val()},
            success: function(data){
                user = JSON.parse(data);
                if (data.msg === "Mot de passe mis à jour avec succès"){
                    alert(data.msg);
                }else{
                    alert(user.msg);
                }
            },
            error: function(_err){
                alert(_err);
            }
        });
    });
});