<?php

class Weapon
{
    public $weaponName;
    // string

    public $weaponType;
    // 0 = sword, 1 = bow, 2 = staff

    public $weaponDamage;
    // minimum 1, maximum 100

    public function __construct(string $weaponName, int $weaponType, int $weaponDamage)
    {
        $this->weaponName = $weaponName;
        $this->weaponType = $weaponType;
        $this->weaponDamage = $weaponDamage;
    }
}

?>