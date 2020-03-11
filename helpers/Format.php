<?php

class Format {

    public function dateFormat($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function shortText($text, $textUpto = 400) {
        
        $text = substr($text, 0, $textUpto);
        $text = $text . '...';
        return $text;

    }
    
}










?>