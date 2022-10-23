<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions = Permission::select('name')->get();
        // foreach ($permissions as $permission) {
        //     $rolePermissions[] = $permission->name;
        // }

        $roleKonten = [
            '1' => ['Super Admin',
                    ['admin.*']],
            '2' => ['Developer',
                    ['admin.*','admin.privilage.*','admin.navigation.*']],
            '3' => ['Admin',
                    ['admin.dashboard','admin.user.read','admin.tag.*','admin.file-manager.*','admin.post.*','admin.comment.*'
                    ,'admin.form.read','admin.setting.read','admin.setting.update']],
            '4' => ['Editor',
                    ['admin.dashboard','admin.post.*','admin.tag.*','admin.file-manager.*'
                    ,'admin.form.read','admin.setting.read','admin.setting.update']],
            '5' => ['Copyeditor',
                    ['admin.dashboard','admin.tag.*'
                    ,'admin.post.page.read','admin.post.notice.read','admin.post.video.read','admin.post.product.read'
                    ,'admin.post.page.update','admin.post.notice.update','admin.post.video.update','admin.post.product.update'
                    ,'admin.post.page.create','admin.post.notice.create','admin.post.video.create','admin.post.product.create'
                    ,'admin.post.page.delete','admin.post.notice.delete','admin.post.video.delete','admin.post.product.delete']],
            '6' => ['Writer',
                    ['admin.dashboard','admin.tag.read','admin.tag.create'
                      ,'admin.post.page.read','admin.post.notice.read','admin.post.video.read','admin.post.product.read'
                      ,'admin.post.page.update','admin.post.notice.update','admin.post.video.update','admin.post.product.update'
                      ,'admin.post.page.create','admin.post.notice.create','admin.post.video.create','admin.post.product.create']]
        ];
        foreach ($roleKonten as $key => $value) {
            $role = Role::updateOrCreate([
                'id'    => $key,
            ], [
                'name' => $value[0],
            ]);
            $role->syncPermissions($value[1]);
            // $role->syncPermissions($rolePermissions);
        }
    }
}
