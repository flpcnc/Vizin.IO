<?php

class LogoutController
{
    public function index()
    { 
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }
}