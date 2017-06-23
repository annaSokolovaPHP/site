<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForAdmin extends User
{
    protected $table    = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role_id'
    ];

    public function rules($id = null){
        return [
            'name'      => 'required|min:3|max:30|unique:users,name,'.$id,
            'email'     => 'required|email|unique:users,email,'.$id,
            'password'  => 'required',
            'avatar'    => 'ext:jpg,gif,png,jpeg,image/jpeg,image/png',
            'role_id'   => 'required|exists:roles,id'
        ];
    }
}
