<?php

if (!empty($_POST['add_user']) && $db) {
    echo 'TEST RESPONSE';
    print_r($_POST);

    $userData = $_POST['form_data'];

    $sql = 'INSERT INTO users (name, email, user_name, password)'
        .'VALUES (:name, :email, :user_name, :password)';

    $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);

    $result = $db->prepare($sql);
    $result->bindParam(':name', $userData['name'], PDO::PARAM_STR);
    $result->bindParam(':email', $userData['email'], PDO::PARAM_STR);
    $result->bindParam(':user_name', $userData['user_name'], PDO::PARAM_STR);
    $result->bindParam(':password', $passwordHash, PDO::PARAM_STR);

    // $responseResult = $result->execute();
    // return $responseResult;
}
