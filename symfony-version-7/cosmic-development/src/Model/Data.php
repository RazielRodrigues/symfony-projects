<?php

namespace App\Model;

class Data
{

    public function __construct(
        private int $id,
        private string $name,
        private int $age
    ) {
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }
}
