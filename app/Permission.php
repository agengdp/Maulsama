<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
        // Ini adalah bagian khusus root
        'view_users',
        'add_users',
        'edit_users',
        'delete_users',

        'view_roles',
        'add_roles',
        'edit_roles',
        'delete_roles',

        'view_pages',
        'add_pages',
        'edit_pages',
        'delete_pages',

        'view_settings',
        'add_settings',
        'edit_settings',
        'delete_settings',

        // Ini untuk admin
        'view_series',
        'add_series',
        'edit_series',
        'delete_series',

        'view_episode',
        'add_episode',
        'edit_episode',
        'delete_episode',

        'view_movie',
        'add_movie',
        'edit_movie',
        'delete_movie',

        'view_genre',
        'add_genre',
        'edit_genre',
        'delete_genre',

      ];
    }
}
