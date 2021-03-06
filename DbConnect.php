<?php

function connection()
{
    $connection =new mysqli("localhost","tusar10","12345678","wtk");
    if($connection->connect_errno)
    {
        die("Database connection failed.".$connection->connect_error);
    }
    return $connection;
}

function register($fname,$lname,$gender,$dob,$religion,$present_address,$parmanent_address,$phone,$email,$link,$userName,$password)
{
    $connection=connection();
    $sql=$connection->prepare("INSERT INTO users (firstName,lastName,gender,dob,religion,presentAddress,parmanentAddress,phone,email,personalUrl,userName,password)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param("ssssssssssss",$fname,$lname,$gender,$dob,$religion,$present_address,$parmanent_address,$phone,$email,$link,$userName,$password);
    return $sql->execute();
}

function login($userName,$password)
{
    $connection=connection();
    $sql=$connection->prepare("SELECT * FROM users WHERE userName = ? and password = ?");
    $sql->bind_param("ss",$userName,$password);
    $sql->execute();
    $response=$sql->get_result();
    return $response->num_rows === 1;
}
 

 ?>