<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\User;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('пользователь', 'пользователи');

        CRUD::addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Имя',
        ]);

        CRUD::addColumn([
            'name' => 'username',
            'type' => 'text',
            'label' => 'Имя пользователя',
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
        ]);

        CRUD::addColumn([
            'name' => 'is_blocked',
            'type' => 'boolean',
            'label' => 'Заблокирован',
        ]);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Имя',
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        CRUD::addField([
            'name' => 'username',
            'type' => 'text',
            'label' => 'Имя пользователя',
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        CRUD::addField([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        CRUD::addField([
            'name' => 'is_blocked',
            'type' => 'checkbox',
            'label' => 'Заблокирован',
        ]);
    }
}
