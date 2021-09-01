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
case 'fetchAdmin' :fetchAdmin($pdo); break;
case 'updateadmin' :updateadmin($pdo); break;
case 'archiveAdmin' :archiveAdmin($pdo); break;

default : header('Location: /index.php');

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


function createadmin($pdo)
{
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $role = $_POST['role'];


    if(empty($user_name) || empty($user_email) || empty($password) || empty($con_password) || empty($role))
    {
        echo "All Filled Compulsory.";
        exit();
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$user_name))
    {
        echo "Only Letter Format.";
        exit();
    }
    else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid Email ID Format.";
        exit();
    }
    else if($password != $con_password)
    {
        echo "Your Password and Confirm Password Not Match.";
        exit();
    }
    
    $sql = "SELECT user_email FROM tbl_administrator WHERE user_email=:username and status=1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('username', $user_email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) 
    {
        echo "Already Email ID Exist";
        exit();
    } 
    else 
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'password'=>$password,
                'role'=>$role,
            );

        $stmt2 = $pdo->prepare("INSERT INTO tbl_administrator (user_name, user_email, password, role) VALUES (:user_name, :user_email, :password, :role)");
        $stmt2->execute($data);
        
        
        echo 1;
    }
}

function fetchAdmin($pdo)
{
    $sql = "SELECT recid,user_name,user_email,password,role FROM tbl_administrator WHERE recid=:recid and status=1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('recid', $_REQUEST['recid']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function updateadmin($pdo)
{

    $user_name = $_POST['update_name'];
    $user_email = $_POST['update_email'];
    $password = $_POST['update_password'];
    $con_password = $_POST['update_con_password'];
    $role = $_POST['update_role'];
    $recid = $_POST['recid'];

    if(empty($user_name) || empty($user_email) || empty($role))
    {
        echo "All Filled Compulsory.";
        exit();
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$user_name))
    {
        echo "Only Letter Format.";
        exit();
    }
    else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid Email ID Format.";
        exit();
    }
    else if($password != $con_password)
    {
        echo "Your Password and Confirm Password Not Match.";
        exit();
    }
    $sql = "SELECT recid,user_email FROM tbl_administrator WHERE user_email=:username and status=1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('username', $user_email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) 
    {

        /*echo "<pre>";
        print_r($result);*/

        if($result['recid'] != $recid)
        {
            echo "Already Email ID Exist";
            exit();
            
        }
        else
        {
            if(empty($password))
            {
                $data = array(
                    'recid'=>$recid,
                    'user_name'=>$user_name,
                    'user_email'=>$user_email,
                    'role'=>$role
                );

                $stmt = $pdo->prepare("UPDATE tbl_administrator set user_name = :user_name, user_email = :user_email, role = :role where recid = :recid");
                $stmt->execute($data);
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $data = array(
                        'recid'=>$recid,
                        'user_name'=>$user_name,
                        'user_email'=>$user_email,
                        'password'=>$password,
                        'role'=>$role
                    );

                $stmt = $pdo->prepare("UPDATE tbl_administrator set user_name = :user_name, user_email = :user_email, password = :password, role = :role where recid = :recid");
                $stmt->execute($data);
            }
            echo 1;
        }
    } 
    else 
    {
        if(empty($password))
        {
            $data = array(
                'recid'=>$recid,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'role'=>$role
            );

            $stmt = $pdo->prepare("UPDATE tbl_administrator set user_name = :user_name, user_email = :user_email, role = :role where recid = :recid");
            $stmt->execute($data);
        }
        else
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                    'recid'=>$recid,
                    'user_name'=>$user_name,
                    'user_email'=>$user_email,
                    'password'=>$password,
                    'role'=>$role
                );

            $stmt = $pdo->prepare("UPDATE tbl_administrator set user_name = :user_name, user_email = :user_email, password = :password, role = :role where recid = :recid");
            $stmt->execute($data);
        }
        echo 1;
    }
}


function archiveAdmin($pdo)
{
    $recid = $_POST['recid'];


    $stmt = $pdo->prepare("UPDATE tbl_administrator set status = 0 where recid = :recid");
    $stmt->bindParam(':recid', $recid);

    $stmt->execute();
    echo 1;
}
