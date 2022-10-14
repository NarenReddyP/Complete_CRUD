<?php
//print_r($_FILES);
//die;


$action=$_REQUEST['action'];

if(!empty($action)){
    require_once 'user.php';
    $obj=new User();
}

//adding user action 
if($action=='adduser' && !empty($_POST)){
    
    $pname=$_POST['username'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $photo=$_FILES['photo'];
    
    $playerid=(!empty($_POST['userId']))? $_POST['userId']: '';
    
    //file (photo) upload
    
    $imagename='';
    if(!empty($photo['name'])){
        $imagename=$obj->uploadPhoto($photo);
        $playerData=[
            'name'=> $pname,
            'email'=> $email,
            'mobile'=> $mobile,
            'photo'=> $imagename,
            
        ];
    }else{
        $playerData=[
            'name'=>$pname,
            'email'=>$email,
            'mobile'=>$mobile,
           
        ];
    }
    
    if($playerid){
        $obj->update($playerData, $playerid);
    }else{
        $playerid=$obj->add($playerData);
    } 
    
        if(!empty($playerid)){
            $player=$obj->getRow('id',$playerid);
            echo json_encode($player);
            exit();
        }
    }

//getcountof function and getallusers action

if($action=='getallusers'){
    $page=(!empty($_GET['page']))? $_GET['page'] : 1;
    $limit =4;
    $start=($page-1) * $limit;
    
    $users=$obj->getRows($start,$limit);
    if(!empty($users)){
        $userlist=$users;
    }else{
        $userlist=[];
    }
    $total=$obj->getCount();
    $userArr=['count'=>$total,'users'=>$userlist];
    echo json_encode($userArr);
    exit();
}


//action to perform editing
if($action=="editusersdata"){
    $playerid=(!empty($_GET['id']))? $_GET['id']: '';
    if(!empty($playerid)){
         $user=$obj->getRow('id', $playerid);
            echo json_encode($user);
            exit();
    }
}

//action to perform Deleting

if($action == "deleteuserdata"){
    $userId=(!empty($_GET['id']))? $_GET['id'] : '';
    if(!empty($userId)){
        $isDeleted=$obj->deleteRow($userId);
        if($isDeleted){
            $displaymessge=['deleted' => 1];
        } else{
            $displaymessge=['deleted' => 0];
        }
        echo json_encode($displaymessge);
        exit(); 
    }
}


//Search Data 
if($action=='searchuser'){
    $queryString=(!empty($_GET['searchQuery']))? trim($_GET['searchQuery']) : '';
    $results=$obj->searchUser($queryString);
    echo json_encode($results);
    exit();
}


?>







