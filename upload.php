<?PHP
    $name = $_POST['invName'];
    $brand = $_POST['invBrand'];
    $desc = $_POST['invDesc'];
    $price = $_POST['currency-field'];
    $type = $_POST['prodType'];
    header('Content-Type: application/json');
  $dbHost = 'localhost';
$dbUsername = 'fliyjlmy_bradyDS';
$dbPassword = 'buddy13';
$dbName = 'fliyjlmy_dsgInv';
//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($name === ''){
    echo 'test';
    print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
    exit();
}
if ($brand === ''){
    print json_encode(array('message' => 'Brand cannot be empty', 'code' => 0));
    exit();
}
if ($desc === ''){
    print json_encode(array('message' => 'Description cannot be empty', 'code' => 0));
    exit();
}
if ($price === ''){
    print json_encode(array('message' => 'Price cannot be empty', 'code' => 0));
    exit();
}
if ($type === ''){
  print json_encode(array('message' => 'Product Type cannot be empty', 'code' => 0));
  exit();
}
if($db->connect_error){
    print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
   die("Unable to connect database: " . $db->connect_error);
}
  if(!empty($_FILES['uploadimage']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploadimage']['name']);
    if(move_uploaded_file($_FILES['uploadimage']['tmp_name'], $path)) {
      //echo "The file ".  basename( $_FILES['uploadimage']['name']). 
      //" has been uploaded";
     // echo "<img src='$path' />";
    //insert form data in the database
    $path = "https://markovichweb.com/deb/" . $path;
    $insert = $db->query("insert into inventory (name, brand, productType, description, price, fileName) values ('$name','$brand', '$type', '$desc', '$price', '$path')");
    header("Location:index.html");
    //header("Location: index.html");
    //echo $insert?'ok':'err';
    } else{
        echo 'Something has went wrong. Please contact brady@markovichweb.com';
        exit();
    }
  }
?>