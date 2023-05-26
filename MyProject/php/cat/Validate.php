<?php
namespace MyProject\php\cat;

class Validate {
    private array $errors = array();
    
    /**
     * Prüfen, ob ein Wert (aus Formular) ausgefüllt ist.
     * @param string $wert Der Wert, der auf "ausgefüllt" geprüft werden soll.
     * @param string $feldname Name des Formularfeldes für die Fehlermeldung.
     * @return bool False wenn $wert leer ist, ansonsten true.
     */
    public function isFilled(string $value, string $fieldName): bool { 
        if (empty($value)) {
            $this->errors[] = "{$fieldName} was empty.";
            return false;
        }
        return true;
    }

    public function addError(string $errorMessage): void {
        $this->errors[] = $errorMessage;
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }

    public function errorHtml(): string {
        if (!$this->hasErrors()) {
            return "";
        }

        $ret = "<ul>";
        foreach ($this->errors as $error) {
            $ret .= "<li>{$error}</li>";
        }
        $ret .= "</ul>";
        return $ret;
    }

}