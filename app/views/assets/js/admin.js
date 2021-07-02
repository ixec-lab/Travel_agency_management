$(document).ready(function(){
    // render forms when ' type de voyage' selected

    // getting elements objects from view
    var titre = $("#title");
    var image = $("#image");
    var prix = $("#prix");
    // places max
    var plmax = $("#plmax");
    var lb_plmax = $("#lb_plmax");
    var type = $("#type");

    // hotel
    var hotel = $("#hotel");
    var lb_hotel = $("#lb_hotel");

    //transport
    var trans = $("#type_trans");
    var lb_trans = $("#lb_type_trans");



    type.change(function(){
        console.log(jQuery.type(type.val()));
        // hidding on "perso type" 
        if (type.val() == "personnalise"){
            plmax.hide();
            lb_plmax.hide();

            trans.hide();
            lb_trans.hide();

            hotel.hide();
            lb_hotel.hide();
        // enabling inputs for != "perso type"
        }else{
            plmax.show();
            lb_plmax.show();

            trans.show();
            lb_trans.show();

            hotel.show();
            lb_hotel.show();
        }
    });

    // getting type of transport

    var type_trans = $('#trans_type');

    
    if(type_trans.val() === "bus"){
        $("#lbl_trans_num_vol").hide();
        $("#trans_num_vol").hide();
        $("#lbl_trans_date_dept").hide();
        $("#trans_date_dept").hide();
        $("#lbl_trans_date_rtr").hide();
        $("#trans_date_rtr").hide();
    }

    type_trans.change(function() {
        
    
        console.log(type_trans.val());

        if (type_trans.val() === "avion"){
            $('#trans_matricule').hide();
            $("#lbl_trans_matricule").hide();
            $("#lbl_trans_num_vol").show();
            $("#trans_num_vol").show();
            $("#lbl_trans_date_dept").show();
            $("#trans_date_dept").show();
            $("#lbl_trans_date_rtr").show();
            $("#trans_date_rtr").show();
            $("#lbl_trans_chauffeur").hide();
            $("#trans_chauffeur").hide();
            
        }else{
            $("#trans_matricule").show();
            $("#lbl_trans_matricule").show();
            $("#lbl_trans_num_vol").hide();
            $("#trans_num_vol").hide();
            $("#lbl_trans_date_dept").hide();
            $("#trans_date_dept").hide();
            $("#lbl_trans_date_rtr").hide();
            $("#trans_date_rtr").hide();
            $("#lbl_trans_chauffeur").show();
            $("#trans_chauffeur").show();
        }

        
    });


    // add rooms in hotel

    var val_chambre_submit = $("#submit_chambre").val();
    var val_chambre_hotel = $("#chambre_hotel").val();
    var val_chambre_type = $("#chambre_type").val();
    var val_chambre_prix = $("#chambre_prix").val();



    $("#submit_chambre").click(function(event){
        event.preventDefault();
        var val_chambre_submit = $("#submit_chambre").val();
        var val_chambre_prix = $("#chambre_prix").val();
        var val_chambre_hotel = $("#chambre_hotel").val();
        var val_chambre_type = $("#chambre_type").val();
        $.ajax({
            url: "/admin",
            method: "POST",
            data: {submit_chambre:val_chambre_submit, chambre_hotel: val_chambre_hotel, chambre_type: val_chambre_type, chambre_prix: val_chambre_prix},
            success: function(data){
                hotel = JSON.parse(data);
                if(hotel.error === false){
                    alert(hotel.msg);
                    $("#chambre_occup").text(hotel.occuped_rooms);
                }else{
                    alert(hotel.msg_error);
                }
            },

            error : function(error){
                alert("Erreur 500 dans le serveur");
            }

        })
    });

    $("#chambre_hotel").change(function(){
        var hotel_id = $("#chambre_hotel").val();
        $.ajax({
            url: "/admin",
            method: "POST",
            data: {request_number_max_hotel: 'submit', id_hotel: hotel_id},
            success: function(data){
                console.log(data);
                chambre = JSON.parse(data);
                $("#chambre_max").text(chambre.max_rooms);
                $("#chambre_occup").text(chambre.occuped_rooms);
            },

            error: function(){
                alert("Erreur 500 serveur interne")
            }
        })
    });

    
});