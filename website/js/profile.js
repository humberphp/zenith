// AUTHOR: JAGSIR SINGH
// DATE : 23 MARCH 2014


function loadCountries(){ 
    var $cnt = $('#hdnCountryId').val();
    $('#ddlCountry').find('option').remove().end();
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"getCountries"
            },
            success:function(msg){
                    msg = $.parseJSON(msg); 
                    for (var index in msg) 
                    {
                        $('#ddlCountry').append('<option value="'+ msg[index].countryId +'">' 
                                + msg[index].countryName + '</option>').val( msg[index].countryId);                            
                    }
                    if($cnt == "0")
                    {
                        $("#ddlCountry option:first").attr('selected','selected');                        
                    }
                    else
                    {      
                        $('#ddlCountry').val($cnt);
                    }
                    loadStates();
            },
            dataType:"text"
    });
 }
 
function loadStates(){  
    //alert($('#ddlStates').text());
    var $stt = $('#hdnStateId').val();
    $('#ddlStates').find('option').remove().end();
    $('#ddlCities').find('option').remove().end();
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"getStates",
                    cntryId:$("#ddlCountry").val()
            },
            success:function(msg){
                    // alert(msg);
                    msg = $.parseJSON(msg); 
                    for (var index in msg) 
                    {
                        $('#ddlStates').append('<option value="'+ msg[index].stateId +'">' 
                                + msg[index].state + '</option>').val( msg[index].stateId);
                    }
                    if($stt == 0) 
                    {
                        $("#ddlStates option:first").attr('selected','selected');
                    }
                    else
                    {      
                        $exists = false; 
                        $('#ddlStates  option').each(function(){
                          if (this.value == $stt) {
                            $exists = true;
                          }
                        });
                        if($exists)
                        {
                        $('#ddlStates').val($stt);
                        }
                        else
                        {
                            $("#ddlStates option:first").attr('selected','selected');
                        }
                    }
                    loadCities();
            },
            dataType:"text"
    });
}

function loadCities(){  
    var $cit = $('#hdnCityId').val();
    $('#ddlCities').find('option').remove().end();
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"getCities",
                    stId:$("#ddlStates").val()
            },
            success:function(msg){
                    msg = $.parseJSON(msg); 
                    for (var index in msg) 
                    {
                        $('#ddlCities').append('<option value="'+ msg[index].cityId +'">' 
                                + msg[index].city + '</option>').val( msg[index].cityId);                        
                    }
                    if($cit == "0") 
                    {
                        $("#ddlCities option:first").attr('selected','selected');
                    }
                    else
                    {    
                        $exists = false; 
                        $('#ddlCities  option').each(function(){
                          if (this.value == $cit) {
                            $exists = true;
                          }
                        });
                        if($exists)
                        {
                            $('#ddlCities').val($cit);
                        }
                        else
                        {
                            $("#ddlCities option:first").attr('selected','selected');
                        }
                          
                    }
        },
            dataType:"text"
    });
}

function updateLocations()
{
    $usid = $('#hdUId').val();
    $cnt = $('#ddlCountry').val();
    $stt = $('#ddlStates').val();
    $cit = $('#ddlCities').val();
    $citizen = $('#txtCitizen').val();
    $resi = $('#txtResident').val();
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"updateLoc",
                    uid:$usid,
                    cntryId:$cnt,
                    sttId:$stt,
                    ctyid:$cit,
                    citiz:$citizen,
                    res:$resi
            },
            success:function(msg){
                if(msg)
                {
                    $('#lblCitizen').text($citizen);
                    $('#lblResident').text($resi);
                    $('#simpleDivLoc').slideToggle("slow");
                    $('#editDivLoc').slideToggle("slow");
                    
                    $('#lblCountry').html($("#ddlCountry option:selected").text());
                    $('#lblState').html($("#ddlStates option:selected").text());
                    $('#lblCity').html($("#ddlCities option:selected").text());
                    $('#lblCitizen').html($citizen);
                    $('#lblResident').html($resi);
                    
                    $('#hdnCountryId').html($cnt);
                    $('#hdnStateId').html($stt);
                    $('#hdnCityId').html($cit);
                    
                    $('#lblMsg').html('Location information updated!');                    
                }
            },
            dataType:"text"
    });
}

$(document).ready(function(){
    $('#simpleDivLoc').show();
    $('#editDivLoc').hide();    
     
//  -----------------------------------  EDIT BUTTON CLICK STARTS -----------------------------------------
    $('#locEdit').click(function(e){
        e.preventDefault();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow");    
    });
//  -----------------------------------  EDIT BUTTON CLICK ENDS -----------------------------------------

    
    
//  -----------------------------------  CANCEL BUTTON CLICK STARTS -----------------------------------------
    $('#cancDivLoc').click(function(e){
        e.preventDefault();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow");
        $cnt = $('#hdnCountryId').val();
        $stt = $('#hdnStateId').val();
        $cit = $('#hdnCityId').val();
        loadCountries();
        if($cnt != "0")
        {
            $('#ddlCountry').val($cnt);
            $('#ddlStates').val($stt);
            $('#ddlCities').val($cit);
        }
        
    });
//  -----------------------------------  CANCEL BUTTON CLICK ENDS -----------------------------------------


//  -----------------------------------  UPDATE BUTTON CLICK ENDS -----------------------------------------
    $('#updLoc').click(function(e){
        e.preventDefault();
        updateLocations();
    });
//  -----------------------------------  UPDATE BUTTON CLICK ENDS -----------------------------------------

     
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION STARTS -----------------------------------------
    loadCountries();
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION ENDS-----------------------------------------

});