<?php 
//db connection
$servername = '';
$username = '';
$password = '';
$dbname = '';

$conn = new mysqli($servername, $username, $password, $dbname);

//check if short url already exgit ist
function checkShortUrl($url){
    global $conn;
    $response = [];
    $sql = "SELECT short_url FROM tablename WHERE short_url = $url";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $response['status']= 2012;
        $response['message'] = 'Url already Exist';
    }else{
        $response['status'] = 1001;
        $response['message'] = 'Url does not Exist';
    }
    return $response;
}

?>