<?php
require_once 'Database.php';
require_once 'commonDB.php';
require_once 'userInfoDB.php';

extract($_REQUEST);

$response;
$result;
switch ($data)
{
    case 'getCountries':
	$response = commonDB::getCountries();
        $result = array();   
        foreach ($response as $cnt):
            $set = array("countryId" => $cnt['countryId'],"countryName"=>$cnt['countryName']);         
            $result[]=$set;
        endforeach;
        break;
    case 'getStates':
	$response = commonDB::getStates($cntryId);
        $result = array();   
        foreach ($response as $st):
            $set = array("stateId" => $st['stateId'],"state"=>$st['state']);         
            $result[]=$set;
        endforeach;
        break;
    case 'getCities':
	$response = commonDB::getCities($stId);
        $result = array();   
        foreach ($response as $ct):
            $set = array("cityId" => $ct['cityId'],"city"=>$ct['city']);         
            $result[]=$set;
        endforeach;
        break;
    case 'updateLoc':
        $response = userInfoDB::updateUserLocation($uid, $cntryId, $sttId, $ctyid, $citiz, $res);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    case 'updateFamDet':
        $response = userInfoDB::updateFamilyDetails($uid, $liveWith, $fType, $fVal, $fState, $nBros, $nSis, $marriedBros, $marriedSis, $fatherOcc, $motherOcc);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    case 'updateProfDet':
        $response = userInfoDB::updateProfessionalDetails($uid, $educ, $colg, $adegree, $occup, $empdin, $anninc);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    case 'updateHobbies':
        $response = userInfoDB::updateUserHobbies($uid, $hobs, $ints, $dS, $langs);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    case 'updatePartnerPref':
        $response = userInfoDB::updateUserPartnerPrefs($uid, $fromAge, $toAge, $contrs);
        if($response)
        {
            $result = true;
        }
        else 
            {
                $result = false;
            }
        break;
    default:
        $result = "fail";            
}
echo json_encode($result);
?>