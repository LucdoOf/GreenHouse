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
    $user->save();
}


