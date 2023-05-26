<?php

namespace MyProject\php\cat\row;

use MyProject\php\cat\Mysql;

abstract class RowAbstract {
    protected string $table;

    private array $data = array();

    public function __construct(int|array $idOrData) {
        if (is_int($idOrData)) {
            // id wurde übergeben, Daten aus Datenbank auslesen
            $db = Mysql::getInstance();
            $sqlId = $db->escape($idOrData);
            $result = $db->query("SELECT * FROM {$this->table} WHERE id = '{$sqlId}' ");
            $this->data = $result->fetch_assoc();
        } else {
            // Fertiges array wurde übergeben, verwenden wie gegeben.
            $this->data = $idOrData;
        }
    }

    public function __get(string $properties): mixed {
        if (!array_key_exists($properties, $this->data)) {
            throw new \Exception("That column {$properties} does not exist in the table.");
        }
        return $this->data[$properties];
    }

    public function delete(): void {
        $db = Mysql::getInstance();
        $sqlId = $db->escape($this->id);
        $db->query("DELETE FROM {$this->table} WHERE id = '{$sqlId}' ");
    }

    public function save(): void {
        $db = Mysql::getInstance();

        // Felder für SQL-Abfrage zusammen bauen
        $sqlField = "";
        foreach ($this->data as $columnName => $valueForm) {
            if ($columnName == "id") {
                continue;
            }
            $sqlValueForm = $db->escape($valueForm);
            $sqlField .= "{$columnName} = '{$sqlValueForm}', ";
        }

        // Letztes Komma entfernen
        $sqlField = rtrim($sqlField, " ,");

        if ( !empty($this->data["id"]) ) {
            // in DB bearbeiten
            $sqlId = $db->escape($this->data["id"]);
            $db->query("UPDATE {$this->table} SET {$sqlField} WHERE id = '{$sqlId}' ");
        } else {
            // in DB einfügen
            
            $db->query("INSERT INTO {$this->table} SET {$sqlField} ");
        }
    }
}