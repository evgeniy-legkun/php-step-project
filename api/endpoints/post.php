<?php

if (!empty($_REQUEST['add_user']) && $db) {
    $userData = json_decode($_REQUEST['form_data'], true);
    $isExists = isUserExists($userData, $db);

    if ($isExists) {
        echo json_encode([
            'result' => false,
            'errors' => ['email']
        ]);
        return;
    }

    $sql = 'INSERT INTO users (name, email, user_name, password)'
        .'VALUES (:name, :email, :user_name, :password)';

    $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);

    $result = $db->prepare($sql);
    $result->bindParam(':name', $userData['name'], PDO::PARAM_STR);
    $result->bindParam(':email', $userData['email'], PDO::PARAM_STR);
    $result->bindParam(':user_name', $userData['user_name'], PDO::PARAM_STR);
    $result->bindParam(':password', $passwordHash, PDO::PARAM_STR);

    $responseResult = $result->execute();

    echo json_encode([
        'result' => (bool)$responseResult,
        'errors' => $responseResult ? [] : ['failed']
    ]);
    return;
}

function isUserExists($userData , $connect) {
    $userEmail = $userData['email'];
    $sql = "SELECT id, name FROM users WHERE email='".$userEmail."'";

    $response = $connect->query($sql, PDO::FETCH_ASSOC);

    $dataFromDatabase = array();
    $i = 0;
    while ($row = $response->fetch()){
        $dataFromDatabase[$i]['id'] = $row['id'];
        $dataFromDatabase[$i]['name'] = $row['name'];
        $i++;
    }

    return (bool)count($dataFromDatabase);
}
