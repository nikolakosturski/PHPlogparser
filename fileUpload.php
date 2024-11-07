
<?php




$target_dir = 'C:\xampp\htdocs\logparser\\';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ime = basename( $_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo " Fajlot " . basename($_FILES["fileToUpload"]["name"]) . " e uploadiran <br>";
} else {
    echo "Postoi error pri uploadiranje na fajlot.";
}

$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype = finfo_file($fileinfo, $target_file);


include_once 'C:\xampp\htdocs\logparser\logparser.php';
    // This array will be used for the requests
    $correct_lines = [];
    // This array will be used to get the table headers, essentially the log headers
    $headers = [];
    $opened_file = fopen($target_file, "r");
    $parsed_log = parseInfoFromFile($opened_file, $correct_lines, $headers);
    header('Content-Type: application/json');
    $data =  json_encode($parsed_log, JSON_PRETTY_PRINT);
    $fajl = 'data.json';
    file_put_contents($fajl,$data);
    
    fclose($opened_file);
    unlink($target_file);
    

    
//DATABAZA

$conn = mysqli_connect("localhost", "root", "", "logparser");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fajlname = "data.json";
$dataa = file_get_contents($fajlname);
$array = json_decode($dataa,true);
$sab = $array[0];
print_r($sab);

foreach($sab as $value) {
    $query = "INSERT INTO `logovi` (`date`, `time`, `s-ip`, 
    `cs-method`, `cs-uri-stem`, `cs-uri-query`, `s-port`, 
    `cs-username`, `c-ip`, `cs(User-Agent)`, `sc-status`,
     `sc-substatus`, `sc-win32-status`, `time-taken`)
     VALUES ('".$value["date"]."', '".$value["time"]."', '".$value["s-ip"]."',
      '".$value["cs-method"]."', '".$value["cs-uri-stem"]."', '".$value["cs-uri-query"]."',
       '".$value["s-port"]."', '".$value["cs-username"]."', '".$value["c-ip"]."',
        '".$value["cs(User-Agent)"]."', '".$value["sc-status"]."', '".$value["sc-substatus"]."',
      '".$value["sc-win32-status"]."', '".$value["time-taken"]."')";

      mysqli_query($conn,$query);
}

?>