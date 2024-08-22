<?php
$action = $_GET["action"];
switch ($action) {
  case 'getSecurityToken':
    include('../class/SimpleSecurityTokenTime.php');

    $objSimpleSecurityTokenTime = new SimpleSecurityTokenTime;

    [$token, $secondsToExpirate] = $objSimpleSecurityTokenTime->getToken();

    $dataToken = [
      'token' => $token,
      'secondsToExpirate' => $secondsToExpirate,
      'maxSecondsExpiration' => $objSimpleSecurityTokenTime->maxSecondsExpiration,
    ];

    echo json_encode($dataToken);
    break;
  case 'evalSecurityToken':
    include('../class/SimpleSecurityTokenTime.php');

    $objSimpleSecurityTokenTime = new SimpleSecurityTokenTime;

    $isToken = $objSimpleSecurityTokenTime->evalToken($_POST['tokenToEval']);

    $data = [
      'isToken' => $isToken,
    ];

    echo json_encode($data);
    break;
  default:
    echo json_encode(['error' => '404']);
}
