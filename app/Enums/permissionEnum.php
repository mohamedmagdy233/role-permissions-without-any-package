<?php
namespace App\Enums;


enum permissionEnum: string
{

    case CATEGORY = 'category';
    case ADMIN = 'admin';
    case SETTING = 'setting';

    case HOME   ='home';
    case ROLE   ='role';


    public function permissions():array
    {
        return [
            'create_'.$this->value,
            'update_'.$this->value,
            'delete_'.$this->value,
            'view_'.$this->value
        ];

    }





}
