<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set("Asia/Calcutta");

function userinfo($pdo, $userid, $fields='*'){
	$sql = "SELECT ".$fields." FROM tbl_register WHERE reg_id=:userid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array('userid'=>$userid));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getuserbyemail($pdo, $email){
	$sql = "SELECT reg_id,name FROM tbl_register WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array('email'=>$email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function randomotp($length = 6){
	$characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendsms($var, $number, $temp=1207162377088337176){
	$msg = '';
	if($temp==1207162377088337176){
		$msg = "Hello, ".$var[0]." is OTP for registering on Dreamsredeveloped. Please do not share this OTP. Thanks! ";
	}elseif($temp==1207162632082044742){
		$msg = "Dear ".$var['name']."\nSecretary/Chairman of ".$var['society_name']." is inviting you to join them on Dreamsredeveloped for Redevelopment process. Please join using this link ".$var['url']." \nThanks! ";
	}elseif($temp==1207162823570682045){
		$msg = "Dear Member,\nKindly find the Society Meeting link here - ".$var['zoom_link']."\nDate- ".$var['date']."\nTime- ".$var['time']."\nBest regards,\nDreamsredeveloped";
	}

	//print_r($msg);
 	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=zOJwD2nQ2EGnwUMPTxNC3g&senderid=DRMSRD&channel=2&DCS=0&flashsms=0&number=91".$number."&text=".urlencode($msg)."&route=1&EntityId=1201162280257880776&dlttemplateid=".$temp,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
	"cache-control: no-cache"
	),
	));

	$response = curl_exec($curl);
	//print_r($response); 
	//die();
	$err = curl_error($curl);

	curl_close($curl);
}

function sendmail($data){

	require '../assets/PHPMailer/src/Exception.php';
	require '../assets/PHPMailer/src/PHPMailer.php';
	require '../assets/PHPMailer/src/SMTP.php';
	$mail = new PHPMailer;
	$mail->setFrom('admin@dreamsredeveloped.com', 'Dreams Redeveloped');
	$mail->addAddress($data['email']);
	$mail->Subject = $data['subject'];
	$mail->Body = $data['msg'];

	$mail->isHTML(true);
	$mail->IsSMTP();
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'ssl://smtp.gmail.com';
	$mail->SMTPAuth = true;
	//$mail->SMTPDebug  = 2;
	$mail->Port = 465;
	$mail->Username = 'admin@dreamsredeveloped.com';
	$mail->Password = 'Dreams#@12345';
	/*if(!$mail->send()) {
	  echo 'Email is not sent.';
	  echo 'Email error: ' . $mail->ErrorInfo;
	} else {
	  echo 'Email has been sent.';
	}*/
	return $mail->send();
}

function update_user($pdo, $reg_id, $field, $value){
    $data['id'] = $reg_id;
    $data['value'] = $value;
    $sql="update `tbl_register` set ".$field." = :value where reg_id=:id";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute($data)){
    	return 1;
    }else{
    	return 0;
    }
}

function notify_admin_in($pdo, $id){
	$userinfo = userinfo($pdo, $id, 'payment_notify');
	$last_admin_notify = $userinfo['payment_notify'];
	$last = (strtotime(date("Y/m/d H:i:s"))-strtotime($last_admin_notify))/60;
	return $last;
}

function getinviteinfo($pdo, $recid){
	$sql = "SELECT recid,society_id,name,phone, sp.societyName as society_name FROM tbl_society_invites i left join tbl_societyprofile sp on i.society_id = sp.reg_id WHERE i.recid=:recid and is_registered IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array('recid'=>$recid));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;	
}

function getsocietynamebyId($pdo, $id){

	$sql = "SELECT societyName FROM tbl_societyprofile WHERE reg_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array('id'=>$id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result['societyName'];
}

function getinviteurl($siteUrl, $society_id, $invite_id=0, $phone=0){
	$url = $siteUrl."regsterinvites/".base64_encode(base64_encode($society_id).'||'.base64_encode($invite_id).'||'.base64_encode($phone));
	$url = file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
	return $url;
}

function trimname($doc){
	$ext = pathinfo($doc, PATHINFO_EXTENSION);
	$doc = basename($doc, $ext); 
	if(strlen($doc) > 10){
		$doc = substr_replace($doc, '...', 6, -6);
	}
	return $doc.$ext;
}

function lastdraftedon($pdo, $uid){
	$sql = $pdo->prepare("select last_updated from tbl_societyprofile_draft where user_id={$uid}");
	$sql->execute();
	$data = $sql->fetchAll(); 
	if(!empty($data)){
		return "Last Saved  on  ".date("d.m.Y h:i: A", strtotime($data[0]['last_updated']));
	}else{
		return 'No Draft Saved.';
	}
}

function isdevdraft($pdo, $uid){
	$sql = $pdo->prepare("select datetime from tbl_developerProfile_draft where developer_id={$uid}");
	$sql->execute();
	$data = $sql->fetchAll(); 
	if(!empty($data)){
		return date("d.m.Y h:i: A", strtotime($data[0]['datetime']));
	}
}

function socityMember($pdo, $society_id){
	$sql = $pdo->prepare("select u.reg_id, u.name, p.flatno_shopno, u.mobileno from tbl_register u left join tbl_societyMyprofile p on u.reg_id = p.reg_id where society_id={$society_id}");
	$sql->execute();
	$data = $sql->fetchAll(); 
	return $data;
}

function getAllmeetings($pdo, $userid='', $type='', $role=1){
	$con = ''; $rolecom = '';
	if($role==2){
		$rolecom = ' or (regid = (select society_id from tbl_register where reg_id='.$userid.')  and m.zoom_link is not null) ';
	}
	if(!empty($userid)){ $con.= " and (regid = ".$userid.$rolecom.")"; }
	if(!empty($type) && $type == 1){ $con.= " and concat(date,' ',endtime) >= '".date("Y-m-d H:i:s")."'"; }
	if(!empty($type) && $type == 2){ $con.= " and concat(date,' ',endtime) < '".date("Y-m-d H:i:s")."'"; }
 
 	$query= "SELECT m.*, s.propertyname FROM `tbl_society_meetings` m left join tbl_register s on m.regid = s.reg_id where 1= 1 {$con} order by m.date ASC";
	$sql = $pdo->prepare($query);
	$sql->execute();
	$meetings = $sql->fetchAll();
	return $meetings;
} 

function getmeetingbyid($pdo, $mid){
	$sql = $pdo->prepare("SELECT * FROM `tbl_society_meetings` where recid =".$mid);
	$sql->execute();
	$meeting = $sql->fetchAll();
	return $meeting[0];
}

function revelopmentprogress($pdo, $society_id){
	$sql = $pdo->prepare("SELECT count(is_registered) as total, sum(case p.willingredevelopment when 1 then 1 else 0 end) as consentyes FROM `tbl_society_invites` i left join tbl_societyMyprofile p on i.is_registered = p.reg_id   where i.society_id = ".$society_id." and is_registered is not null");
	$sql->execute();
	$consent = $sql->fetch();
	//print_r($consentyes);
	if(!empty($consent) && $consent['total'] > 0){
		return round(($consent['consentyes']/$consent['total'] ) * 100);
	}else{
		return 0;
	}
}

function documentprogress($pdo, $documents){
	if(!empty($documents)){
		$docs = count($documents);
		$total = $docs < 7 ? 7 :  $docs;
		return round(($docs/$total)*100);
	}else{
		return 0;
	}
}

function profileprogress($pdo, $infos){
	$i = 0;
	foreach($infos as $info){
		if(!empty($info)){ $i++; }
	}
	return round(($i/count($infos))*100);
}

function society_profile_data($reg_id,$pdo){
  $query='SELECT * FROM tbl_societyprofile_draft where user_id ='.$reg_id;
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch();
  if(empty($row)){
    $query='SELECT *,(CASE WHEN propertyType =1 THEN "Apartment" ELSE "Society" END) as protype,(CASE WHEN propertyRegisterd =1 THEN "Registered" ELSE "Not registered " END) as proregister FROM `tbl_societyprofile` WHERE  sp_id=(SELECT MAX(sp_id) FROM tbl_societyprofile where reg_id ='.$reg_id.' GROUP BY reg_id order by reg_id DESC)  and is_active=1';

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();

    if(!empty($row)){
      $query2='SELECT * FROM `tbl_uploadAll` WHERE society_id='.$reg_id.' and is_active=1';
      $stmt = $pdo->prepare($query2);
      $stmt->execute();
      $row2 = $stmt->fetchAll();
      $data['uploadedDoc']=$row2;

      $row['isdraft'] = 0;
    }
  }else{
    $row = unserialize($row['profiledata']);
    $row['isdraft'] = 1;
    $data['uploadedDoc']=unserialize($row['uploaded_doc']);
    unset($row['uploaded_doc']);
  }
  if(!empty($row)){
    $data['societyprofile']=$row;
    return $data;
  }
}

function isinitiated($pdo,$society_id){
	$sql = $pdo->prepare("SELECT recid FROM `tbl_bid_initiate` where reg_id=".$society_id);
	$sql->execute();
	$bid = $sql->fetch();
	return $bid['recid'] ?? '';
}


function getbidrequests($pdo){
  $stmt = $pdo->prepare('SELECT br.recid, br.datetime, br.status, sp.* FROM `tbl_bid_initiate` br left join tbl_societyprofile sp on br.reg_id = sp.reg_id order by br.recid desc');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getActivebidrequests($pdo){
  $stmt = $pdo->prepare('SELECT br.recid, br.datetime, br.status, sp.* FROM `tbl_bid_initiate` br left join tbl_societyprofile sp on br.reg_id = sp.reg_id where br.status = 1 order by br.recid desc');
  $stmt->execute();
  return $stmt->fetchAll();
}
?>
