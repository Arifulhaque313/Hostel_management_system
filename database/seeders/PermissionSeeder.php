<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ----------- Admin Backend Access -------------- //

        // Dashboard
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard',
        ]);


        // Role management
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Roles',
            'slug' => 'app.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy',
        ]);
        

        // User management
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access Users',
            'slug' => 'app.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy',
        ]);

        // Categories
        $moduleAppCategories = Module::updateOrCreate(['name' => 'Category']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategories->id,
            'name' => 'Access Category',
            'slug' => 'app.categories.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategories->id,
            'name' => 'Create Category',
            'slug' => 'app.category.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategories->id,
            'name' => 'Update Category',
            'slug' => 'app.category.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategories->id,
            'name' => 'Delete Category',
            'slug' => 'app.category.delete',
        ]);

        // Sub Category
        $moduleAppSubCategories = Module::updateOrCreate(['name' => 'Sub Category']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategories->id,
            'name' => 'Access Sub Category',
            'slug' => 'app.subcategories.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategories->id,
            'name' => 'Create Sub Category',
            'slug' => 'app.subcategory.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategories->id,
            'name' => 'Update Sub Category',
            'slug' => 'app.subcategory.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategories->id,
            'name' => 'Delete Sub Category',
            'slug' => 'app.subcategory.delete',
        ]);



        // Variants
        $moduleAppVariant = Module::updateOrCreate(['name' => 'Attributes']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Access Attributes',
            'slug' => 'app.variants.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Create Variant',
            'slug' => 'app.variants.store',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Edit Variant',
            'slug' => 'app.variants.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Delete Variant',
            'slug' => 'app.variants.destroy',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Add Property',
            'slug' => 'app.variants.property.store',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVariant->id,
            'name' => 'Delete Property',
            'slug' => 'app.variants.property.destroy',
        ]);


        // Inbox
        $moduleAppInbox = Module::updateOrCreate(['name' => 'Inbox']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppInbox->id,
            'name' => 'Access Inbox',
            'slug' => 'app.inbox.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppInbox->id,
            'name' => 'Update Inquiry Status',
            'slug' => 'app.inbox.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppInbox->id,
            'name' => 'Delete Inquiry',
            'slug' => 'app.inbox.delete',
        ]);


        // Schedule
        $moduleAppSchedule = Module::updateOrCreate(['name' => 'Schedule']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSchedule->id,
            'name' => 'All Schedule',
            'slug' => 'app.schedule.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSchedule->id,
            'name' => 'Schedule Create',
            'slug' => 'app.schedule.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSchedule->id,
            'name' => 'Update Schedule',
            'slug' => 'app.schedule.edit',
        ]);


        Permission::updateOrCreate([
            'module_id' => $moduleAppSchedule->id,
            'name' => 'Delete the schedule',
            'slug' => 'app.schedule.delete',
        ]);


        // Program
        $moduleAppProgram = Module::updateOrCreate(['name' => 'Program']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProgram->id,
            'name' => 'All Programs',
            'slug' => 'app.program.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProgram->id,
            'name' => 'Program Create',
            'slug' => 'app.program.create',
        ]);


        Permission::updateOrCreate([
            'module_id' => $moduleAppProgram->id,
            'name' => 'Program Update',
            'slug' => 'app.program.edit',
        ]);


        Permission::updateOrCreate([
            'module_id' => $moduleAppProgram->id,
            'name' => 'Delete Program',
            'slug' => 'app.program.delete',
        ]);


        // Product
        $moduleAppProduct = Module::updateOrCreate(['name' => 'Product']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProduct->id,
            'name' => 'Product Index',
            'slug' => 'app.product.index',
        ]);
        
        Permission::updateOrCreate([
            'module_id' => $moduleAppProduct->id,
            'name' => 'Product Create',
            'slug' => 'app.product.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProduct->id,
            'name' => 'Product Edit',
            'slug' => 'app.product.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProduct->id,
            'name' => 'Product Update Status',
            'slug' => 'app.product.update.status',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProduct->id,
            'name' => 'Product Delete',
            'slug' => 'app.product.destroy',
        ]);

        // Blog Category
        $moduleAppBlogCategory = Module::updateOrCreate(['name' => 'BlogCategory']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'All Blog Category',
            'slug' => 'app.blog-categories.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Blog Category Create',
            'slug' => 'app.blog-categories.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Blog Category Edit',
            'slug' => 'app.blog-categories.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Blog Category Delete',
            'slug' => 'app.blog-categories.delete',
        ]);

        // Blog Post
        $moduleAppBlog = Module::updateOrCreate(['name' => 'Blog']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlog->id,
            'name' => 'All Blog Post',
            'slug' => 'app.blogs.index',
        ]);


        Permission::updateOrCreate([
            'module_id' => $moduleAppBlog->id,
            'name' => 'Blog Post Create',
            'slug' => 'app.blog.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlog->id,
            'name' => 'Blog Post Edit',
            'slug' => 'app.blog.edit',
        ]);


        Permission::updateOrCreate([
            'module_id' => $moduleAppBlog->id,
            'name' => 'Blog Delete',
            'slug' => 'app.blog.destroy',
        ]);


        // Blog Category
        $moduleAppGalleryCategory = Module::updateOrCreate(['name' => 'GalleriesCategory']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalleryCategory->id,
            'name' => 'All Blog Category',
            'slug' => 'app.gallery-categories.index',
        ]);
        
        Permission::updateOrCreate([
            'module_id' => $moduleAppGalleryCategory->id,
            'name' => 'Blog Category Create',
            'slug' => 'app.gallery-categories.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalleryCategory->id,
            'name' => 'Blog Category Edit',
            'slug' => 'app.gallery-categories.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalleryCategory->id,
            'name' => 'Blog Category Delete',
            'slug' => 'app.gallery-categories.delete',
        ]);


        // Gallery
        $moduleAppGallery = Module::updateOrCreate(['name' => 'Gallery']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGallery->id,
            'name' => 'All Gallery',
            'slug' => 'app.gallery.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGallery->id,
            'name' => 'Gallery Create',
            'slug' => 'app.gallery.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGallery->id,
            'name' => 'Gallery Edit',
            'slug' => 'app.gallery.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGallery->id,
            'name' => 'Gallery Delete',
            'slug' => 'app.gallery.delete',
        ]);


        // Subject
        $moduleAppSubject = Module::updateOrCreate(['name' => 'Subject']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSubject->id,
            'name' => 'All Subject',
            'slug' => 'app.subject.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSubject->id,
            'name' => 'Subject Create',
            'slug' => 'app.subject.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSubject->id,
            'name' => 'Subject Edit',
            'slug' => 'app.subject.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSubject->id,
            'name' => 'Subject Delete',
            'slug' => 'app.subject.delete',
        ]);
       
       

        
    }
}
