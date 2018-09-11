<head>
     
    <style>
	
   <?php
 include("../css/admin.css");

    ?>
    </style>

</head>
<?php

include("autorizare.php");

?>
<div class="background">
<center>
 <a href="..\index.php"> <img id="logo" src="http://taniamarin.weebly.com/uploads/1/9/9/5/19958899/1454616862.png" alt="logo"></a>  
<h2> Administrare BD </h2>
<h1> <?php

$username= $_SESSION["user"];

echo  "Welcome back ",$username, "!";
?>
</br></h1>
<a href="admin.php" class="btn " > Panou principal admin </a> |
<a href="admin.php?op=addform" class="btn btn-primary btn-large btn-block" > Adauga clienti </a> |
<a href="admin.php?op=vezilistaclientimodi" class="btn btn-primary btn-large btn-block" > Vezi lista clientilor </a> |
<a href="admin.php?op=search" class="btn btn-primary btn-large btn-block" > Cauta </a> |

<hr />

<?php 

include 'connect.php';


if(isset($_GET["op"]))
	$operatiune = $_GET["op"];
	else if(isset($_POST["op"]))
		$operatiune = $_POST["op"];
		else $operatiune = "";



 
	
switch($operatiune)
{
	case "addform" : addform();
	break;
	case "insertbd" : insertbd($_POST["name"],$_POST["date"],$_POST["ordered"],$_POST["price"]);
	break;
	case "vezilistaclientimodi" : vezilistaclientimodi();
	break;
	case "modiclient" : modiclient($_GET["clientid"]);
	break;
	case "updateclient" : updateclient($_POST["clientid"],$_POST["name"],$_POST["date"],$_POST["ordered"],$_POST["price"]);
	break;
	case "deleteclient" : deleteclient($_GET["clientid"]);
		break;
		case "search": search();
		break;

}

function deleteclient($clientid)
{
	global $link;
	$update_string ="DELETE FROM clienti WHERE clientid = $clientid;";	
	mysqli_query($link,$update_string);
	$eroare = mysqli_error($link);
	if($eroare)
			echo $eroare;
		else
			echo "S-a sters cu succes clientul cu id $clientid!";
}



function updatecliet($clientid,$name,$date,$price,$ordered)
{
	
	global $link;
	$update_string ="UPDATE `clienti` SET `name` = '$name', `date` = '$date', `price` = '$price', `ordered` = '$ordered' WHERE `clienti`.`clientid` = $clientid;";	
	mysqli_query($link,$update_string);
$eroare = mysqli_error($link);
if($eroare)
	echo $eroare;
	else
	echo "S-a modificat cu succes $name !";

}
global $link;
function modiclient($clientid)
{
	$query_string = "SELECT clientid, name, date, price, ordered FROM clienti WHERE clientid=$clientid";

$result = mysqli_query($link, $query_string);

while( $row = mysqli_fetch_array($result))
{
	$clientid = $row["clientid"];
	$name = $row["name"];
	$date = $row["date"];
	$price = $row["price"];
	$ordered = $row["ordered"];
}
	?>
   	<form name="addclient" action="admin.php" method="post">
				       
		Name: <input type="text" name="name" value="<?php echo $name; ?>"> <br />
		Date: <input type="date" name="date" value="<?php echo $date; ?>"> <br />
		Price: <input type="text" name="price" value="<?php echo $price; ?>"> <br />
		Ordered: 	<select name="ordered">
						<option value="<?php echo $ordered; ?>" SELECTED> <?php echo $ordered; ?> </option>
						<option value="Book cover"> Book Cover </option>
						<option value="E-book cover"> E-book cover </option>
						<option value="Banner"> Banner </option>
					</select>
				<input type="hidden" name="op" value="updateclient">	
                <input type="hidden" name="clientid" value="<?php echo $clientid; ?>">	
				<input type="submit" value="submit">					
			</form>
    <?php	
}



function vezilistaclientimodi()
{ 
	global $link;
	
	$query_string = "SELECT clientid,name,date,price,ordered FROM clienti ";

	

// Ascending Order
if(isset($_POST['ASC']))
{ 
    $asc_query = "SELECT * FROM `clienti` ORDER BY `clienti`.`Name` ASC";
	$result = mysqli_query($link, $asc_query );
   
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM `clienti` ORDER BY `clienti`.`Name` DESC";
		  $result = mysqli_query($link, $desc_query );
        
    }
    
    // Default Order
 else {
      
      $result = mysqli_query($link, $query_string);
}
 echo "<form action=\"admin.php?op=vezilistaclientimodi\" method=\"post\">
          
            <input type=\"submit\" name=\"ASC\" value=\"Ascending\"><br><br>
            <input type=\"submit\" name=\"DESC\" value=\"Descending\"><br><br>
			  <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Ordered</th>
					<th>Operatiune</th>
                </tr>";
while( $row = mysqli_fetch_array($result))
{$clientid = $row["clientid"];
		echo "<tr><td>",$row["clientid"],"</td>";
		echo "<td>", $row["name"],"</td>";
		echo "<td>", $row["date"],"</td>";
		echo "<td>", $row["price"],"</td>";
		echo "<td>", $row["ordered"],"</td>";
		echo "<td>","<a href=\"admin.php?clientid=$clientid&op=modiclient\"> modifica </a>";
		echo"<a href=\"admin.php?clientid=$clientid&op=deleteclient\"> sterge </a>";

}
	
echo "</tr></table></form>";
	
}

function insertbd($name,$date,$price,$ordered)
{
// echo "$name | $date | $price | $ordered ";
global $link;
$query_string= "INSERT INTO `clienti` (`clientid`, `name`, `date`, `price`, `ordered`) VALUES (NULL, '$name', '$date', '$price', '$ordered');";
mysqli_query($link,$query_string);
$eroare = mysqli_error($link);
if($eroare)
	echo $eroare;
	else
	echo "Adaugare cu succes!";

}




function addform()
{
?>

<form name="addclient" action="admin.php" method="post">
	   

		Name: <input type="text" name="name"> <br />
		Date: <input type="date" name="date"> <br />
		Price: <input type="text" name="price"> <br />
		Ordered: 	<select name="ordered">
						<option value="Book cover"> Book Cover </option>
						<option value="E-book cover"> E-book cover </option>
						<option value="Banner"> Banner </option>
					</select>
			<input type="hidden" name="op" value="insertbd">	
				<input type="submit" value="submit">						
			</form>
   
<?php

}

function search(){
		global $link;
$query = "SELECT clientid,name,date,price,ordered FROM clienti";

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
   
	 $query='SELECT * FROM `clienti` WHERE CONCAT(`name`,`date`,`price`,`ordered`) LIKE "%'.$valueToSearch.'%"';
    $search_result = mysqli_query($link,$query );
    
}
 else {
    
    $search_result = mysqli_query($link,$query );}
	
	echo            " <form action=\"admin.php?op=search\" method=\"post\">
	<input type=\"text\" name=\"valueToSearch\" placeholder=\"Value To Search\"><br><br>
            <input type=\"submit\" name=\"search\" value=\"Filter\"><br><br><table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Ordered</th>
                </tr>";
			
while( $row = mysqli_fetch_array($search_result)){  
echo "<tr><td>",$row["clientid"],"</td>";
		echo "<td>", $row["name"],"</td>";
		echo "<td>", $row["date"],"</td>";
		echo "<td>", $row["price"],"</td>";
		echo "<td>", $row["ordered"],"</td>";  
}  
echo "</tr></table></form>";
	if (!$search_result) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}
}




?>
