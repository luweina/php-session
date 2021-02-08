<?php
    require_once('db.php');

    //DB Setup
    //You can add as many tables as you want, as long as the corresponding files exist
    //The order of the items inside the schema matters(will be the same order saved in the csv file)
    $schemas = Array(
        "users" => Array(
            "path" => "users.csv",
            "schema" => Array(
                "FirstName",
                "LastName",
                "LoggedIn",
                "Attempts"
            )
        )
    );

    $db = new Database($schemas);



    var_dump($db->searchTable('users' , 'LastName' , 'safavi'));
//    var_dump($db->getTable('users'));
//
//$newUser = Array(
//    "FirstName" => "Parsasi",
//    "LastName" => "Safavi",
//    "LoggedIn" => "20000",
//    "Attempts" => "0"
//);
//var_dump($db->editRow('users' , 'LastName' , 'Safavi' , $newUser));
