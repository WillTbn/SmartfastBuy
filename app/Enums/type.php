<?php

namespace App\Enums;

enum type:string implements InterfacePermissions
{
    CASE MASTER = "M";
    CASE VENDEDOR = "V";
    CASE ESTOQUISTA = "E";
    CASE CLIENTE = "C";

    public function getValue():string
    {
        return $this->name;
    }
    public function actions(): Array
    {
        // Create Read Upload Delete
        return match($this){
            type::MASTER => [ 'READ'],
            type::VENDEDOR => ['CREATED', 'DELETED', 'UPLOAD', 'READ'],
            type::ESTOQUISTA => ['CREATED', 'DELETED', 'UPLOAD', 'READ'],
            type::CLIENTE => ['READ'],
        };
    }

}
