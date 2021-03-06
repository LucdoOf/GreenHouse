<?php

use GreenHouse\Models\SQL;
use GreenHouse\Models\User;

SQL::db()->query("SET FOREIGN_KEY_CHECKS=0;");

SQL::truncate(User::STORAGE);

$usersData = [
    [
        "firstname"  => "Lucas",
        "lastname" => "Garofalo",
        "gender" => "M"
    ], [
        "firstname" => "Eliott",
        "lastname" => "Tardieu",
        "gender" => "M"
    ], [
        "firstname" => "Arthur",
        "lastname" => "Le Floch",
        "gender" => "M"
    ], [
        "firstname" => "Louis",
        "lastname" => "Lecoeur",
        "gender" => "M"
    ], [
        "firstname" => "Célia",
        "lastname" => "Clavel",
        "gender" => "F"
    ], [
        "firstname" => "Maëva",
        "lastname" => "Darnault",
        "gender" => "F"
    ], [
        "firstname" => "Laurent",
        "lastname" => "Garofalo",
        "gender" => "M"
    ], [
        "firstname" => "Martine",
        "lastname" => "Granger",
        "gender" => "F"
    ], [
        "firstname" => "Julien",
        "lastname" => "Tardieu",
        "gender" => "M"
    ], [
        "firstname" => "Donald",
        "lastname" => "Trump",
        "gender" => "M"
    ], [
        "firstname" => "Marion",
        "lastname" => "Garofalo",
        "gender" => "F"
    ], [
        "firstname" => "Nicolas",
        "lastname" => "Mouton-Besson",
        "gender" => "M"
    ], [
        "firstname" => "Maxime",
        "lastname" => "Darnault",
        "gender" => "M"
    ], [
        "firstname" => "Karl",
        "lastname" => "Marx",
        "gender" => "M"
    ], [
        "firstname" => "Vladimir",
        "lastname" => "Poutine",
        "gender" => "M"
    ], [
        "firstname" => "Xi",
        "lastname" => "Jinping",
        "gender" => "M"
    ], [
        "firstname" => "James",
        "lastname" => "Bond",
        "gender" => "M"
    ], [
        "firstname" => "Jean",
        "lastname" => "Dujardin",
        "gender" => "M"
    ], [
        "firstname" => "Annick",
        "lastname" => "GoesBrrrr",
        "gender" => "?"
    ], [
        "firstname" => "Tania",
        "lastname" => "Tardieu",
        "gender" => "F"
    ], [
        "firstname" => "Octave",
        "lastname" => "Tardieu",
        "gender" => "M"
    ], [
        "firstname" => "Lewis",
        "lastname" => "Tardieu",
        "gender" => "M"
    ], [
        "firstname" => "Gros Joe",
        "lastname" => "Garofalo",
        "gender" => "M"
    ], [
        "firstname" => "Illusion",
        "lastname" => "Garofalo",
        "gender" => "F"
    ], [
        "firstname" => "Joseph",
        "lastname" => "Garofalo",
        "gender" => "M"
    ], [
        "firstname" => "Arthurette",
        "lastname" => "Le Floch",
        "gender" => "F"
    ], [
        "firstname" => "Capitaine",
        "lastname" => "Crochet",
        "gender" => "M"
    ], [
        "firstname" => "François",
        "lastname" => "Hollande",
        "gender" => "M"
    ], [
        "firstname" => "Phillipe",
        "lastname" => "Je sais ou tu te caches",
        "gender" => "M"
    ], [
        "firstname" => "Postbad",
        "lastname" => "Jean Luc",
        "gender" => "M"
    ], [
        "firstname" => "Jair",
        "lastname" => "Bolsonaro",
        "gender" => "M"
    ], [
        "firstname" => "Newbie",
        "lastname" => "Des champs de legs",
        "gender" => "M"
    ], [
        "firstname" => "Nadèje",
        "lastname" => "Guionnière",
        "gender" => "M"
    ], [
        "firstname" => "Mateo",
        "lastname" => "Guionnière",
        "gender" => "F"
    ], [
        "firstname" => "Aniès",
        "lastname" => "Guionnière",
        "gender" => "F"
    ], [
        "firstname" => "Ronan",
        "lastname" => "Guionnière",
        "gender" => "M"
    ], [
        "firstname" => "Phillipe",
        "lastname" => "Guionnière",
        "gender" => "M"
    ], [
        "firstname" => "Louise",
        "lastname" => "Gervais",
        "gender" => "F"
    ], [
        "firstname" => "Fiona",
        "lastname" => "Dorigné",
        "gender" => "F"
    ], [
        "firstname" => "Lucas",
        "lastname" => "Richer",
        "gender" => "M"
    ], [
        "firstname" => "Maxime",
        "lastname" => "Blanchet",
        "gender" => "M"
    ], [
        "firstname" => "Clément",
        "lastname" => "Blanchet",
        "gender" => "M"
    ], [
        "firstname" => "Maxence",
        "lastname" => "Poil",
        "gender" => "M"
    ], [
        "firstname" => "Olivier",
        "lastname" => "Legros",
        "gender" => "M"
    ], [
        "firstname" => "Roman",
        "lastname" => "Stadniki",
        "gender" => "M"
    ], [
        "firstname" => "Bénédicte",
        "lastname" => "Florain",
        "gender" => "F"
    ], [
        "firstname" => "Alain",
        "lastname" => "Génain",
        "gender" => "M"
    ], [
        "firstname" => "Ana",
        "lastname" => "Madoeuf",
        "gender" => "F"
    ], [
        "firstname" => "Nicolas",
        "lastname" => "Sarkozy",
        "gender" => "M"
    ], [
        "firstname" => "Olivier",
        "lastname" => "Giroux",
        "gender" => "M"
    ], [
        "firstname" => "Olivier",
        "lastname" => "Marchall",
        "gender" => "M"
    ], [
        "firstname" => "Arnaud",
        "lastname" => "Montillon",
        "gender" => "M"
    ], [
        "firstname" => "Sandra",
        "lastname" => "Chardeunou",
        "gender" => "F"
    ], [
        "firstname" => "Arthur",
        "lastname" => "Clément",
        "gender" => "M"
    ], [
        "firstname" => "Antonin",
        "lastname" => "Bouzy",
        "gender" => "M"
    ], [
        "firstname" => "Dolores",
        "lastname" => "Davaux",
        "gender" => "F"
    ], [
        "firstname" => "Sandra",
        "lastname" => "Cornard",
        "gender" => "F"
    ], [
        "firstname" => "Flavie",
        "lastname" => "Popovic",
        "gender" => "F"
    ], [
        "firstname" => "Jacqueline",
        "lastname" => "Bousquet",
        "gender" => "F"
    ], [
        "firstname" => "Pierre-Phillipe",
        "lastname" => "Bousquet",
        "gender" => "M"
    ], [
        "firstname" => "Tom",
        "lastname" => "Bousquet",
        "gender" => "M"
    ], [
        "firstname" => "Jennifer",
        "lastname" => "Kuziolek",
        "gender" => "F"
    ], [
        "firstname" => "Louise",
        "lastname" => "Bousquet",
        "gender" => "F"
    ], [
        "firstname" => "Georges",
        "lastname" => "Pointis",
        "gender" => "M"
    ], [
        "firstname" => "Susan",
        "lastname" => "Mayer",
        "gender" => "F"
    ], [
        "firstname" => "Susan",
        "lastname" => "Delfino",
        "gender" => "F"
    ], [
        "firstname" => "Rogelio",
        "lastname" => "De La Vega",
        "gender" => "M"
    ], [
        "firstname" => "Gabrielle",
        "lastname" => "Solis",
        "gender" => "F"
    ], [
        "firstname" => "Carlos",
        "lastname" => "Solis",
        "gender" => "M"
    ], [
        "firstname" => "Ruanita",
        "lastname" => "Solis",
        "gender" => "F"
    ], [
        "firstname" => "Celia",
        "lastname" => "Solis",
        "gender" => "F"
    ], [
        "firstname" => "Bree",
        "lastname" => "Hodge",
        "gender" => "F"
    ], [
        "firstname" => "Bree",
        "lastname" => "Van Der Kamp",
        "gender" => "F"
    ], [
        "firstname" => "Horson",
        "lastname" => "Hodge",
        "gender" => "M"
    ], [
        "firstname" => "Andrew",
        "lastname" => "Van Der Kamp",
        "gender" => "M"
    ], [
        "firstname" => "Danielle",
        "lastname" => "Van Der Kamp",
        "gender" => "F"
    ], [
        "firstname" => "Lynette",
        "lastname" => "Scavot",
        "gender" => "F"
    ], [
        "firstname" => "Tom",
        "lastname" => "Scavot",
        "gender" => "M"
    ], [
        "firstname" => "Porter",
        "lastname" => "Scavot",
        "gender" => "M"
    ], [
        "firstname" => "Preston",
        "lastname" => "Scavot",
        "gender" => "M"
    ], [
        "firstname" => "Parker",
        "lastname" => "Scavot",
        "gender" => "M"
    ], [
        "firstname" => "Penny",
        "lastname" => "Scavot",
        "gender" => "F"
    ], [
        "firstname" => "Page",
        "lastname" => "Scavot",
        "gender" => "F"
    ]
];

foreach ($usersData as $userData) {
    $user = new User();
    $user->firstname = $userData["firstname"];
    $user->lastname = $userData["lastname"];
    $user->gender = $userData["gender"];
    $user->email = $user->firstname . "." . $user->lastname . "@agile-web.dev";
    $user->active = 1;
    $user->role = "admin";
    $user->password = password_hash("letmein", PASSWORD_DEFAULT);
    $user->creation_date = (new DateTime())->format("Y-m-d");
    $user->save();
}


