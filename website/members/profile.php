<?php
    // put your code here
    session_start();    
    include_once 'memberMasterPage.php';
    require_once '../userInfoDB.php';
    require_once '../commonDB.php';
 
    // note for me(jassi): make the following code querystring based
    $_SESSION['loginUserId'] = 4;
    $_SESSION['userFName'] = "Tunde";
    
    if(!isset($_SESSION['loginUserId']) || empty($_SESSION['loginUserId'])){
            header( 'Location: ../Login.aspx' ) ;
        }
 
        if(isset($_GET["searchUserId"])){
            $searchUserId = $_GET["searchUserId"]; // THIS WILL BE THE VALUE FROM QUERYSTRING
        }
        else {
            $searchUserId = $_SESSION['loginUserId'];
        }
 
        
        // ==================================== THIS CODE IS MUST  (START) ==============================================
        $objPage = new memberMasterPage($_SESSION['loginUserId']);       // THIS INFORMATION COMES FROM SESSIONS ONCE USER LOGS IN;
        $objPage->setTitle('Zenith - Profile'); 
        $objPage->setMetaAuthor('this is meta author');
        // ==================================== THIS CODE IS MUST  (END) ==============================================
        
        $objUsers = new userInfoDB();
  
        $personalAcc = false;
        $act = '';
        if($searchUserId == $_SESSION['loginUserId']){
            $personalAcc = true;
            
            if(isset($_GET['actEdit'])){
                $act = $_GET['actEdit'];
            }
            
            if(isset($_POST['action'])){
                $action=$_POST['action'];
                switch ($action){
                    case 'updBasic':
                        $bodyType = $_POST['rdbBodyType'];
                        $complexion = $_POST['rdbComplexion'];
                        $physicalStatus = $_POST['rdbPhysicalStatus'];
                        $height = $_POST['txtHeight'];
                        $weight = $_POST['txtWeight'];
                        $motherTounge = $_POST['txtMotherTongue'];
                        $martialStatus = $_POST['ddlMStatus'];
                        $drinkHabits = $_POST['rdbdrinkHabits'];
                        $smokeHabits = $_POST['rdbsmokeHabits'];
                        $eatingHabits = $_POST['rdbeatingHabits'];
                        $hairColor = $_POST['txtHairColor'];
                        $updateResult = $objUsers->updateUserBasicInfo($bodyType, $complexion, $physicalStatus, $height
                                , $weight, $motherTounge, $martialStatus, $drinkHabits, $smokeHabits, $eatingHabits, $hairColor);
                        if($updateResult == 1){
                            $message = "profile updated successfully!";
                            $act = '';
                        }
                        else{
                            $message = "Error. Please try again!";
                        }
                        break;
                }
            }
        }
        
        $UserBInfo = $objUsers->getUserDetailsById($searchUserId);
        $UserFDet = $objUsers->getUserFamilyDetails($searchUserId);
        $UserHobbies = $objUsers->getUserHobbies($searchUserId);
        $UserLocation = $objUsers->getUserLocation($searchUserId);
        $UserPPref = $objUsers->getUserPartnerPref($searchUserId);
        $UserProf = $objUsers->getUserProfession($searchUserId);
       // $s = userInfoDB::updateFamilyDetails(4,'Parents','Nuclear', 'Moderate','Rich', 2,1,1, 1, 'Manager', 'House Wife');;
       
        $body = "<form class='form-horizontal' method='post'>";
        $body .= "<input type='hidden' id='hdUId' name='hdUId' value='{$_SESSION['loginUserId']}'>";
        $body .= "<label class='col-md-12 control-label' name='lblMsg' id='lblMsg'></label><br/>";
        if (isset($message) && !empty($message)) {
            $body .= $message;
            $body .= "<br/>";
        } 
        else {
            $body .= "<br/>";
            $body .= "<br/>";
        }
  //=========================== A FEW WORDS ABOUT ME AND BASIC INFO SECTIONS [STARTS HERE]==================================
        if(count($UserBInfo)>0){
            $firstName = $UserBInfo[0]['firstName'];
            $lastName = $UserBInfo[0]['lastName'];
            $email = $UserBInfo[0]['email'];
            $gender = $UserBInfo[0]['gender'];
            $age = $UserBInfo[0]['age'];
            $dob = $UserBInfo[0]['dateOfBirth'];
            $photo = $UserBInfo[0]['thumbnail'];
            if(empty($firstName)){
                $firstName = '---';
            }
            if(empty($lastName)){
                $lastName = '---';
            }
            if(empty($email)){
                $email = '---';
            }
            if(empty($gender)){
                $gender = '---';
            }
            if(empty($age)){
                $age = '---';
            }
            if(empty($dob)){
                $dob = '---';
            }
            if(empty($photo)){
                if($gender == 'F'){
                    $photo = 'images/default_FThumb.jpg';
                }
                else{
                    $photo = 'images/default_MThumb.jpg';
                }
            }
            
            $createsFor = $UserBInfo[0]['createsFor'];
            $aboutUser = $UserBInfo[0]['aboutUser'];
            $bodyType = $UserBInfo[0]['bodyType'];
            $complexion = $UserBInfo[0]['complexion'];
            $physicalStatus = $UserBInfo[0]['physicalStatus'];
            $height = $UserBInfo[0]['height'];
            $weight = $UserBInfo[0]['weight'];
            $motherTounge = $UserBInfo[0]['motherTounge'];
            $martialStatus = $UserBInfo[0]['martialStatus'];
            $drinkHabits = $UserBInfo[0]['drinkHabits'];
            $smokeHabits = $UserBInfo[0]['smokeHabits'];
            $eatingHabits = $UserBInfo[0]['eatingHabits'];
            $hairColor = $UserBInfo[0]['hairColor'];
        }
        else{
            $firstName = "---";
            $lastName = "---";
            $email = "---";
            $gender = "---";
            $age = "---";
            $dob = "---";
            
            $createsFor = "---";
            $aboutUser = "---";
            $bodyType = "---";
            $complexion = "---";
            $physicalStatus = "---";
            $height = "---";
            $weight = "---";
            $motherTounge = "---";
            $martialStatus = "---";
            $drinkHabits = "---";
            $smokeHabits = "---";
            $eatingHabits = "---";
            $hairColor = "---";
        }
        if($personalAcc){
            $body .= "<div  class='form-group'>";
            $body .= "<br /><h3><strong>A few words about ";  
            if($createsFor == "self"){
              $body .= "me</strong></h3>";
            }
            else    {
              $body .= "my " . $createsFor ."</strong></h3>";
            }  
            $body .= $aboutUser;
            $body .= "<div class='col-md-12' align='right'><a href='deleteAccount.php?uId={$_SESSION['loginUserId']}'>Delete Account</a><hr /></div>";
            $body .= "</div>";
        }
        else {
            $body .= "<div  class='form-group'>";
            //if(thumb)
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<br /><h3><strong>A few words about ";  
            $body .= $firstName ."</strong></h3>";
            $body .= "</div>";
        }
        $body .= "<div  class='form-group'>";
        $body .= "<table style='width: 100%;'><tr><td><h3><strong>Basic Info</strong></h3></td>";    
        $body .= "<td style='text-align: right;'>";  
        if($act!='ubdEdit'){      
            if($personalAcc){
                $body .= "<a href='profile.php?actEdit=ubdEdit'>Edit</a>";
            }
            $body .= "</td></tr></table>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Body Type:</label>";
            $body .= "<div class='col-md-3'>{$bodyType}</div>";
            $body .= "<label class='col-md-3 control-label'>Complexion:</label>";
            $body .= "<div class='col-md-3'>{$complexion}</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Physical Status:</label>";
            $body .= "<div class='col-md-3'>{$physicalStatus}</div>";
            $body .= "<label class='col-md-3 control-label'>Height:</label>";
            $body .= "<div class='col-md-3'>{$height}</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Weight:</label>";
            $body .= "<div class='col-md-3'>{$weight}</div>";
            $body .= "<label class='col-md-3 control-label'>Mother Tongue:</label>";
            $body .= "<div class='col-md-3'>{$motherTounge}</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Martial Status:</label>";
            $body .= "<div class='col-md-3'>{$martialStatus}</div>";
            $body .= "<label class='col-md-3 control-label'>Drink Habits:</label>";
            $body .= "<div class='col-md-3'>{$drinkHabits}</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Smoke Habits:</label>";
            $body .= "<div class='col-md-3'>{$smokeHabits}</div>";
            $body .= "<label class='col-md-3 control-label'>Eating Habits:</label>";
            $body .= "<div class='col-md-3'>{$eatingHabits}</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Hair Color:</label>";
            $body .= "<div class='col-md-3'>{$hairColor}</div>";
            $body .= "</div>";
        }
        else {
            $body .= "</td></tr></table>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Body Type:</label>";
            //$body .= "<div class='col-md-8'>{$bodyType}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbBodyType' value='Slim'";
            if($bodyType=='Slim'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Slim</label>";
            $body .= "<label  class='radio-inline'><input name='rdbBodyType' value='Athletic'";
            if($bodyType=='Athletic'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Athletic</label><br/>";
            $body .= "<label  class='radio-inline'><input name='rdbBodyType' value='Average'";
            if($bodyType=='Average')
                 $body .= " checked='checked'";
            $body .= " type='radio'> Average</label>";
            $body .= "<label  class='radio-inline'><input name='rdbBodyType' value='Heavy'";
            if($bodyType=='Heavy'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Heavy</label>";
            $body .= "</div>";            
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Complexion:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Very Fair'";
            if($complexion=='Very Fair'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Very Fair</label>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Fair'";
            if($complexion=='Fair'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Fair</label><br/>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Wheatish'";
            if($complexion=='Wheatish'){
                 $body .= " checked='checked'";
            }
            $body .= " type='radio'> Wheatish</label>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Wheatish Brown'";
            if($complexion=='Wheatish Brown'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Wheatish Brown</label>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Dark'";
            if($complexion=='Dark'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Dark</label>";
            $body .= "</div>";            
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Physical Status:</label>";
            //$body .= "<div class='col-md-8'>{$physicalStatus}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbPhysicalStatus' value='Normal'";
            if($physicalStatus=='Normal'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Normal</label>";
            $body .= "<label  class='radio-inline'><input name='rdbComplexion' value='Physical Chalanged'";
            if($physicalStatus=='Physical Chalanged'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Physical Chalanged</label>";
            $body .= "</div>";            
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Height:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtHeight' name='txtHeight' value='{$height}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Weight:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtWeight' name='txtWeight' value='{$weight}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Mother Tongue:</label>";
            //$body .= "<div class='col-md-8'>{$motherTounge}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtMotherTongue' name='txtMotherTongue' value='{$motherTounge}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Martial Status:</label>";
            //$body .= "<div class='col-md-8'>{$martialStatus}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<select name='ddlMStatus' id='ddlMStatus' class='form-control input-lg'>";
            $body .= "<option value='Widow'";
            if($martialStatus == 'Widow')
            {
                $body .= "selected='selected'";
            }
            $body .= ">Widow</option>";
            $body .= "<option value='Single'";
            if($martialStatus == 'Single')
            {
                $body .= "selected='selected'";
            }
            $body .= ">Single</option>";
            $body .= "<option value='Divorced'";
            if($martialStatus == 'Divorced')
            {
                $body .= "selected='selected'";
            }
            $body .= ">Divorced</option>";
            $body .= "<option value='Awaiting Divorce'";
            if($martialStatus == 'Awaiting Divorce')
            {
                $body .= "selected='selected'";
            }
            $body .= ">Awaiting Divorce</option>";
            $body .= "</select>";
            $body .= "</div>";
            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Drink Habits:</label>";
            //$body .= "<div class='col-md-8'>{$drinkHabits}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbdrinkHabits' value='No'";
            if($drinkHabits=='No'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> No</label>";
            $body .= "<label  class='radio-inline'><input name='rdbdrinkHabits' value='Yes'";
            if($drinkHabits=='Yes'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Yes</label>";
            $body .= "<label  class='radio-inline'><input name='rdbdrinkHabits' value='Social'";
            if($drinkHabits=='Social'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Social</label>";
            $body .= "</div>";            
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Smoke Habits:</label>";
            //$body .= "<div class='col-md-8'>{$smokeHabits}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbsmokeHabits' value='No'";
            if($smokeHabits=='No'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> No</label>";
            $body .= "<label  class='radio-inline'><input name='rdbsmokeHabits' value='Yes'";
            if($smokeHabits=='Yes'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Yes</label>";
            $body .= "<label  class='radio-inline'><input name='rdbsmokeHabits' value='Social'";
            if($smokeHabits=='Social'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Social</label>";
            $body .= "</div>";            
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Eating Habits:</label>";
            //$body .= "<div class='col-md-8'>{$eatingHabits}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbeatingHabits' value='Vegetarian'";
            if($eatingHabits=='Vegetarian'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Vegetarian</label>";
            $body .= "<label  class='radio-inline'><input name='rdbeatingHabits' value='Non-Veg'";
            if($eatingHabits=='Non-Veg'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Non-Veg</label>";
            $body .= "<label  class='radio-inline'><input name='rdbeatingHabits' value='Eggetarian'";
            if($eatingHabits=='Eggetarian'){
                $body .= " checked='checked'";
            }
            $body .= " type='radio'> Eggetarian</label>";
            $body .= "</div>";
            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Hair Color:</label>";
           // $body .= "<div class='col-md-8'>{$hairColor}</div>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtHairColor' name='txtHairColor' value='{$hairColor}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";            
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>&nbsp;</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='hidden' name='action' value='updBasic'/>";
            $body .= "<input type='submit' value='Update' class='btn btn-success' />&nbsp;&nbsp;&nbsp;<a href='profile.php' class='btn btn-success'>Cancel</a>";
            $body .= "</div>";            
            $body .= "</div>";
        }
  //=========================== USER FEW WORDS AND BASIC INFO SECTIONS [ENDS HERE]==================================
  
  //=========================== USER LOCATION SECTIONS [STARTS HERE]================================== 
    if(count($UserLocation)>0)
        {
            $countryName = $UserLocation[0]['countryName'];
            $state = $UserLocation[0]['state'];
            $city = $UserLocation[0]['city'];
            
            $countryId = $UserLocation[0]['countryId'];
            $stateId = $UserLocation[0]['stateId'];
            $cityId = $UserLocation[0]['cityId'];
            
            $citizen = $UserLocation[0]['citizen'];
            $residentStatus = $UserLocation[0]['residentStatus'];
        }
        else
        {      
            
            $countryId = $stateId = $cityId = 0;
            
            $countryName = $state = $city = $citizen = $residentStatus = "---";
        }
        
        $body .= "<div id='simpleDivLoc'>";
            $body .= "<div  class='form-group'>";
            $body .= "<div class='col-md-12'><hr /></div>";
            $body .= "<table style='width: 100%;'><tr><td><h3><strong>Location</strong></h3></td>";   
            $body .= "<td style='text-align: right;'>";        
            if($personalAcc){
                //$body .= "<a href='profile.php?actEdit=locEdit'>Edit</a>";
                $body .= "<a href='#' id='locEdit'>Edit</a>";
            } 
            $body .= "</td></tr></table>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Country:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblCountry' name='lblCountry' style='font-weight: normal;'>{$countryName}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Province:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblState' name='lblState' style='font-weight: normal;'>{$state}</label>";
            $body .= "</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>City:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblCity' name='lblCity' style='font-weight: normal;'>{$city}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Citizen:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblCitizen' name='lblCitizen' style='font-weight: normal;'>{$citizen}</label>";
            $body .= "</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Resident Status:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label style='font-weight: normal;' id='lblResident' name='lblResident'>{$residentStatus}</label>";
            $body .= "</div>";
            $body .= "</div>";   
        $body .= "</div>";                   

        $body .= "<div id='editDivLoc'>";
            $body .= "<div  class='form-group'>";
            $body .= "<div class='col-md-12'><hr /></div>";
            $body .= "<table style='width: 100%;'><tr><td><h3><strong>Location</strong></h3></td>";   
            $body .= "<td style='text-align: right;'></td></tr></table>"; 
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Country:</label>"; 
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='hidden' name='hdnCountryId' id='hdnCountryId' value='{$countryId}'/>";
            $body .= "<select name='ddlCountry' id='ddlCountry' class='form-control input-lg' onchange='loadStates();'>";
            $body .= "</select>";
            $body .= "</div>";
            $body .= "</div>";

            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Province:</label>";
            $body .= "<div class='col-md-8'>";            
            $body .= "<input type='hidden' name='hdnStateId' id='hdnStateId' value='{$stateId}'/>";
            $body .= "<select name='ddlStates' id='ddlStates' class='form-control input-lg' onchange='loadCities();'>";
            $body .= "</select>";
            $body .= "</div>";
            $body .= "</div>";

            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>City:</label>";
            $body .= "<div class='col-md-8'>";            
            $body .= "<input type='hidden' name='hdnCityId' id='hdnCityId' value='{$cityId}'/>";
            $body .= "<select name='ddlCities' id='ddlCities' class='form-control input-lg'>";
            $body .= "</select>";
            $body .= "</div>";
            $body .= "</div>";

            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Citizen:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtCitizen' name='txtCitizen' value='{$citizen}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Resident Status:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtResident' name='txtResident' value='{$residentStatus}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";  
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>&nbsp;</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='submit' name='updLoc' id='updLoc' value='Update' class='btn btn-success' />&nbsp;&nbsp;&nbsp;";
            $body .= "<a href='#' id='cancDivLoc' class='btn btn-success'>Cancel</a>";
            $body .= "</div>";            
            $body .= "</div>";
        $body .= "</div>";            
        
  //=========================== USER LOCATION SECTIONS [ENDS HERE]==================================
    
  //=========================== USER FAMILY DETAILS SECTIONS [STARTS HERE]==================================
        if(count($UserFDet)>0)
        {
            $livingWith = $UserFDet[0]['livingWith'];
            $familyType = $UserFDet[0]['familyType'];
            $familyValues = $UserFDet[0]['familyValues'];
            $familyStatus = $UserFDet[0]['familyStatus'];
            $noOfSisters = $UserFDet[0]['noOfSisters'];
            $noOfBrothers = $UserFDet[0]['noOfBrothers'];
            $marriedSisters = $UserFDet[0]['marriedSisters'];
            $marriedBrothers = $UserFDet[0]['marriedBrothers'];
            $fatherOccupation = $UserFDet[0]['fatherOccupation'];
            $motherOccupation = $UserFDet[0]['motherOccupation'];
        }
        else
        {      
            $livingWith = $familyType = $familyValues = $familyStatus = "---"; 
            $marriedSisters = $marriedBrothers = $fatherOccupation = $motherOccupation = "---";
            $noOfSisters = $noOfBrothers = "0";
        }
        
        $body .= "<div id='simpleDivFamDet'>";
            $body .= "<div  class='form-group'>";
            $body .= "<div class='col-md-12'><hr /></div>";
            $body .= "<table style='width: 100%;'><tr><td><h3><strong>Family Details</strong></h3></td>";    
            $body .= "<td style='text-align: right;'>";        
            if($personalAcc){
                //$body .= "<a href='profile.php?actEdit=famDetEdit'>Edit</a>";
                $body .= "<a href='#' id='famDetEdit'>Edit</a>";
            }
            $body .= "</td></tr></table>"; 
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Living With:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblLivingW' name='lblLivingW' style='font-weight: normal;'>{$livingWith}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Family Type:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblFType' name='lblFType' style='font-weight: normal;'>{$familyType}</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Family Values:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblFValue' name='lblFValue' style='font-weight: normal;'>{$familyValues}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Family Status:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblFStat' name='lblFStat' style='font-weight: normal;'>{$familyStatus}</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Brothers:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblNumBros' name='lblNumBros' style='font-weight: normal;'>{$noOfBrothers}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Sisters:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblNumSis' name='lblNumSis' style='font-weight: normal;'>{$noOfSisters}</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Married Sisters:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblMSis' name='lblMSis' style='font-weight: normal;'>{$marriedSisters}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Married Brothers:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblMBros' name='lblMBros' style='font-weight: normal;'>{$marriedBrothers}</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-3 control-label'>Father Occupation:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblFOcc' name='lblFOcc' style='font-weight: normal;'>{$fatherOccupation}</label>";
            $body .= "</div>";
            $body .= "<label class='col-md-3 control-label'>Mother Occupation:</label>";
            $body .= "<div class='col-md-3'>";
            $body .= "<label id='lblMOcc' name='lblMOcc' style='font-weight: normal;'>{$motherOccupation}</label>";
            $body .= "</div>";
            $body .= "</div>";
        $body .= "</div>";          
        
        $body .= "<div id='editDivFamDet'>";
            $body .= "<div  class='form-group'>";
            $body .= "<div class='col-md-12'><hr /></div>";
            $body .= "<table style='width: 100%;'><tr><td><h3><strong>Family Details</strong></h3></td>";    
            $body .= "<td style='text-align: right;'>";  
            $body .= "</td></tr></table>"; 
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Living With:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbLiv' value='Parents'";
            $body .= " type='radio'> Parents</label>";
            $body .= "<label  class='radio-inline'><input name='rdbLiv' value='Alone'";
            $body .= " type='radio'> Alone</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Family Type:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbFamType' value='Joint Family'";
            $body .= " type='radio'> Joint Family</label>";
            $body .= "<label  class='radio-inline'><input name='rdbFamType' value='Nuclear'";
            $body .= " type='radio'> Nuclear</label>";
            $body .= "<label  class='radio-inline'><input name='rdbFamType' value='Others'";
            $body .= " type='radio'> Others</label>";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Family Values:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbFamVal' value='Traditional'";
            $body .= " type='radio'> Traditional</label>";
            $body .= "<label  class='radio-inline'><input name='rdbFamVal' value='Moderate'";
            $body .= " type='radio'> Moderate</label>";
            $body .= "<label  class='radio-inline'><input name='rdbFamVal' value='Liberal'";
            $body .= " type='radio'> Liberal</label>";
            $body .= "<label  class='radio-inline'><input name='rdbFamVal' value='Orthodox'";
            $body .= " type='radio'> Orthodox</label>";            
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Family Status:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<label  class='radio-inline'><input name='rdbFamStat' value='Middle Class'";
            $body .= " type='radio'> Middle Class</label>"; 
            $body .= "<label  class='radio-inline'><input name='rdbFamStat' value='Upper Middle Class'";
            $body .= " type='radio'> Upper Middle Class</label>";  
            $body .= "<label  class='radio-inline'><input name='rdbFamStat' value='Rich'";
            $body .= " type='radio'> Rich</label>"; 
            $body .= "<label  class='radio-inline'><input name='rdbFamStat' value='Affluent'";
            $body .= " type='radio'> Affluent</label>";             
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Brothers:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtNumBro' name='txtNumBro' value='{$noOfBrothers}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Sisters:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtNumSis' name='txtNumSis' value='{$noOfSisters}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Married Sisters:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtMrdSis' name='txtMrdSis' value='{$marriedSisters}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Married Brothers:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtMrdBro' name='txtMrdBro' value='{$marriedBrothers}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Father Occupation:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtFatherOcc' name='txtFatherOcc' value='{$fatherOccupation}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>Mother Occupation:</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='text' id='txtMotherOcc' name='txtMotherOcc' value='{$motherOccupation}' class='form-control input-md input-lg' required='required' />";
            $body .= "</div>";
            $body .= "</div>";
            $body .= "<div  class='form-group'>";
            $body .= "<label class='col-md-4 control-label'>&nbsp;</label>";
            $body .= "<div class='col-md-8'>";
            $body .= "<input type='submit' name='updFamDet' id='updFamDet' value='Update' class='btn btn-success' />&nbsp;&nbsp;&nbsp;";
            $body .= "<a href='#' id='cancFamDet' class='btn btn-success'>Cancel</a>";
            $body .= "</div>";            
            $body .= "</div>";
        $body .= "</div>";          
  //=========================== USER FAMILY DETAILS SECTIONS [ENDS HERE]==================================
  //
  //=========================== USER PROFESSIONAL SECTIONS [STARTS HERE]==================================
        if(count($UserProf)>0)
        {
            $education = $UserProf[0]['education'];
            $college = $UserProf[0]['college'];
            $additionalDegree = $UserProf[0]['additionalDegree'];
            $occupation = $UserProf[0]['occupation'];
            $employedIn = $UserProf[0]['employedIn'];
            $annualIncome = $UserProf[0]['annualIncome'];
        }
        else
        {      
            $education = $college = $additionalDegree = $occupation = $employedIn = $annualIncome = "---";
        }
        $body .= "<div  class='form-group'>";
        $body .= "<div class='col-md-12'><hr /></div>";
        $body .= "<table style='width: 100%;'><tr><td><h3><strong>Professional Details</strong></h3></td>";    
        $body .= "<td style='text-align: right;'>";        
        if($personalAcc){
            $body .= "<a href='profile.php?actEdit=ProfDet'>Edit</a>";
        }
        $body .= "</td></tr></table>"; 
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Education:</label>";
        $body .= "<div class='col-md-3'>{$education}</div>";
        $body .= "<label class='col-md-3 control-label'>College:</label>";
        $body .= "<div class='col-md-3'>{$college}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Additional Degree:</label>";
        $body .= "<div class='col-md-3'>{$additionalDegree}</div>";
        $body .= "<label class='col-md-3 control-label'>Occupation:</label>";
        $body .= "<div class='col-md-3'>{$occupation}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Employed In:</label>";
        $body .= "<div class='col-md-3'>{$employedIn}</div>";
        $body .= "<label class='col-md-3 control-label'>Annual Income:</label>";
        $body .= "<div class='col-md-3'>{$annualIncome}</div>";
        $body .= "</div>";
  //=========================== USER PROFESSIONAL DETAILS SECTIONS [ENDS HERE]==================================
    
  //
  //=========================== USER HOBBIES SECTIONS [STARTS HERE]==================================
        if(count($UserHobbies)>0)
        {
            $hobbies = $UserHobbies[0]['hobbies'];
            $interests = $UserHobbies[0]['interests'];
            $dressStyle = $UserHobbies[0]['DressStyle'];
            $spokenLanguage = $UserHobbies[0]['spokenLanguage'];
        }
        else
        {      
            $hobbies = $interests = $dressStyle = $spokenLanguage = "---";
        }
        $body .= "<div  class='form-group'>";
        $body .= "<div class='col-md-12'><hr /></div>";
        $body .= "<table style='width: 100%;'><tr><td><h3><strong>Hobbies and Interests</strong></h3></td>";      
        $body .= "<td style='text-align: right;'>";        
        if($personalAcc){
            $body .= "<a href='profile.php?actEdit=hopEdit'>Edit</a>";
        }
        $body .= "</td></tr></table>"; 
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Hobbies:</label>";
        $body .= "<div class='col-md-3'>{$hobbies}</div>";
        $body .= "<label class='col-md-3 control-label'>Interests:</label>";
        $body .= "<div class='col-md-3'>{$interests}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Dress Style:</label>";
        $body .= "<div class='col-md-3'>{$dressStyle}</div>";
        $body .= "<label class='col-md-3 control-label'>Spoken Language:</label>";
        $body .= "<div class='col-md-3'>{$spokenLanguage}</div>";
        $body .= "</div>";
  //=========================== USER PROFESSIONAL DETAILS SECTIONS [ENDS HERE]==================================
    
    
  //=========================== USER PARTNER PREFERENCES SECTIONS [STARTS HERE]==================================
        if(count($UserPPref)>0)
        {
            $ageFrom = $UserPPref[0]['ageFrom'];
            $ageTo = $UserPPref[0]['ageTo'];
            $religion = $UserPPref[0]['religion'];
            $cast = $UserPPref[0]['cast'];
            $country = $UserPPref[0]['country'];
            $residentStatus = $UserPPref[0]['residentStatus'];
            $citizen = $UserPPref[0]['citizen'];
            $height = $UserPPref[0]['height'];
        }
        else
        {      
            $ageFrom = $ageTo = $religion = $cast = $country = $residentStatus = $citizen = $height = "---";
        }
        $body .= "<div  class='form-group'>";
        $body .= "<div class='col-md-12'><hr /></div>";
        $body .= "<table style='width: 100%;'><tr><td><h3><strong>Partner Preferences</strong></h3></td>";      
        $body .= "<td style='text-align: right;'>";        
        if($personalAcc){
            $body .= "<a href='profile.php?actEdit=partEdit'>Edit</a>";
        }
        $body .= "</td></tr></table>"; 
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Age From:</label>";
        $body .= "<div class='col-md-3'>{$ageFrom}</div>";
        $body .= "<label class='col-md-3 control-label'>Age To:</label>";
        $body .= "<div class='col-md-3'>{$ageTo}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Religions:</label>";
        $body .= "<div class='col-md-3'>{$religion}</div>";
        $body .= "<label class='col-md-3 control-label'>Cast:</label>";
        $body .= "<div class='col-md-3'>{$cast}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Country:</label>";
        $body .= "<div class='col-md-3'>{$country}</div>";
        $body .= "<label class='col-md-3 control-label'>Resident Status:</label>";
        $body .= "<div class='col-md-3'>{$residentStatus}</div>";
        $body .= "</div>";
        $body .= "<div  class='form-group'>";
        $body .= "<label class='col-md-3 control-label'>Citizen:</label>";
        $body .= "<div class='col-md-3'>{$citizen}</div>";
        $body .= "<label class='col-md-3 control-label'>Height:</label>";
        $body .= "<div class='col-md-3'>{$height}</div>";
        $body .= "</div>";
  //=========================== USER PROFESSIONAL DETAILS SECTIONS [ENDS HERE]==================================
        $body .= "</form>";
        
 $objPage->displayPage($body);
?>