<?php

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nickname', 'email', 'password'];

    public static function validate($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = 'Please fill in a name';
        }
        if (empty($data['email'])) {
            $errors[] = 'Please fill in an e-mail';
        }
        if (empty($data['city'])) {
            $errors[] = 'Please fill in a city';
        }
        if (empty($data['password'])) {
            $errors[] = 'Please fill in a password';
        }

        return $errors;
    }
}
