<?php

require '../../config/db.php';

if (isset($_POST['usernamekk'])) {
    $username = $_POST['usernamekk'];
    // rest of your code
$ttkhRe = 'noo';
$recoverRe = 'noo';

$khachhangSql = "SELECT tttk FROM khachhang WHERE matk = '$username'";
$khachhangResult = mysqli_query($connect, $khachhangSql);

$accountSql = "SELECT recovery FROM account WHERE username = '$username'";
$accountResult =  mysqli_query($connect, $accountSql);

    if (mysqli_num_rows($khachhangResult) > 0) {
        $khachhangRow = mysqli_fetch_assoc($khachhangResult);
        $tttk = $khachhangRow['tttk'];

        if($tttk == 1) {
            $ttkhRe = 'fail';
        } else {
        $ttkhRe = 'success';
        }
    }

    if (mysqli_num_rows($accountResult) > 0) {
        $accountRow = mysqli_fetch_assoc($accountResult);
        $recover = $accountRow['recovery'];

        if($recover == 1) {
            $recoverRe = 'fail';
        } else {
        $recoverRe = 'success';
        }
    }


    $reponse = array(
        'recovery' => $recoverRe,
        'tttk' => $ttkhRe,
    );

    echo json_encode($reponse);
}

    mysqli_close($connect);
?>