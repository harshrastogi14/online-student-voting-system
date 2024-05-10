<?php
require_once("admin/inc/config.php");

if(isset($_POST['summit']))
{
    $query ="SELECT * FROM 'users' WHERE 'id'='$_POST[id]'";
    $result=mysqli_query($db ,$query);
    if($result)
    {
      echo "hello";
    }
    else
    {
      echo "
      <script>
      alert('cannot run query');
      window.location.href='index.php';
      </script> "; 
    }

}


?>
