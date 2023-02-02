<?php

include "Database/Connection.php";
class Auth extends dbConnection
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = $this->connect("root", "localhost", "password", "stockWiz");

        if ($this->dbConnection === false) {
            return false;
        }
    }


    function login($username, $password)
    {
        //Array to store validation errors
        $errmsg_arr = array();

        //Validation error flag
        $errflag = false;

        //Input Validations
        if ($username == '') {
            $errmsg_arr[] = 'Username missing';
            $errflag = true;
        }
        if ($password == '') {
            $errmsg_arr[] = 'Password missing';
            $errflag = true;
        }

        //If there are input validations, redirect back to the login form
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
           return header("location: login.php");
        }else{
            $sql = "SELECT * FROM user
            WHERE `username` = '$username'
            AND `password` = '$password'";

            $result = $this->dbConnection->query($sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    //Login Successful
                    session_regenerate_id();
                    $member = mysqli_fetch_assoc($result);
                    $_SESSION['SESS_MEMBER_ID'] = $member['id'];
                    $_SESSION['SESS_NAME'] = $member['name'];
                    $_SESSION['SESS_POSITION'] = $member['position'];
                    //$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
                    session_write_close();
                    return header("location: index.php");
                }else{
                    return false;
                }
            }
        }
    }
}
