<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

/*
php artisan make:migration create_coupons_table --create=coupons
php artisan make:migration create_permission_table --create=permission
php artisan make:migration create_product_table --create=product
php artisan make:migration create_category_table --create=category
php artisan make:migration create_product_group_table --create=product_group
php artisan make:migration create_product_info_table --create=product_info
php artisan make:migration create_order_table --create=order
php artisan make:migration create_group_order_table --create=group_order

*/