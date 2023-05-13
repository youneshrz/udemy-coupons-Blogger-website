<?php


// function to get all from databas
function getallfrom($field,$table,$where=null,$and=null,$orderfield,$ordering="DESC"){
    global $con;
   
    $getall=$con->prepare("SELECT $field FROM $table $where $and   ORDER BY $orderfield $ordering ");
    $getall->execute();
    $all=$getall->fetchAll();
    return $all;
}
// function to get latest items from databas
function getlatest($select,$table,$where=null,$order,$limit=5){
    global $con;
    $getstmt=$con->prepare("SELECT $select FROM $table $where ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows=$getstmt->fetchAll();
    return $rows;
}
//// function contour of VISITS ////
function visits($table,$where,$countor){
    global $con;
    $countor +=1;
    $visits=$con->prepare("UPDATE $table SET  Visits =$countor where $where ");
    $visits->execute();
}
//// function time left///
function time_left($time_end){
    if($time_end=='0000-00-00 00:00:00'){
        return "Always available";
    }
    date_default_timezone_set('Africa/Algiers');
    $time_diff=strtotime($time_end)-time();
    $seconds=$time_diff;
    $minutes=floor($seconds/60);//value 60 is seconds
    $hours  =floor($seconds/3600);//value 3600 is 60 mints
    $days   =floor($seconds/86400);//value 86400=24*60*60 
    $weecks  =round($seconds/604800);//value  7*24*60*60
    $months =round($seconds/2609440);//value  ((365+365+365+365+365)/5/12)*24*60*60
    $years  =round($seconds/31553280);//value  (365+365+365+365+365)/5*24*60*60
    if($seconds<=60){
        return "Time left";
        
    }elseif($minutes<=60){
        if($minutes==1){
            return " Left 1 min ";
        }else{
            return " Left $minutes min ";
        }
    }elseif($hours<=24){
        if($hours==1){
            return "Left 1 hour ";
        }else{
            return " Left $hours hours ";
        }
    }elseif($days<=7){
        if($days==1){
            return " Left 1 day ";
        }else{
            return " Left $days days ";
        }
    }elseif($weecks<=4.3){ //4.3==52/12
        if($weecks==1){
            return "Left 1 weeck ";
        }else{
            return " Left $weecks weecks ";
        }
    }elseif($months<=12){
        if($months==1){
            return " Left 1 month ";
        }else{
            return " Left $months months ";
        }
    }elseif($years<=24){
        if($years==1){
            return "Left 1  year";
        }else{
            return "Left $years years ";
        }
    }
}
/// function get time ago
function time_ago($timestamp){
    $time_ago= strtotime($timestamp);
    $current_time=time();
    $time_deff=$current_time - $time_ago;
    $seconds=$time_deff;
    $minutes=round($seconds/60);//value 60 is seconds
    $hours  =round($seconds/3600);//value 3600 is 60 mints
    $days   =round($seconds/86400);//value 86400=24*60*60 
    $weecks  =round($seconds/604800);//value  7*24*60*60
    $months =round($seconds/2609440);//value  ((365+365+365+365+365)/5/12)*24*60*60
    $years  =round($seconds/31553280);//value  (365+365+365+365+365)/5*24*60*60
    if($seconds<=60){
        return "Just Now";
    }elseif($minutes<=60){
        if($minutes==1){
            return "one minute ago";
        }else{
            return "$minutes minute ago";
        }
    }elseif($hours<=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }elseif($days<=7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days day ago";
        }
    }elseif($weecks<=4.3){ //4.3==52/12
        if($weecks==1){
            return "a weeck ago";
        }else{
            return "$weecks weecks ago";
        }
    }
    elseif($months<=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }elseif($years<=24){
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
?>