<?php

class Seminar {
    private $id = 0;
    private $titel = '';
    private $beschreibung = '';
    private $preis = 0.0;
    private $kategorie = '';

    private static $db = null;
    private static $table = 'seminare';
    
    public function  __construct(array $daten = array()) {
        if ($daten) {
            foreach ($daten as $key => $value) {
                // z.B. setTitel, setPreis
                $setterName = 'set' . ucfirst($key);
                // ruft $this->setTitel($value) auf
                $this->$setterName($value);
            }
        }
    }

    public function  __toString() {
        return $this->getTitel();
    }

    public function getId() {
        return $this->id;
    }

    public function getTitel() {
        return $this->titel;
    }

    public function setTitel($titel) {
        $this->titel = $titel;
    }

    public function getBeschreibung() {
        return $this->beschreibung;
    }

    public function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
    }

    public function getPreis() {
        return $this->preis;
    }

    public function setPreis($preis) {
        $this->preis = $preis;
    }

    public function getKategorie() {
        return $this->kategorie;
    }

    public function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }

    public function getTermine() {
        return Seminartermin::selectBySeminar_id($this->getId());
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function save() {
        // entscheidet über insert und update
        if ( $this->getId() === 0 ) {
            $this->_insert();
        } else {
            $this->_update();
        }
    }

    public function delete() {
        $sql = 'DELETE FROM seminare WHERE id = ?';
        $statement = self::$db->prepare($sql);

        $daten = array( $this->getId() );
        $statement->execute($daten);

        // id auf 0, da der Datensatz in seminare nicht mehr existiert
        $this->id = 0;
    }
    
    private function _insert() {
        $sql = 'INSERT INTO seminare (titel, beschreibung, preis, kategorie)
            VALUES (:titel, :beschreibung, :preis, :kategorie)';
        $statement = self::$db->prepare($sql);
        $daten = $this->toArray();
        unset($daten['id']);
        $statement->execute($daten);

        // weise die neue DB-id dem Attribut $id zu
        $this->id = self::$db->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE seminare SET titel = :titel, beschreibung = :beschreibung,
            preis = :preis, kategorie = :kategorie WHERE id = :id';
        $statement = self::$db->prepare($sql);
        $daten = $this->toArray();
        $statement->execute($daten);
    }

    public static function selectAll() {
        $sql = 'SELECT * FROM ' . self::$table;
        $statement = self::$db->query($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetchAll();
    }

    public static function select($id) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = ?';
        $statement = self::$db->prepare($sql);
        $statement->execute( array($id) );
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetch();
    }

    public static function selectByKategorie($kategorie, $order = 'titel') {
        $spalten = array('titel', 'preis', 'kategorie');
        if ( ! in_array($order, $spalten) ) {
            $order = 'titel';
        }
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE kategorie = ? ORDER BY ' . $order;
        $statement = self::$db->prepare($sql);
        $statement->execute( array($kategorie) );
        $statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $statement->fetchAll();
    }

    public static function connect(PDO $db) {
        self::$db = $db;
    }
}