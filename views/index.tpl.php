<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Seminartermine</title>
    </head>
    <body>
        <p><?php echo flash() ?></p>
        <table border="1">
            <tr>
                <th>Seminar</th>
                <th>Beginn</th>
                <th>Ende</th>
                <th>Raum</th>
                <th>editieren</th>
                <th>löschen</th>
            </tr>

            <?php foreach ($termine as $t) { ?>
                <tr>
                    <td><?php echo $t->getSeminar() ?></td>
                    <td><?php echo $t->getBeginn() ?></td>
                    <td><?php echo $t->getEnde() ?></td>
                    <td><?php echo $t->getRaum() ?></td>
                    <td>
                        <a href="seminartermin_bearbeiten.php?id=<?php echo $t->getid() ?>">
                            editieren
                        </a>
                    </td>
                    <td>
                        <a href="seminartermin_loeschen.php?id=<?php echo $t->getid() ?>">
                            löschen
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <p><a href="seminartermin_anlegen.php">Neuen Termin anlegen</a></p>
    </body>
</html>