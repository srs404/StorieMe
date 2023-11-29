<?php

session_start();

function redirect($url)
{
    header("Location: " . $url);
}
