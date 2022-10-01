<?php
    
    include 'character.php';
    include 'weapon.php';



    $obj = json_decode(file_get_contents("initialCharacters.json"), true);
    $validCharacters = array();
    validateNewCharacters($obj, $validCharacters);
    createOrUpdateValidCharacters($validCharacters);






    
    function validateNewCharacters($obj, &$validCharacters)
    {
        foreach($obj as $characterJson)
        {
            $character = new Character($characterJson['name'], $characterJson['class'], $characterJson['stats']);
                
            if ($character->name == $characterJson['name'])
            {
                array_push(
                    $validCharacters, 
                    array('character' => $character, 'weapon' => generateRandomInitialWeapon())
                );
            }
        }
    }

    function generateRandomInitialWeapon()
    {
        $colors = array("Red", "Green", "Yellow", "Blue", "Black", "White");
        $adjectives = array("legendary", "gigantic", "agile", "majestic", "polished", "forbidden");
        $weaponTypeArray = array("sword", "bow", "staff");

        $weaponTypeNumber = rand(0, count($weaponTypeArray) - 1);
        $weaponName = $colors[rand(0, count($colors) - 1)] . " " . $adjectives[rand(0, count($adjectives) - 1)] . " " . $weaponTypeArray[$weaponTypeNumber];

        return new Weapon($weaponName, $weaponTypeNumber, rand(1, 100));
    }

    function createOrUpdateValidCharacters($validCharacters)
    {
        if(file_exists("validatedCharacters.json"))
        {
            $obj = json_decode(file_get_contents("validatedCharacters.json"), true);
            $temporalArray = array();

            foreach($obj as $characterJson)
                array_push(
                    $temporalArray, 
                    array('character' => $characterJson['character'], 'weapon' => $characterJson['weapon'])
                );
                
            for ($i = count($temporalArray) - 1; $i >= 0; $i--)
                array_unshift($validCharacters, $temporalArray[$i]);
        }

        $file = fopen("validatedCharacters.json", "w");
        fwrite(
            $file, 
            json_encode($validCharacters)
        );
        fclose($file);
    }

?>