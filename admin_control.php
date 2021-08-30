<?php 
ob_start();
date_default_timezone_set('Asia/Kolkata');

require_once'connection.php';
require_once'includes/functions.php';
//session_start();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
switch ($action) {
case 'approve_meeting' :approve_meeting($pdo); break;
case 'invitebids' :invitebids($pdo); break;
case 'adminlogin' :adminlogin($pdo); break;
case 'approvepayment' :approvepayment($pdo); break;
case 'createadmin' :createadmin($pdo); break;

default : header('Location: /index.php'); 

}

function createadmin($pdo)
{
    $user_name = $_REQUEST['name'];
    $user_email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $con_password = $_REQUEST['con_password'];
    $role = $_REQUEST['role'];

    if($user_name == '' || $user_email == '' || $password == '' || $con_password == '' || $role == '')
    {
        echo "all filled compulsory";
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$user_name))
    {
        echo "name only letter";
    }
    else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid email format";
    }
    else if($password != $con_password)
    {
        echo "your password and confirm password not match";
    }
    else
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
                'user_name'=>$_REQUEST['name'],
                'user_email'=>$_REQUEST['email'],
                'password'=>$password,
                'role'=>$_REQUEST['role'],
            );
        $stmt = $pdo->prepare("INSERT INTO tbl_administrator (user_name, user_email, password, role) VALUES (:user_name, :user_email, :password, :role)");
        $stmt->execute($data);
    }
    echo "ok";
}


function approvepayment($pdo){    
    $data = array(
                'is_payment'=>1,
                'did'=>$_REQUEST['did']
            );
    $stmt = $pdo->prepare("update tbl_register set is_payment = :is_payment where reg_id = :rid");
    $stmt->execute($data);
}

function adminlogin($pdo){
	if (!filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Missing/Invalid email address';
        header('location:index.php');
        exit();
    } elseif (empty($_POST['password'])) {
        $_SESSION['error'] = 'Missing password';
        header('location:index.php');
        exit();
    }
    //echo $_POST['email'];

$sql = "SELECT * FROM tbl_administrator WHERE user_email=:username and status=1";

$stmt = $pdo->prepare($sql);
$stmt->bindParam('username', $_POST['email']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['password'], $result['password'])) {
      $_SESSION['recid'] = $result['recid'];
      $_SESSION['role'] = $result['role'];
      header('Location: society-list.php');
      exit();
            }
    else{
            $_SESSION['error'] = '<div class="text-center mt-3"><label class="error">Email & Password does not match</label></div>';
            header('Location: index.php');
            exit();
          }

}

function invitebids($pdo){
	$data = array(
				'status'=>1,
				'rid'=>$_REQUEST['rid']
			);
	$stmt = $pdo->prepare("update tbl_bid_initiate set status = :status where recid = :rid");
    $stmt->execute($data);
}

function approve_meeting($pdo){
	$data = array(
				'meetingid'=>$_REQUEST['meetingid'],
				'zoom_link' => $_REQUEST['zoom_link'],
				'status' => 1
			);
	$meeting = getmeetingbyid($pdo, $_REQUEST['meetingid']);
	$members = socityMember($pdo, $meeting['regid']);
	foreach($members as $member){
		$var = array(
					'zoom_link'=>$_REQUEST['zoom_link'],
					'date'=>date("d/m/Y", strtotime($meeting['date'])),
					'time'=>date("h:i A", strtotime($meeting['starttime']))." - ".date("h:i A", strtotime($meeting['endtime']))
				);
 
		sendsms($var, $member['mobileno'], 1207162823570682045);
		//sendsms($var, 6264276866, 1207162823570682045);
	}


    $stmt = $pdo->prepare("update tbl_society_meetings set zoom_link = :zoom_link, status = :status where recid = :meetingid");
    $stmt->execute($data);

}
