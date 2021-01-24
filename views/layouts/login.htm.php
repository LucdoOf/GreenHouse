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
        <?= $content; ?>
    </div>
    <div id="notification-container"></div>
    <script src="<?= resource("scripts", "common.js") ?>"></script>
    <script src="<?= resource("scripts/classes", "Ui.js") ?>"></script>
    <?php if(isset($alert) && isset($alert["message"]) && isset($alert["type"])): ?>
        <script type="text/javascript">
            Ui.notify("<?= addslashes($alert["message"]) ?>", "<?= $alert["type"] ?>");
        </script>
    <?php endif; ?>
</body>
</html>
