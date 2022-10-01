<?php

class Character
{
    
    public $name; 
    // string
    
    public $class; 
    // 0 = warrior, 1 = archer, 2 = mage
    
    public $stats; 
    /* 
    count($stats) = 4
            
        stats[0]: hp 
        stats[1]: strength 
        stats[2]: dexterity 
        stats[3]: intelligence  

    every stat must be between 1 and 50 and its sum must be equal to 25
    */

    public function __construct(string $name, int $class, array $stats)
    {
        if (!$this->updateAttributes($name, $class, $stats)) 
            $this->setAttributes("Invalid character", 0, array(1, 1, 1, 1));
    }

    public function updateAttributes(string $name, int $class, array $stats)
    {
        if ($this->verifyNewAttributes($name, $class, $stats)) 
            {
                $this->setAttributes($name, $class, $stats);
                return true;
            }
        return false;
    }

    private function verifyNewAttributes($name, $class, $stats)
    {
        $countValidStats = 0;
        if (strlen($name) != 0)
            if ($class == 0 || $class == 1 || $class == 2)
                if (count($stats) == 4)
                {
                    $countValidStats = 0;
                    $totalStatValue = 0;
                    foreach($stats as $statValue)
                    {
                        if ($statValue >= 1 && $statValue <= 50) $countValidStats++;
                        $totalStatValue += $statValue;
                    }

                    if ($countValidStats == 4 && $totalStatValue == 25) return true;
                }

        return false;
    }

    private function setAttributes($name, $class, $stats)
    {
        $this->name = $name;
        $this->class = $class;
        $this->stats = $stats;
    }
}

?>