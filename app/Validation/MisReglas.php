<?php

namespace App\Validation;

class MisReglas
{
    /**
     * Valida el formato del DNI o NIE español.
     * Ejemplos válidos:
     *   DNI: 12345678Z
     *   NIE: X1234567L
     */
    public function dni_nie_valido(string $str, string $fields, array $data): bool
    {
        $str = strtoupper(trim($str));

        // Patrón para DNI (8 números + 1 letra)
        $dniRegex = '/^[0-9]{8}[A-Z]$/';

        // Patrón para NIE (X, Y o Z seguido de 7 números y 1 letra)
        $nieRegex = '/^[XYZ][0-9]{7}[A-Z]$/';

        return preg_match($dniRegex, $str) || preg_match($nieRegex, $str);
    }
}
?>