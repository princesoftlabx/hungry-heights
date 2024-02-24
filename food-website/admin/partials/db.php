<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "food_order");

if(!$conn){
    echo "Connection failed". mysqli_connect_error($conn);
}