/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadStates(){  
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
                        if($stt == msg[index].stateId) 
                        {
                            $('#ddlStates').append('<option selected="selected" value="'+ msg[index].stateId +'">' + msg[index].state + '</option>').val( msg[index].stateId);
                        }
                        else
                        {
                            $('#ddlStates').append('<option value="'+ msg[index].stateId +'">' + msg[index].state + '</option>').val( msg[index].stateId);
                        }
                    }
                    if($stt == 0) 
                    {
                        $("#ddlStates option:first").attr('selected','selected');
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
                        if($cit == msg[index].cityId) 
                        {
                            $('#ddlCities').append('<option selected="selected" value="'+ msg[index].cityId +'">' + msg[index].city + '</option>').val( msg[index].cityId);
                        }
                        else
                        {
                            $('#ddlCities').append('<option value="'+ msg[index].cityId +'">' + msg[index].city + '</option>').val( msg[index].cityId);
                        }
                    }
                        if($cit == 0) 
                        {
                            $("#ddlCities option:first").attr('selected','selected');
                        }
            },
            dataType:"text"
    });
}

$(document).ready(function(){
    $('#simpleDivLoc').show();
    $('#editDivLoc').hide();
    $('#locEdit').click(function(e){
        e.preventDefault();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow");        
    });
    
    $('#cancDivLoc').click(function(e){
        e.preventDefault();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow");
        
    });
     
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION START -----------------------------------------
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
                            $('#ddlCountry').append('<option value="'+ msg[index].countryId +'">' + msg[index].countryName + '</option>').val( msg[index].countryId);
                        }
                        if($cnt == 0)
                        {
                            $("#ddlCountry option:first").attr('selected','selected');
                        }
                        else
                        {                            
                            $('.opts').attr('value', $cnt)
                        }
                        loadStates();
                },
                dataType:"text"
        });
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION ENDS-----------------------------------------

});