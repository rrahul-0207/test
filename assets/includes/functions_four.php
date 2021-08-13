<?php

function pr($val){
    echo '<pre>';
    print_r($val);
    die;
}
function Wo_GetCountryArray() {
    global $wo, $sqlConnect;

    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_COUNTRIES ." ORDER BY name ASC ");
    $country[0]='Select Country';
    while ($fetched_data = mysqli_fetch_assoc($query_run)) {
        $id=$fetched_data['id'];
        $country[$id]=$fetched_data['name'];
    }

    return $country;
}
function Wo_GetStateArray($country) {
    global $wo, $sqlConnect;

    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_STATES ." WHERE country_id=$country ORDER BY id ASC ");
    $state[0]='Select State';
    while ($fetched_data = mysqli_fetch_assoc($query_run)) {
        $id=$fetched_data['id'];
        $state[$id]=$fetched_data['name'];
    }

    return $state;
}
function Wo_GetCityArray($state) {
    //return 'a';
    global $wo, $sqlConnect;

    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_CITIES ." WHERE state_id=$state ORDER BY id ASC ");
    $city[0]='Select City';
    while ($fetched_data = mysqli_fetch_assoc($query_run)) {
        $id=$fetched_data['id'];
        $city[$id]=$fetched_data['name'];
    }

    return $city;
}
function Wo_GetCityName($city_id){
  global $wo, $sqlConnect;

  $query_run = mysqli_query($sqlConnect, "SELECT name FROM " . T_CITIES ." WHERE id=$city_id ");
  $fetched_data = mysqli_fetch_assoc($query_run);
  return $fetched_data['name'];
}
function Wo_GetStateName($state_id){
  global $wo, $sqlConnect;

  $query_run = mysqli_query($sqlConnect, "SELECT name FROM " . T_STATES ." WHERE id=$state_id ");
  $fetched_data = mysqli_fetch_assoc($query_run);
  return $fetched_data['name'];
}
function Wo_GetCountryName($country_id){
  global $wo, $sqlConnect;

  $query_run = mysqli_query($sqlConnect, "SELECT name FROM " . T_COUNTRIES ." WHERE id=$country_id ");
  $fetched_data = mysqli_fetch_assoc($query_run);
  return $fetched_data['name'];
}
function Wo_GetInterestArray() {
    global $wo, $sqlConnect;
    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_INTERESTS ." ORDER BY name ASC ");
    $interest[0]='Select One';
    while ($fetched_data = mysqli_fetch_assoc($query_run)){
        $id=$fetched_data['id'];
        $interest[$id]=$fetched_data['name'];
    }
    return $interest;
}
function Wo_GetInterest($id){
    global $wo, $sqlConnect;
    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_INTERESTS ." WHERE id=$id ");
    $fetched_data = mysqli_fetch_assoc($query_run);
    return $fetched_data['name'];
}

function Wo_InsertUserInterest($user,$interest_sub){
    global $wo, $sqlConnect;
    $sql_select="SELECT * FROM " . T_USER_INTERESTS ." WHERE user_id=$user ";
    $query = mysqli_query($sqlConnect, $sql_select);
    //pr($sql_select);
    $interest_list=implode(",",$interest_sub);
    //pr($interest_list);
    if (mysqli_num_rows($query) > 0) {
        $sql    = "UPDATE " . T_USER_INTERESTS . " SET interest_subs_id='$interest_list' WHERE user_id=$user";
        //pr($sql);
        $query  = mysqli_query($sqlConnect, $sql);
    }
    else{
        $sql    = "INSERT INTO " . T_USER_INTERESTS . " (user_id,interest_subs_id) VALUES ('".$user."','".$interest_list."')";

        $query  = mysqli_query($sqlConnect, $sql);
    }

}
function Wo_GetAllSubInterest(){
    global $wo, $sqlConnect;
    $query_run = mysqli_query($sqlConnect, "SELECT * FROM " . T_INTERESTS_SUB ." ORDER BY id ASC ");
    //$interest[0]='Select One';
    while ($fetched_data = mysqli_fetch_assoc($query_run)){
        $id=$fetched_data['id'];
        $parent_id=$fetched_data['interest_id'];
        $name=$fetched_data['name'];
        $sub_interest[$parent_id][$id]=$name;
    }
    //pr($sub_interest);
    return $sub_interest;
}
function Wo_GetUserSubInterest($user=''){
    global $wo, $sqlConnect;
    if($user=='')
    {
        $user=$wo['user']['user_id'];
    }
    $sql_select="SELECT * FROM " . T_USER_INTERESTS ." WHERE user_id=$user ";
    $query = mysqli_query($sqlConnect, $sql_select);
    if (mysqli_num_rows($query) > 0) {
        $fetched_data = mysqli_fetch_assoc($query);
        $sub_interest_ids=explode(',',$fetched_data['interest_subs_id']);
    }
    else{
        $sub_interest_ids=array('0');
    }

    return $sub_interest_ids;
}

function Wo_EmailExistsViaPhone($phone){
  global $wo, $sqlConnect;
  $sql="SELECT email FROM ".T_USERS." WHERE phone_number=$phone";
  $query = mysqli_query($sqlConnect, $sql);
  $fetched_data = mysqli_fetch_assoc($query);
  $email=$fetched_data['email'];
  if(empty($email)){
    return "0";
  }
  else {
    return $email;
  }
}
function Wo_UserExistsViaPhone($phone){
  global $wo, $sqlConnect;
  $sql="SELECT user_id FROM ".T_USERS." WHERE phone_number=$phone";
  $query = mysqli_query($sqlConnect, $sql);
  $fetched_data = mysqli_fetch_assoc($query);
  $user_id=$fetched_data['user_id'];
  if(empty($user_id)){
    return "0";
  }
  else {
    return $user_id;
  }
}
function Wo_UpdatePassword($user_id,$password){
    global $wo, $sqlConnect;
    $password=sha1($password);
    $sql    = "UPDATE " . T_USERS . " SET password='$password' WHERE user_id=$user_id";
    //pr($sql);
    $query  = mysqli_query($sqlConnect, $sql);
    return 1;
}
function Wo_ProfileCheck(){
  global $wo, $sqlConnect;
  $user_id=$wo['user']['user_id'];
  $select="SELECT * FROM ".T_USERS." WHERE user_id=$user_id";
  //pr($select);
  $query = mysqli_query($sqlConnect, $select);
  $fetched_data = mysqli_fetch_assoc($query);
  $msg="0";

  if($fetched_data['birthday']=="0000-00-00")
    $msg="Birthday";
  if($fetched_data['city_id']=="0")
    $msg="City";
  if($fetched_data['birthday']=="0000-00-00" && $fetched_data['city_id']=="0")
    $msg="Birthday and City";
  return $msg;
}

function Wo_DeactivateAccount($user_id,$deactivate=0,$additional=null){
    global $wo, $sqlConnect;
    //pr($deativate);
    $deact_reason=array("No Reason",
                         "This is temporary. I will be back.",
                         "I do not find Mitrah useful.",
                         "I spend too much time using Mitrah.",
                         "I don't understand how to use Mitrah.",
                         "I have a privacy concern.",
                         "I have another Mitrah account.",
                         "I uses some other Social network website.",
                         "My account was hacked.",
                         "I don't feel safe on Mitrah.",
                         "I get too many emails, invitations, and requests from Mitrah.",
                         "Other");
    
    $deactive_r=$deact_reason[$deactivate];
    //pr($deactive_r);
    $select="SELECT * FROM ".T_USERS." WHERE user_id=$user_id";
    $query = mysqli_query($sqlConnect, $select);
    $fetched_data = mysqli_fetch_assoc($query);
    //pr($deactive_r);
    if($fetched_data['active']==1)
    {
        $sql="UPDATE ".T_USERS." SET active='0', additional_comments='$additional', deactive_reason='$deactive_r' WHERE user_id=$user_id";
        //pr($sql);
        $query_update = mysqli_query($sqlConnect,$sql );
        if ($query) {
            
            return true;
        }
    }
    else{
        return false;
    }
    //pr();
   
    
}
 function Wo_CanSeeComment($comment){
        global $wo, $sqlConnect;
        $user=$wo['user']['user_id'];
        $post_id=$comment['post_id'];
        $select="SELECT user_id FROM ".T_POSTS." WHERE id=$post_id";
        $query=mysqli_query($sqlConnect,$select);
        $fetched_data = mysqli_fetch_assoc($query);
        $user1=$comment['user_id'];
        $user2=$fetched_data['user_id'];
        if($comment['privacy']==1)
        {
            if($user==$user1 || $user==$user2)
            {
                return true;
            }
        }
        else{
            return true;
        }
}
function Wo_AddProboxContent($info,$user){
    //pr($info);
    global $wo, $sqlConnect;
    $select="SELECT * FROM ".T_PROBOX." WHERE user_id=$user";
    //pr($select);
    $querry=mysqli_query($sqlConnect,$select);
    $fetched_data = mysqli_fetch_assoc($querry);
    if($fetched_data['user_id']){
        if($fetched_data['user_id']){
            if($info['blank']==1){
                $update="UPDATE ".T_PROBOX." SET type='".$info['type']."' WHERE user_id=$user";
            }
            else{
                if($info['type']==1)
                    $update="UPDATE ".T_PROBOX." SET type='".$info['type']."', probox_text='".$info['text']."' WHERE user_id=$user";
                if($info['type']==2)
                    $update="UPDATE ".T_PROBOX." SET type='".$info['type']."', probox_image_path='".$info['filename']."' WHERE user_id=$user";
                if($info['type']==3)
                    $update="UPDATE ".T_PROBOX." SET type='".$info['type']."', probox_video_path='".$info['filename']."' WHERE user_id=$user";
            }
            $querry=mysqli_query($sqlConnect,$update);
        }
    }
    else{
         if($info['type']==1)
            $insert="INSERT INTO ".T_PROBOX." (user_id,probox_text,type) VALUES('".$user."','".$info['text']."','".$info['type']."')";
        if($info['type']==2)
            $insert="INSERT INTO ".T_PROBOX." (user_id,probox_image_path,type) VALUES('".$user."','".$info['filename']."','".$info['type']."')";
        if($info['type']==3)
            $insert="INSERT INTO ".T_PROBOX." (user_id,probox_video_path,type) VALUES('".$user."','".$info['filename']."','".$info['type']."')";
        
        $querry=mysqli_query($sqlConnect,$insert);
    }
    if($querry){
        return true;
    }
 }
 function Wo_GetProboxContent($user){
    global $wo, $sqlConnect;
    $select="SELECT * FROM ".T_PROBOX." WHERE user_id=$user";
    //pr($select);
    $querry=mysqli_query($sqlConnect,$select);
    $fetched_data = mysqli_fetch_assoc($querry);
    if($fetched_data['user_id']){
        if($fetched_data['type']==1)
        {
            $result['type']=1;
            $result['value']=$fetched_data['probox_text'];
            return $result;
        }
        if($fetched_data['type']==2)
        {
            $result['type']=2;
            $result['value']=$fetched_data['probox_image_path'];
            return $result;
        }
        if($fetched_data['type']==3)
        {
            $result['type']=3;
            $result['value']=$fetched_data['probox_video_path'];
            return $result;
        }
    }
 }
function Wo_CountUsersPageByCategory($user_id = false, $category=false) {
    global $wo, $sqlConnect;
    $data = array();
    if (empty($user_id) or !is_numeric($user_id) or $user_id < 1) {
        return false;
    }
    $user_id      = Wo_Secure($user_id);
    $query_text = "SELECT COUNT(`page_id`) AS count FROM " . T_PAGES . " 
                   WHERE `page_category` = {$category} AND `page_id` IN (SELECT `page_id` FROM ".T_PAGES_LIKES."
                   WHERE `user_id` = {$user_id})";
    $query        = mysqli_query($sqlConnect, $query_text);
    $fetched_data = mysqli_fetch_assoc($query);
    return $fetched_data['count'];
}
 function Wo_GetUsersPageByCategory($user_id = false, $category=false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $data       = array();
    $user_id    = Wo_Secure($user_id);
    if (!$user_id || !is_numeric($user_id) || $user_id < 1) {
        $user_id  = Wo_Secure($wo['user']['user_id']);
    }  
    $query_text = "SELECT `page_id` FROM " . T_PAGES . " 
                   WHERE `page_category` = {$category} AND `page_id` IN (SELECT `page_id` FROM ".T_PAGES_LIKES."
                   WHERE `user_id` = {$user_id})";
    
    $query_one  = mysqli_query($sqlConnect, $query_text);
    while ($fetched_data = mysqli_fetch_assoc($query_one)) {
        if (is_array($fetched_data)) {
            $data[] = Wo_PageData($fetched_data['page_id']);
        }
    }

    return $data;
}