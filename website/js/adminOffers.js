$(document).ready(function(){
    $('#divForm').hide();
    $('#divRecords').show();
    $('#addNewOffer').click(function(e){
        e.preventDefault();
        $('#divRecords').slideToggle("slow");
        $('#divForm').slideToggle("slow");
        $('#txtTitle').val('');
        $('#txtDays').val('');
        $('#txtPrice').val('');
        $('#hdnSpeId').val(0);
    
        $('#btnOffer').val('Save');
    });
    
    $('#cancOffer').click(function(e){
        e.preventDefault();
        $('#divRecords').slideToggle("slow");
        $('#divForm').slideToggle("slow");       
    });
    
    $('#btnOffer').click(function(e){
        e.preventDefault();
        if($('#hdnSpeId').val() == "0"){
            saveOffers();
        }
        else
        {
            UpdateOffers();
        }
            
    });
    
});

function saveOffers(){
    $title = $('#txtTitle').val();
    $daysA = $('#txtDays').val();
    $priceA = $('#txtPrice').val();
   
    $.ajax({
            url:"../zenithAdmin/offerService.php",  
            type:"POST",
            data:{
                    data:"svOffer",
                    special:$title,
                    daysAllowed:$daysA,
                    price:$priceA
                    
            },
            success:function(speId){
                if(speId)
                {                    
                    $('#divRecords').slideToggle("slow");
                    $('#divForm').slideToggle("slow");    
                    $('#lblMsg').html('Offers information added!');   
                    
                    $newOffer = "<div class='form-group col-md-5'>";
                         $newOffer += "<div class='form-group col-md-12'>";
                             $newOffer += "<label class='col-md-6 control-label'>Title:</label>";
                             $newOffer += "<div class='col-md-6'>";
                             $newOffer += "<label id='lblTitle_'" + speId + "' class='control-label' style='font-weight:normal;'>" + $title + "</label>";
                             $newOffer += "</div>";
                         $newOffer += "</div>";

                         $newOffer += "<div class='form-group col-md-12'>";
                             $newOffer += "<label class='col-md-6 control-label'>Days Allowed:</label>";
                             $newOffer += "<div class='col-md-6'>";
                             $newOffer += "<label id='lblDays_'" + speId + "' class='control-label' style='font-weight:normal;'>" + $daysA + "</label>";
                             $newOffer += "</div>";
                         $newOffer += "</div>";


                         $newOffer += "<div class='form-group col-md-12'>";
                             $newOffer += "<label class='col-md-6 control-label'>Price:</label>";
                             $newOffer += "<div class='col-md-6'>";
                             $newOffer += "$ ";
                             $newOffer += "<label id='lblPrice_'" + speId + "' class='control-label' style='font-weight:normal;'>" + $priceA + "</label>";
                             $newOffer += " CA";
                             $newOffer += "</div>";
                         $newOffer += "</div>";


                         $newOffer += "<div  class='form-group col-md-12'>";
                         $newOffer += "<label class='col-md-4 control-label'>&nbsp;</label>";
                         $newOffer += "<div class='col-md-8'>";
                         $newOffer += "<input type='submit' id='updOffer_'" + speId + "' onclick='showUpdate(" + speId + "); return false;' value='Edit' class='btn btn-success' />&nbsp;&nbsp;&nbsp;";
                         $newOffer += "<input type='submit' id='delOffer_'" + speId + "' value='Delete' class='btn btn-success' />";
                         $newOffer += "</div>";            
                         $newOffer += "</div>";

                         $newOffer += "<div  class='form-group col-md-12'>";
                             $newOffer += "<hr/>";
                         $newOffer += "</div>";    

                    $newOffer += "</div>";    

                    $newOffer += "<div class='form-group col-md-1' >";
                    $newOffer += "</div>";   
                    $('#divRecords').append($newOffer);
                }
            },
            dataType:"text"
    });
}

function UpdateOffers(){
    $OfferId = $('#hdnSpeId').val();
    $title = $('#txtTitle').val();
    $daysA = $('#txtDays').val();
    $priceA = $('#txtPrice').val();
    
    $.ajax({
            url:"../zenithAdmin/offerService.php",  
            type:"POST",
            data:{
                    data:"updOffer",
                   specialId:$offerId,
                    special:$title,
                    daysAllowed:$daysA,
                    price:$priceA
                    
            },
            success:function(msg){
                if(msg)
                {
                    $('#lblTitle_' + $offerId).html($title);
                    $('#lblDays_' + $offerId).html($daysA);
                    
                    
                    $('#lblPrice_' + $offerId).html($priceA);
                    
                    
                    $('#divRecords').slideToggle("slow");
                    $('#divForm').slideToggle("slow");    
                    $('#lblMsg').html('Offers information updated!');                    
                }
            },
            dataType:"text"
    });
}

function showUpdate($specialId){
    $('#txtTitle').val($('#lblTitle_' + $specialId).html());
    $('#txtDays').val($('#lblDays_' + $specialId).html());
    $('#txtPrice').val($('#lblPrice_' + $specialId).html());
    $('#hdnSpeId').val($specialId);
        
    $('#divRecords').slideToggle("slow");
    $('#divForm').slideToggle("slow");
    $('#btnOffera').val('Update');
    
    alert($specialId);
    alert($('#lblTitle_' + $specialId).html());
}




