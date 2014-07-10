<?php

/**
 * Custom helpers functions library
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 */

class T4KHelpers
{
    
    /**
     * Helper function: truncate string by a certain characters length while
     * keeping complete words.
     * @param string $string
     * @param int $charlength
     * @return string
     */
    public static function trunc_string($string, $charlength)
    {
        if (strlen($string) > $charlength)
        {
            $result = substr($string, 0, strrpos(substr($string, 0, $charlength), ' ')).'...';
        }
        else
        {
            $result = $string;
        }
        
        return $result;
    }
    
}
