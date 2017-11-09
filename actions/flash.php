<?php

if (isset($_SESSION['success']) && null !== $_SESSION['success']) {
    $flashSuccess = file_get_contents('./templates/_flashSuccess.html', FILE_USE_INCLUDE_PATH);
    $flashSuccess = str_replace('%message%', $_SESSION['success'], $flashSuccess);
    echo $flashSuccess;
    $_SESSION['success'] = null;
}

if (isset($_SESSION['err']) && 0 != count($_SESSION['err'])) {
    $flashError = file_get_contents('./templates/_flashError.html', FILE_USE_INCLUDE_PATH);
    echo $flashError;
    $_SESSION['err'] = [];
}
