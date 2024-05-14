<?php

abstract class Entity
{
    protected $dbc;
    protected $tableName;
    protected $fields;

    abstract protected function initFields();

    protected function __construct($dbc, $tableName){
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }


    public function findBy($fieldName, $fieldValue){


        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $fieldName . " = :value";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value'=> $fieldValue]);
        $databaseData = $stmt->fetch();

        if($databaseData){
            $this->setValues($databaseData);
        }

    }

    public function setValues($values) {

        foreach ($this->fields as $fieldName) {
            $this->$fieldName = $values[$fieldName];
            $_SESSION[$fieldName] = $values[$fieldName];

        }

    }

}