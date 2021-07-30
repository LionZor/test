<?php

    /*
     Проверка простых текстовых данных
    */
    function validate_text($str, $min_len = null, $max_len = null){
        $text_len = mb_strlen($str);
        if($min_len && $text_len < $min_len){
            return 'Слишком короткий текст';
        }

        if($max_len && $text_len > $max_len){
            return 'Слишком длинный текст';
        }

        return null;
    }

    /*
     Проверка даты на корректность
    */
    function validate_date($date){

    }