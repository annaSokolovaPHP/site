<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table    = 'menu_items';
    protected $fillable = [
        'title',
        'url',
        'menu_id',
        'order',
        'icon_class'
    ];

    public function menus(){
        return $this->hasOne('App\Menus', 'id', 'menu_id');
    }

    public function rules($id = null){
        return [
            'menu_id'     => 'required|exists:menus,id',
            'title'       => 'required|max:30',
            'url'         => 'required|max:30',
            'order'       => 'required|numeric',
        ];
    }

    public function messageValidate(){
        return [
            'alpha_dash' => "Поле должно"
        ];
    }
}
