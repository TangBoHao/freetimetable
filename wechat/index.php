<?php  
  
if(empty($_SESSION['user'])){  
      
    header("Location:login.php");  
}else{  
    print_r($_SESSION['user']);  
    echo "123";
}  
  
?>  