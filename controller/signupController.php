<?php

require_once('model/user.php');

/****************************
 * ----- LOAD SIGNUP PAGE -----
 ****************************/
/**
 * verif if user is connect if not connect redirect to signupView
 */
function signupPage()
{

    $user = new stdClass();
    $user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if (!$user->id):
        require('view/auth/signupView.php');
    else:
        require('view/homeView.php');
    endif;

}

/***************************
 * ----- SIGNUP FUNCTION -----
 ***************************/
