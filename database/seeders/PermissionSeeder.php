<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin.*',
            'admin.dashboard',

            'admin.user.*',
            'admin.user.create',
            'admin.user.read',
            'admin.user.update',
            'admin.user.delete',

            'admin.tag.*',
            'admin.tag.create',
            'admin.tag.read',
            'admin.tag.update',
            'admin.tag.delete',

            'admin.file-manager.*',
            'admin.file-manager.create',
            'admin.file-manager.read',
            'admin.file-manager.update',
            'admin.file-manager.delete',

            'admin.post.*',

            'admin.post.page.*',
            'admin.post.page.create',
            'admin.post.page.read',
            'admin.post.page.update',
            'admin.post.page.publish',
            'admin.post.page.delete',

            'admin.post.notice.*',
            'admin.post.notice.create',
            'admin.post.notice.read',
            'admin.post.notice.update',
            'admin.post.notice.publish',
            'admin.post.notice.delete',

            'admin.post.video.*',
            'admin.post.video.create',
            'admin.post.video.read',
            'admin.post.video.update',
            'admin.post.video.publish',
            'admin.post.video.delete',

            'admin.post.product.*',
            'admin.post.product.create',
            'admin.post.product.read',
            'admin.post.product.update',
            'admin.post.product.publish',
            'admin.post.product.delete',

            'admin.post.hero.*',
            'admin.post.hero.create',
            'admin.post.hero.read',
            'admin.post.hero.update',
            'admin.post.hero.publish',
            'admin.post.hero.delete',

            'admin.navigation.*',
            'admin.navigation.create',
            'admin.navigation.read',
            'admin.navigation.update',
            'admin.navigation.delete',

            'admin.comment.*',
            'admin.comment.create',
            'admin.comment.read',
            'admin.comment.update',
            'admin.comment.delete',

            'admin.document.*',
            'admin.document.create',
            'admin.document.read',
            'admin.document.update',
            'admin.document.delete',

            'admin.privilage.*',
            'admin.privilage.role.*',
            'admin.privilage.role.create',
            'admin.privilage.role.read',
            'admin.privilage.role.update',
            'admin.privilage.role.delete',
            'admin.privilage.perm.*',
            'admin.privilage.perm.create',
            'admin.privilage.perm.read',
            'admin.privilage.perm.update',
            'admin.privilage.perm.delete',

            'admin.form.*',
            'admin.form.read',
            'admin.form.manage',

            'admin.setting.*',
            'admin.setting.create',
            'admin.setting.read',
            'admin.setting.update',
            'admin.setting.delete',
        ];
        for ($i = 0; $i < count($permissions); $i++) {
            Permission::updateOrCreate([
                'id' => ($i + 1),
            ], [
                'name' => $permissions[$i],
            ]);
        }
    }
}
