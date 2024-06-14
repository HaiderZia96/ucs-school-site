<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['permission-group-list',1],
            ['permission-group-create',1],
            ['permission-group-edit',1],
            ['permission-group-delete',1],
            ['permission-list',1],
            ['permission-create',1],
            ['permission-edit',1],
            ['permission-delete',1],
            ['role-list',2],
            ['role-create',2],
            ['role-edit',2],
            ['role-delete',2],
            ['user-list',2],
            ['user-create',2],
            ['user-edit',2],
            ['user-delete',2],
            ['dashboard',2],
            ['contact-list',2],
            ['news-categories-list',2],
            ['news-categories-create',2],
            ['news-categories-restore',2],
            ['news-categories-delete',2],
            ['news-categories-edit',2],
            ['news-categories-softdelete',2],
            ['tags-list',2],
            ['tags-create',2],
            ['tags-restore',2],
            ['tags-delete',2],
            ['tags-edit',2],
            ['tags-softdelete',2],
            ['news-and-events-list',2],
            ['news-and-events-create',2],
            ['news-and-events-edit',2],
            ['news-and-events-delete',2],
            ['news-and-events-restore',2],
            ['news-and-events-softdelete',2],
            ['popup-list',2],
            ['popup-create',2],
            ['popup-restore',2],
            ['popup-delete',2],
            ['popup-edit',2],
            ['popup-softdelete',2],
            ['prospectus-list',2],
            ['prospectus-create',2],
            ['prospectus-restore',2],
            ['prospectus-delete',2],
            ['prospectus-edit',2],
            ['prospectus-softdelete',2],
            ['calendar-list',2],
            ['calendar-create',2],
            ['calendar-restore',2],
            ['calendar-delete',2],
            ['calendar-edit',2],
            ['calendar-softdelete',2],

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['0'],'group_id'=>$permission[1]]);
        }
    }
}
