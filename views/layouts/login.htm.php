<?php
/** @var $content */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GreenHouse</title>
    <link rel="stylesheet" href="<?= resource("style/css", "main.css")?>" />
</head>
<body>
    <div id="login_bg">
        <div id="titleImg"></div>
        <!--<img src="<?= resource("images", "GreenHouse.png") ?>" id="titleImg" alt="title">-->
        <?= $content; ?>
    </div>
</body>
</html>
