<?php

class Seminartermin {
    private $id = 0;
    private $beginn = '';
    private $ende = '';
    private $raum = '';
    private $seminar_id = 0;

    private $errors = array();

    private static $db = null;
    private static $tableName = 'seminartermine';

    public function  __construct(array $daten = array()) {
        if ($daten) {
            foreach ($daten as $key => $value) {
                $setterName = 'set' . ucfirst($key);
                $this->$setterName($value);
            }
        }
    }

    public function  __toString() {
        return 'von ' . $this->getBeginn() .
               ' bis ' . $this->getEnde();
    }

    public function getId() {
        return $this->id;
    }

    public function getBeginn() {
        return $this->beginn;
    }

    public function setBeginn($beginn) {
        if ( preg_match('/^\d{4}-\d{2}-\d{2}$/', $beginn) ) {
            $this->beginn = $beginn;
        } else {
            $this->errors['beginn'] = 'Beginn muss das Format yyyy-mm-dd haben.';
        }
    }

    public function getEnde() {
        return $this->ende;
    }

    public function setEnde($ende) {
        $this->ende = $ende;
    }

    public function getRaum() {
        return $this->raum;
    }

    public function setRaum($raum) {
        if ( empty($raum) ) {
            $this->errors['raum'] = 'Raum darf nicht leer sein.';
        } else {
            $this->raum = $raum;
        }
    }

    public function getSeminar_id() {
        return $this->seminar_id;
    }

    public function setSeminar_id($seminar_id) {
        $this->seminar_id = $seminar_id;
    }

    public function getSeminar() {
        return Seminar::select($this->getSeminar_id());
    }

    public function setSeminar(Seminar $seminar) {
        $this->setSeminar_id($seminar->getId());
    }

    public function toArray() {
        $daten = get_object_vars($this);
        unset($daten['errors']);
        return $daten;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function isValid() {
        return empty($this->errors);
    }

    /**
     * entscheidet über insert und update
     */
    public function save() {
        if ($this->getId() === 0) {
            $this->_insert();
        }else {
            $this->_update();
        }

    }

    public function delete() {
        // Tabellenname auch als statisches Attribut verwendbar
        // delete auch als statische Methode anlegbar $seminar::delete(5)
        // und sofort mit Parameterübergabe
        // ohne Parameter (wie hier) muss man zuerst das Objekt holen und dann löschen

        $sql = 'DELETE FROM '. self::$tableName .' WHERE id = ?';
        $statement = self::$db->prepare($sql);
        $statement->execute(array($this->getId()));

        // id auf 0 setzen, da der Datensatz in seminare nicht mehr existiert
        $this->id = 0;
    }

    /**
     * findAll wäre auch eine gute Bezeichnung
     */
    public static function selectAll() {
        // prepare nur bei Nutzereingaben sinnvoll,
        // daher hier direkt den query ausführen
        $sql = 'SELECT * FROM '.self::$tableName;
        $statement = self::$db->query($sql);

        // Fetch Mode setzen, Objekte werden zurückgegeben
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetchAll();
    }

    /**
     * find wäre auch ein guter Name
     * @param int $id
     */
    public static function select($id) {
        $sql = 'SELECT * FROM '.self::$tableName.' WHERE id = ?';
        $statement = self::$db->prepare($sql);
        $statement->execute( array($id) );
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetch();
    }

    public static function selectBySeminar_id($seminar_id) {
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE seminar_id = ?';
        $statement = self::$db->prepare($sql);
        $statement->execute( array($seminar_id) );
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetchAll();
    }


    /**
     * update
     */
    private function _update() {
        $sql = 'UPDATE ' . self::$tableName . ' SET beginn = :beginn, ende = :ende,
            raum = :raum, seminar_id = :seminar_id WHERE id = :id';
        $statement = self::$db->prepare($sql);
        $daten = $this->toArray();
        $statement->execute($daten);
    }

    /**
     * insert
     */
    private function _insert() {
        $sql = 'INSERT INTO '. self::$tableName .' (beginn, ende, raum, seminar_id)
            VALUES (:beginn, :ende, :raum, :seminar_id)';
        $statement = self::$db->prepare($sql);
        $daten = $this->toArray();
        unset($daten['id']);
        $statement->execute($daten);

        // weise die neue DB-id dem Attribut $id zu
        // wichtig für Unterscheidung zw. insert und update
        $this->id = self::$db->lastInsertId();

    }

    public static function connect(PDO $db) {
        self::$db = $db;
    }
}