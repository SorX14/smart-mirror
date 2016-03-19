<?php
/**
 * User: Steve
 * Date: 19/03/2016
 * Time: 18:51
 */

namespace Components\Models;


class Compliment
{
    /**
     * @var string
     */
    public $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    
}