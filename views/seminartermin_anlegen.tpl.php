<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Seminartermin anlegen</title>
    </head>
    <body>
        <p><?php echo flash() ?></p>
        <pre><?php var_dump($errors) ?></pre>
        <form action="seminartermin_anlegen.php" method="post">
            Seminar:
            <select name="seminar_id">
                <?php foreach ($seminare as $s) { ?>
                    <option value="<?php echo $s->getId() ?>">
                        <?php echo $s ?>
                    </option>
                <?php } ?>
            </select><br />
            Beginn: <input type="text" name="beginn" /><br />
            Ende: <input type="text" name="ende" /><br />
            Raum: <input type="text" name="raum" /><br />
            <input type="submit" value="speichern" />
        </form>
    </body>
</html>
