
<?php
$servername = "localhost";
$username = "root";
$password = ""; // spelling theek karo
$database = "myblog";

$con = mysqli_connect($servername, $username, $password, $database);
// $sql="CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) not null,
//     email VARCHAR(100) not null,
//     password VARCHAR(255) not null,
//     image varchar(1024) null,
//     date datetime default current_timestamp,
//     role varchar(10) not null,

//     key username(username),
//     key email(email)

// )";
// $sql="ALTER TABLE `destinations`
// CHANGE `title` `title` VARCHAR(255) NOT NULL,
// CHANGE `location` `location` VARCHAR(255) NOT NULL,
// CHANGE `type` `type` VARCHAR(100) NOT NULL,
// CHANGE `description` `description` TEXT NOT NULL,
// CHANGE `image` `image` VARCHAR(255) NOT NULL,
// CHANGE `date` `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;";

// $sql="CREATE TABLE categories (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     categories VARCHAR(50) not null,
// slug VARCHAR(100) not null,
//     disabled tinyint default 0,


//     key slug(slug),
//     key categories(categories)
// )";
// $sql="CREATE TABLE posts (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id int,
//     categories_id int,
//     title VARCHAR(100) not null,
//     contect text null,
//     image varchar(1024) null,
//     date datetime default current_timestamp,
//     slug VARCHAR(100) not null,

//     key user_id(user_id),
//     key     categories_id(categories_id),
//     key title(title),
//     key slug(slug),
//     key date(date)

// )";
// $q1=mysqli_query($con,$sql);

// if ($q1) {
//     echo "Successfully connected 😎";
// } else {
//     echo "Connection failed 😥: "; 
// }

// if(!empty($_POST))
// {
//     echo "something was posted";
// }

// ?>

<!-- $sql = "SELECT * FROM users WHERE id = ?";
$data = [5];
$user = query($sql, $data);

if($user){
   print_r($user);
}else{
   echo "No user found";
} -->
