<?php

require_once "connection.php";
$idEvento = htmlspecialchars($_REQUEST['idEvento']);

$jsondata["data"] = array();

try {

	$stmt = $pdo->prepare("SELECT * FROM `eventos` WHERE id=?");
	$stmt->execute([$idEvento]);
	while ($row = $stmt->fetch()) {
        $jsondata["data"][] = $row;
    }
} catch (PDOException $e) {
	$jsondata["mensaje"][]="Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo=null;

exit();

