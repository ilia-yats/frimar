<?php
namespace Frimar;

/**
 * Contact model
 *
 * Class Contact
 * @package Frimar
 */
class Contact
{
    public $id = NULL;

    public $data = [
        'name'        => NULL,
        'email'       => NULL,
        'phone'       => NULL,
        'street_id'   => NULL,
    ];

    public function feed_data($data, $id = NULL)
    {
        if( ! is_null($id)) {
            $this->id = $id;
        }

        foreach($this->data as $field => $value) {
            if(isset($data[$field])) {
                $this->data[$field] = $data[$field];
            }

            if(is_null($this->data[$field])) {
                throw new \Exception('Cannot create contact instance due to the lack of data');
            }
        }
    }

    public function __get($name)
    {
        return array_key_exists($name, $this->data) ? $this->data[$name] : NULL;
    }

    public function __set($name, $value)
    {
        if(array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
        } else {
            throw new \Exception('Trying to set unknown property of contact');
        }
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->data);
    }
}