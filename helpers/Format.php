<?php

class Format {

    public function dateFormat($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function shortText($text) {
        
        $text = substr($text, 0, 400);
        $text = $text . '...';
        return $text;

    }
    
}










?>