<?php 
ob_start();

include 'include/init.php' ;

/// insert new category ///

$do=$_GET['do'];
if(($do=='insert') && ($_SERVER['REQUEST_METHOD']=='POST')){

        $catname=$_POST["category"];
        $check=checkitem("Cat_name","categories",$catname);
            if($check== 1){
                 $theMsg='<div class="alert alert-danger"> sorry this category is exist </div>';
                $response=array(
                    'msg'=>$theMsg,
                );
                echo json_encode($response); 
            }else{
                if(!empty($_POST['category'])){
                    //insert category to database with this info
                    $stmt=$con->prepare("INSERT INTO categories ( Cat_name ) VALUES(:zname )");
                    $stmt->execute(array(
                     'zname' => $catname
                      ));
                     $theMsg='<div class="alert alert-success"> Done. </div>';
                   // $theMsg=5;
                    $categories=$con->prepare(" SELECT * FROM categories WHERE Cat_name=? ");
                    $categories->execute(array($catname));
                    $alls=$categories->fetch();
                    
                    $new_category='<tr>
                            <td>    '. $catname.' </td>
                            <td class="text-right">
                                 <a href=""><button class="btn btn-primary badge-pill">Edit</button></a>
                                 <a href=""><button class="btn btn-danger badge-pill">Delete</button></a>
                            </td>
                        </tr>';
                    $response=array(
                        'msg'=>$theMsg,
                        'catname'=>$new_category
                    );
                    echo json_encode($response); 

                }
            }
}
if(($do=='Delete') && ($_SERVER['REQUEST_METHOD']=='GET')){
    $catid=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $stmt=$con->prepare('DELETE FROM categories WHERE Cat_id=:zid ' );
        $stmt->bindParam(':zid',$catid );
        $stmt->execute();
}
if(($do=='Edite') && ($_SERVER['REQUEST_METHOD']=='POST')){
    $catid=isset($_POST['catid']) && is_numeric($_POST['catid']) ? intval($_POST['catid']) : 0;
    $catname =$_POST['category'];
    $check=checkitem("Cat_name","categories",$catname);
    if($check== 1){
        echo $theMsg='<div class="alert alert-danger"> sorry this category is exist </div>';
    }else{
  //update the database with this info
  $stmt=$con->prepare("UPDATE categories SET  Cat_name =?   WHERE Cat_id=? ");
  $stmt->execute(array($catname,$catid));
  //echo succsess massage
 
  echo $theMsg= '<div class="alert alert-success">Recored Update</div>';
        }
}
ob_end_flush();
?>