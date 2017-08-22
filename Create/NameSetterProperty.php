<?php

namespace Klev\Yandex\YmlCreate\Create;

trait NameSetterProperty
{

    protected function nameSetterProperty($name)
    {
        $str = '';
        $name_array = explode('_',$name);
        foreach ($name_array as $item) {
            $str .= ucfirst($item);
        }
        return 'set'.$str;
    }

    protected function nameGetterProperty($name)
    {
        $str = '';
        $name_array = explode('_',$name);
        foreach ($name_array as $item) {
            $str .= ucfirst($item);
        }
        return 'get'.$str;
    }
}