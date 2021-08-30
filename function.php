
<?php 

include('connection.php');

function myprofiledetails($reg_id,$pdo){

// $query='SELECT * FROM `tbl_register` as r LEFT join tbl_societyMyprofile as ms on r.reg_id=ms.reg_id WHERE r.reg_id=(SELECT MAX(secretary_id) AS s_id
// FROM tbl_societyMyprofile where reg_id='.$reg_id.'  GROUP BY reg_id DESC ) and r.is_active=1';


// $query='SELECT * FROM tbl_register as r left JOIN tbl_societyMyprofile as m on r.reg_id = m.reg_id WHERE m.secretary_id =(SELECT MAX(secretary_id) AS c_id FROM tbl_societyMyprofile where reg_id ='.$reg_id.' GROUP BY reg_id DESC) and r.is_active=1';

// $query='SELECT r.*, X.*
// FROM   tbl_register AS r
//        LEFT JOIN (select sp.* from tbl_societyMyprofile sp
//                     INNER JOIN(
//                     select reg_id, MAX(secretary_id) secretary_id
//                     FROM tbl_societyMyprofile
//                     GROUP BY reg_id)T ON sp.reg_id = T.reg_id and sp.secretary_id = T.secretary_id
//                  ) X ON r.reg_id = X.reg_id
// WHERE r.reg_id='.$reg_id;

$query='SELECT * FROM tbl_register t LEFT JOIN tbl_societyMyprofile s USING(reg_id) WHERE t.reg_id='.$reg_id.' ORDER BY s.date_of_added DESC LIMIT 1';

$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();


// echo "<pre>";
// print_r($row);
return $row;
}



function societyprofile($reg_id,$pdo){
// $query='SELECT *,(CASE WHEN propertyType =1 THEN "Apartment" ELSE "Society" END) as protype, (CASE WHEN propertyRegisterd =1 THEN "Registered" ELSE "Not registered " END) as proregister FROM `tbl_societyprofile` WHERE  reg_id="'.$reg_id.'" and is_active=1';

$query='SELECT *,(CASE WHEN propertyType =1 THEN "Apartment" ELSE "Society" END) as protype,(CASE WHEN propertyRegisterd =1 THEN "Registered" ELSE "Not registered " END) as proregister FROM `tbl_societyprofile` WHERE  sp_id=(SELECT MAX(sp_id) FROM tbl_societyprofile where reg_id ='.$reg_id.' GROUP BY reg_id order by reg_id DESC)  and is_active=1';

$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();

$data['societyprofile']=$row;
 
if (!empty($row)) {
$query2='SELECT * FROM `tbl_uploadAll` WHERE society_id='.$reg_id.' and is_active=1';
$stmt = $pdo->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetchAll();
$data['uploadedDoc']=$row2;

}


//print_r($data);
return $data;
}







/*developer profile*/
function developerProfile($reg_id,$pdo){

$query='SELECT * FROM tbl_register t LEFT JOIN tbl_developerMyprofile s USING(reg_id) WHERE t.reg_id='.$reg_id.'  ORDER BY s.date_of_added DESC LIMIT 1';

$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();


$data['developerprofile']=$row;

if (!empty($row)) {
$query2='SELECT * FROM `tbl_developer_addFounder` WHERE developer_id='.$row['reg_id'].'  and is_active=1';
$stmt = $pdo->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetchAll();
$data['founderlist']=$row2;

}
if (!empty($row)) {
$query3='SELECT *, (CASE WHEN tag_project =1 THEN "Landmark Projects" WHEN tag_project =2 THEN "Upcoming Projects" WHEN tag_project =3 THEN "Completed Projects" ELSE "Ongoing Projects" END) as tagProjct FROM `tbl_developer_addProject` WHERE developer_id='.$row['reg_id'].' and is_active=1';
$stmt = $pdo->prepare($query3);
$stmt->execute();
$row3 = $stmt->fetchAll();
$data['projectlist']=$row3;

}


return $data;
}



function developereditProfile($reg_id,$pdo){
  $query='SELECT * FROM tbl_developerProfile_draft where developer_id ='.$reg_id;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch();
  //print_r($row); die();
  if(empty($row)){
        $query='SELECT * FROM tbl_register t LEFT JOIN tbl_developerMyprofile s USING(reg_id) WHERE t.reg_id='.$reg_id.'  ORDER BY s.date_of_added DESC LIMIT 1';

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(); 

        $data['developerprofile']=$row; 
        $data['developerprofile']['uploadedDoc']=unserialize($data['developerprofile']['uploadedDoc']);
        
        if (!empty($row)) {
        $query2='SELECT founder_id, `founder_name`, `founder_pic`, `founder_des`, `founder_qua`, `founder_y_sevices`, `founder_vision`, `founder_about`, `developer_id` FROM `tbl_developer_addFounder` WHERE developer_id='.$row['reg_id'].' and is_active=1';
        $stmt = $pdo->prepare($query2);
        $stmt->execute();
        $row2 = $stmt->fetchAll();
        $data['founderlist']=$row2;

        }
        if (!empty($row)) {
        //$query3='SELECT *, (CASE WHEN tag_project =1 THEN "Landmark Projects" WHEN tag_project =2 THEN "Upcoming Projects" WHEN tag_project =3 THEN "Completed Projects" ELSE "Ongoing Projects" END) as tagProjct FROM `tbl_developer_addProject` WHERE developer_id='.$row['reg_id'].' and is_active=1';
        $query3='SELECT p_id, `project_name`, `timeframe`, `tag_project`, `projectlogo`, `project_elevation_pic`, `room_pic`, `specific_amenities`,`vendors`,`developer_id` FROM `tbl_developer_addProject` WHERE developer_id='.$row['reg_id'].' and is_active=1';
        $stmt = $pdo->prepare($query3);
        $stmt->execute();
        $row3 = $stmt->fetchAll();
        $data['projectlist']=$row3;

        }
  }else{ 
        $data['developerprofile']=unserialize($row['profiledata']);
        $data['developerprofile']['uploadedDoc'] = unserialize($data['developerprofile']['uploadedDoc']);
        //print_r($data['developerprofile']['uploadedDoc']); die();
        $data['founderlist']=json_decode($row['founderdata']);
        $data['projectlist']=json_decode($row['projectdata']);
  }
return $data;
}



function getgeneralSpecifications($pdo){
$query='SELECT * FROM `tbl_specifications` WHERE is_active=1 and specifications_Cat=1';
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
// die();
return $result;

}

// function getmainCategory($pdo){
// $query='SELECT * FROM `tbl_specifications` WHERE is_active=1 and specifications_Cat=2';
// $stmt = $pdo->prepare($query);
// $stmt->execute();
// $result = $stmt->fetchAll();
// // die();
// return $result;

// }





//get founder edit info
if (isset($_POST['getfounder'])) {
 $getfounderdata= getFounderInfo($pdo,$_POST['id']);
  echo json_encode($getfounderdata);
    //exit();
}

function getFounderInfo($pdo,$founderid){
$query='SELECT * FROM `tbl_developer_addFounder` WHERE founder_id='.$founderid.' and is_active=1';
$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();

return $row;

}


// get project info
if (isset($_POST['getproject'])) {
 $getprojectdata= getprojectInfo($pdo,$_POST['id']);
echo json_encode($getprojectdata);
    //exit();

}

if(isset($_REQUEST['unserializedData']) && !empty($_REQUEST['unserializedData'])){
  $data =  unserialize($_REQUEST['unserializedData']);
  echo json_encode($data);
}

function getprojectInfo($pdo,$pid){
$query='SELECT * FROM `tbl_developer_addProject` WHERE p_id='.$pid.' and is_active=1';
$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();
return $row;
}

// function format_size($size) {
//       $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
//       if ($size == 0) { return('n/a'); } else {
//       return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
// }
 ?>