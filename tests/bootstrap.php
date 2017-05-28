<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

function add_filter($name, $function)
{
    return true;
}

function remove_filter($name, $function)
{
    return true;
}

function wp_create_nonce($action)
{
    return md5($action);
}

function wp_verify_nonce($value, $action)
{
    return $value === md5($action);
}