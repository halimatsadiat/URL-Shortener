<?php 
//db connection
$servername = '';
$username = '';
$password = '';
$dbname = '';

$conn = new mysqli($servername, $username, $password, $dbname);
//create short url
function createUrl($longUrl){
    $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shortUrl = 'https://';
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($char) - 1);
        $shortUrl .= $char[$index];
    }
    // return $shortUrl;
    if(checkShortUrl($shortUrl) == 1001){ 
        if(insertUrl($longUrl, $shortUrl) == "success"){
            $newUrl = $shortUrl;
            return  $newUrl;
        }else if (insertUrl($longUrl, $shortUrl) == "failed"){
            return "Insertion Failed";
        }
    }else if (checkShortUrl($shortUrl) == 2012){
        return "Url Already Exists";
    }
}

//check if short url already exgit ist
function checkShortUrl($url){
    global $conn;
    $response = [];
    $sql = "SELECT short_url FROM tablename WHERE short_url = $url";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
       return $response['status']= 2012;
    }else{
       return $response['status'] = 1001;
    }
    
}

//insert url into a table
function insertUrl($longUrl, $shortUrl){
    global $conn;
    $sql0 = 'INSERT INTO short_url (longurl, shorturl, created_at) VALUES (longUrl, shortUrl, date("Y-m-d"))';
    if(mysqli_query($conn, $sql0)){
        return $response['status']= "success";
    }else{
        return $response['status'] = "failed";
    }
}

?>