<?php

if (!function_exists('flash')) {
    /**
     * @param $message
     * @param string $type
     */
    function flash($message, string $type = 'success')
    {
        $alert = (object)[];
        $alert->message = $message;
        $alert->type = $type;
        session()->flash('alert', $alert);
    }
}