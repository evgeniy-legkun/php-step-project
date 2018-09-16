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

    $hashedPassword = getHashPassword($userData['password']);

    $result = $db->prepare($sql);
    $result->bindParam(':name', $userData['name'], PDO::PARAM_STR);
    $result->bindParam(':email', $userData['email'], PDO::PARAM_STR);
    $result->bindParam(':user_name', $userData['user_name'], PDO::PARAM_STR);
    $result->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    $responseResult = $result->execute();

    echo json_encode(['result' => (bool)$responseResult, 'errors' => $responseResult ? [] : ['failed']]);
    return;
}

if (!empty($_REQUEST['auth_user']) && $db) {
    $userData = json_decode($_REQUEST['form_data'], true);
    $isExists = isUserExists($userData, $db);

    if (!$isExists) {
        echo json_encode([ 'result' => false, 'errors' => ['email'] ]);
        return;
    }

    $sql = "SELECT id, email, password ".
           "FROM users ".
           "WHERE email='{$userData['email']}'";
    $response = $db->query($sql, PDO::FETCH_ASSOC);
    $row = $response->fetch();

    if (!$row) {
        echo json_encode(['result' => false, 'errors' => ['request']]);
        return;
    }

    // Check password
    $isPasswordValid = password_verify($userData['password'], $row['password']);

    // TODO add fact of auth into session
    echo json_encode([
        'result' => $isPasswordValid,
        'errors' => $isPasswordValid ? [] : ['password']
    ]);
    return;
}

function getHashPassword ($clearPassword) {
    return password_hash($clearPassword, PASSWORD_DEFAULT);
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
