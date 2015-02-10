<?php

/**
 * Description of StringHelper
 *
 * @author Admin
 */
class StringHelper {
    
    public static function sameSymbols($symbol, $count) {
        $res = '';
        for ($i=0; $i<$count; $i++) {
            $res .= $symbol;
        }
        return $res;
    }
}
