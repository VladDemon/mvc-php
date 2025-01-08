<?php

namespace App\Components\Interfaces;

use PDO;

interface DatabaseInterface
{
    public function getDb () : PDO;
    public function get_assoc_data_by_query ($query, array $attr) : array;
}
