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
                        $exists = false; 
                        $('#ddlCountry  option').each(function(){
                          if (this.value == $cnt) {
                            $exists = true;
                          }
                        });
                        if($exists)
                        {
                            $('#ddlCountry').val($cnt);
                        }
                        else
                        {
                            $("#ddlCountry option:first").attr('selected','selected');
                        }      
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

function updateLocations(){
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
                    
                    $('#lblCountry').html($("#ddlCountry option:selected").text());
                    $('#lblState').html($("#ddlStates option:selected").text());
                    $('#lblCity').html($("#ddlCities option:selected").text());
                    $('#lblCitizen').html($citizen);
                    $('#lblResident').html($resi);
                    
                    $('#hdnCountryId').html($cnt);
                    $('#hdnStateId').html($stt);
                    $('#hdnCityId').html($cit);
                    
                    $('#simpleDivLoc').slideToggle("slow");
                    $('#editDivLoc').slideToggle("slow");
                    $('#lblMsg').html('Location information updated!');                    
                }
            },
            dataType:"text"
    });
}

function updateFamilyDetails(){
    $usid = $('#hdUId').val();
    $livWith = $('input[name=rdbLiv]:checked').val();
    $famType = $('input[name=rdbFamType]:checked').val();
    $famVal = $('input[name=rdbFamVal]:checked').val();
    $famStat = $('input[name=rdbFamStat]:checked').val();    
        
    $numSis = $('#txtNumSis').val();
    $numBro = $('#txtNumBro').val();
    $mrdSis = $('#txtMrdSis').val();
    $mrdBro = $('#txtMrdBro').val();
    $FOccu = $('#txtFatherOcc').val();
    $MOccu = $('#txtMotherOcc').val();
    
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"updateFamDet",
                    uid:$usid,
                    liveWith:$livWith,
                    fType:$famType,
                    fVal:$famVal,
                    fState:$famStat,
                    nSis:$numSis,
                    nBros:$numBro,
                    marriedSis:$mrdSis,
                    marriedBros:$mrdBro,
                    fatherOcc:$FOccu,
                    motherOcc:$MOccu
            },
            success:function(msg){
                //alert(msg);
                if(msg)
                {                      
                    $('#lblLivingW').html($livWith);
                    $('#lblFType').html($famType);
                    $('#lblFValue').html($famVal);
                    $('#lblFStat').html($famStat);
                    $('#lblNumSis').html($numSis);
                    $('#lblNumBros').html($numBro);
                    $('#lblMSis').html($mrdSis);
                    $('#lblMBros').html($mrdBro);
                    $('#lblFOcc').html($FOccu);
                    $('#lblMOcc').html($MOccu);
    
                    $('#simpleDivFamDet').slideToggle("slow");
                    $('#editDivFamDet').slideToggle("slow"); 
                    $('#lblMsg').html('Family details updated!');                    
                }
            },
            dataType:"text"
    });
}

function updateProfessionalDetails(){
    $usid = $('#hdUId').val();
    
    $edu = $('#txtEdu').val();
    $clg = $('#txtClg').val();
    $adeg = $('#txtADeg').val();
    $occp = $('#txtOccp').val();
    $empin = $('input[name=rdbEmpIn]:checked').val();  
    $ainc = $('#txtAInc').val();
    
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"updateProfDet",
                    uid:$usid,
                    educ:$edu,
                    colg:$clg,
                    adegree:$adeg,
                    occup:$occp,
                    empdin:$empin,
                    anninc:$ainc
            },
            success:function(msg){
                alert(msg);
                if(msg)
                {                          
                    $('#lblEdu').html($edu);
                    $('#lblColg').html($clg);
                    $('#lblADeg').html($adeg);
                    $('#lblOccup').html($occp);
                    $('#lblEmpIn').html($empin);
                    $('#lblAIncome').html($ainc);
                    
                    $('#simpleDivProfDet').slideToggle("slow");
                    $('#editDivProfDet').slideToggle("slow"); 
                    $('#lblMsg').html('Professional details updated!');                    
                }
            },
            dataType:"text"
    });
}

function updateHobbies(){
    $usid = $('#hdUId').val();
    $langArray = [];
    $("#spokenLangs option:selected").each(function () {
            var $this = $(this);
            if ($this.length) {
             $langArray.push($this.text());
            }
         });
    $selectedLangs = $langArray.join(', ');
         
    $chkHBArray = [];
    $("[name=chkHobbies]:checked").each(function() {
        $chkHBArray.push($(this).val());
    });        
    $selectedHobbies = $chkHBArray.join(', ');
    
    $chkIntArray = [];
    $("[name=chkInterests]:checked").each(function() {
        $chkIntArray.push($(this).val());
    });        
    $selectedInts = $chkIntArray.join(', ');
    
    $chkDSArray = [];
    $("[name=chkDressStyle]:checked").each(function() {
        $chkDSArray.push($(this).val());
    });        
    $selectedDS = $chkDSArray.join(', ');
    
//    alert($selectedHobbies);
//    alert($selectedInts);
//    alert($selectedDS);
//    alert($selectedLangs);
    
    
    $.ajax({
            url:"../commonService.php",  
            type:"POST",
            data:{
                    data:"updateHobbies",
                    uid:$usid,
                    hobs:$selectedHobbies,
                    ints:$selectedInts,
                    dS:$selectedDS,
                    langs:$selectedLangs
            },
            success:function(msg){
                alert(msg);
                if(msg)
                {                          
                    $('#lblHobbies').html($selectedHobbies);
                    $('#lblInts').html($selectedInts);
                    $('#lblDStyles').html($selectedDS);
                    $('#lblSLanguages').html($selectedLangs);
                    
                    $('#simpleDivHobbies').slideToggle("slow");
                    $('#editDivHobbies').slideToggle("slow"); 
                    $('#lblMsg').html('Hobbies and Interests updated!');                    
                }
            },
            dataType:"text"
    });
}

$(document).ready(function(){
    showHide();  
    loadCountries();
     
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION STARTS -----------------------------------------
    loadCountries();
//  -----------------------------------  (AT PAGE LOAD) LOAD COUNTRIES SECTION ENDS-----------------------------------------
     
//  -----------------------------------  LOCATION BUTTON CLICK STARTS -----------------------------------------
    $('#locEdit').click(function(e){
        e.preventDefault();        
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
        
        showHide();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow"); 
    });    
    $('#cancDivLoc').click(function(e){
        e.preventDefault();
        $('#simpleDivLoc').slideToggle("slow");
        $('#editDivLoc').slideToggle("slow");
        
    });
    $('#updLoc').click(function(e){
        e.preventDefault();
        updateLocations();
    });
//  -----------------------------------  LOCATION BUTTON CLICK ENDS -----------------------------------------

     
//  -----------------------------------  FAMILY DETAILS BUTTON CLICK STARTS -----------------------------------------
    $('#famDetEdit').click(function(e){
        e.preventDefault();
        
        $("[name=rdbLiv]").prop("checked", false);
        $("[name=rdbFamType]").prop("checked", false);
        $("[name=rdbFamVal]").prop("checked", false);
        $("[name=rdbFamStat]").prop("checked", false);
        
        $("[name=rdbLiv]").filter("[value='"+$('#lblLivingW').text()+"']").prop("checked",true);        
        $("[name=rdbFamType]").filter("[value='"+$('#lblFType').text()+"']").prop("checked",true);
        $("[name=rdbFamVal]").filter("[value='"+$('#lblFValue').text()+"']").prop("checked",true);
        $("[name=rdbFamStat]").filter("[value='"+$('#lblFStat').text()+"']").prop("checked",true);
        
        $('#txtNumSis').val($('#lblNumSis').text());
        $('#txtNumBro').val($('#lblNumBros').text());
        $('#txtMrdSis').val($('#lblMSis').text());
        $('#txtMrdBro').val($('#lblMBros').text());
        $('#txtFatherOcc').val($('#lblFOcc').text());
        $('#txtMotherOcc').val($('#lblMOcc').text());
        
        showHide();
        $('#simpleDivFamDet').slideToggle("slow");
        $('#editDivFamDet').slideToggle("slow"); 
        
    });    
    $('#cancFamDet').click(function(e){
        e.preventDefault();
        $('#simpleDivFamDet').slideToggle("slow");
        $('#editDivFamDet').slideToggle("slow"); 
        
    });
    $('#updFamDet').click(function(e){
        e.preventDefault();
        updateFamilyDetails();
    });
//  -----------------------------------  FAMILY DETAILS BUTTON CLICK ENDS -----------------------------------------

     
//  -----------------------------------  PROFESSIONAL DETAILS BUTTON CLICK STARTS -----------------------------------------
    $('#profEdit').click(function(e){
        e.preventDefault();
             
        $("[name=rdbEmpIn]").prop("checked", false);
        
        $("[name=rdbEmpIn]").filter("[value='"+$('#lblEmpIn').text()+"']").prop("checked",true); 
        
        $('#txtEdu').val($('#lblEdu').text());
        $('#txtClg').val($('#lblColg').text());
        $('#txtADeg').val($('#lblADeg').text());
        $('#txtOccp').val($('#lblOccup').text());
        $('#txtAInc').val($('#lblAIncome').text());
        
        showHide();     
        $('#simpleDivProfDet').slideToggle("slow");
        $('#editDivProfDet').slideToggle("slow"); 
    });    
    $('#cancProfDet').click(function(e){
        e.preventDefault();
        $('#simpleDivProfDet').slideToggle("slow");
        $('#editDivProfDet').slideToggle("slow"); 
        
    });    
    $('#updProfDet').click(function(e){
        e.preventDefault();
        updateProfessionalDetails();
    });
     
//  -----------------------------------  PROFESSIONAL DETAILS BUTTON CLICK ENDS -----------------------------------------


//  -----------------------------------  HOBBIES BUTTON CLICK STARTS -----------------------------------------
    $('#hobbiesEdit').click(function(e){
        e.preventDefault();
        showHide();     
        $('#simpleDivHobbies').slideToggle("slow");
        $('#editDivHobbies').slideToggle("slow"); 
        
        $("[name=chkHobbies]").prop("checked", false);
        $("[name=chkInterests]").prop("checked", false);
        $("[name=chkDressStyle]").prop("checked", false);
        $("#spokenLangs option").prop("selected", false);
        
        $hbs = $('#lblHobbies').html();
        $Ints = $('#lblInts').html();
        $Dstyles = $('#lblDStyles').html();
        $langs = $('#lblSLanguages').html();
        
        $.each($hbs.split(", ").slice(0), function(index, item) {
            $("[name=chkHobbies]").filter("[value='"+item+"']").prop("checked",true);            
        });
        $.each($Ints.split(", ").slice(0), function(index, item) {
            $("[name=chkInterests]").filter("[value='"+item+"']").prop("checked",true);            
        });
        $.each($Dstyles.split(", ").slice(0), function(index, item) {
            $("[name=chkDressStyle]").filter("[value='"+item+"']").prop("checked",true);            
        });
        $.each($langs.split(", ").slice(0), function(index, item) {
            $("#spokenLangs option").filter("[value='"+item+"']").prop("selected",true);            
        });
            
    });     
    $('#cancHobbies').click(function(e){
        e.preventDefault();
        $('#simpleDivHobbies').slideToggle("slow");
        $('#editDivHobbies').slideToggle("slow"); 
        
    });
    $('#updHobbies').click(function(e){
        e.preventDefault();
       updateHobbies();
       
    });
//  -----------------------------------  HOBBIES DETAILS BUTTON CLICK ENDS -----------------------------------------


//  -----------------------------------  PARTNER PREFRENCES BUTTON CLICK STARTS -----------------------------------------
//  -----------------------------------  PARTNER PREFRENCES BUTTON CLICK STARTS -----------------------------------------
});

function showHide(){
        $('#simpleDivLoc').show("slow");
        $('#editDivLoc').hide("slow");     
        $('#simpleDivFamDet').show("slow");
        $('#editDivFamDet').hide("slow"); 
        $('#simpleDivProfDet').show("slow");
        $('#editDivProfDet').hide("slow");     
        $('#simpleDivHobbies').show("slow");
        $('#editDivHobbies').hide("slow");     
        $('#simpleDivPartPref').show("slow");
        $('#editDivPartPref').hide("slow");  
}