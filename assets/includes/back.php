    <?php
    function Wo_Registerpostcom(){
        return "hi";
    $con=mysqli_connect("localhost","webdev_mitrah","zPenEF4^C.M#","webdev_mitrah");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM wo_comments where id='5'";
$result=mysqli_query($con,$sql);

// Numeric array


// Associative array
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
printf ("%s %s\n",$row["post_id"],$row["text"]);
return $row["text"];
// Free result set


mysqli_close($con);
     
    }  
    
    ?>