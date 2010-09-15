<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php echo flash() ?></p>
        <pre><?php var_dump($errors) ?></pre>
        <form action="seminartermin_bearbeiten.php" method="post">
            <input type="hidden" name="id" value="<?php echo $termin->getId() ?>" />
            Seminar:
            <select name="seminar_id">
                <?php foreach ($seminare as $s) { ?>
                    <option value="<?php echo $s->getId() ?>"
                        <?php if ( $termin->getSeminar_id() == $s->getId() )
                                echo 'selected="selected"' ?>
                            >
                        <?php echo $s ?>
                    </option>
                <?php } ?>
            </select><br />
            Beginn: <input type="text" name="beginn" value="<?php echo $termin->getBeginn() ?>" /><br />
            Ende: <input type="text" name="ende" value="<?php echo $termin->getEnde() ?>" /><br />
            Raum: <input type="text" name="raum" value="<?php echo $termin->getRaum() ?>" /><br />
            <input type="submit" value="speichern" />
        </form>
    </body>
</html>
