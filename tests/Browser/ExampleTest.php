<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {


 //1 Login page testing with empty email and password
                $browser->visit('/admin/signin')
                ->type('email', '')
                ->type('password', '')
                ->press('Log In')
                ->assertSee('The email address is required');

 //2 testing with dummy email and empty password
                $browser->visit('admin/signin')
                ->type('email', 'a@a.com')
                ->type('password', '')
                ->press('Log In')
                ->assertSee('Password is required');

 //3 testing with dummy email and dummy password
                $browser->visit('admin/signin')
                ->type('email', 'a@a.com')
                ->type('password', 'aaa')
                ->press('Log In')
                ->assertSee('Email or password is incorrect');

 // 4 testing with registered email id only
                $browser->visit('admin/signin')
                ->type('email', 'admin@admin.com')
                ->type('password', '')
                ->press('Log In')
                ->assertSee('Password is required');

 //5 testing with registered password only
                $browser->visit('admin/signin')
                ->type('email', '')
                ->type('password', 'admin')
                ->press('Log In')
                ->assertSee('The email address is required');


 //6 testing with correct email and password
                $browser->visit('/admin/login')
                ->maximize()
                ->waitFor('#email')
                ->type('email','admin@admin.com')
                ->type('password','admin')
                ->press('Log In')
                ->assertSee('Welcome to Dashboard');
                

 //7 Register page testing all the fields as empty
                $browser->visit('admin/register2')
                ->type('first_name', '')
                ->type('last_name', '')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('First name is required');

 //8 testing firstname with numericals
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('Last name is required');

 //9 testing firstname and last name with numericals
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('The email address is required');

 //10 testing email id with out @
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'fggf')
                ->assertSee('The input is not a valid email address');

 //11 testing email id with special characters(except @,.,_,-)
               $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', '$%!@gmail.com')
                ->assertSee('The input is not a valid email address');

 //12 testing existed email id
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('The confirm email address is required');

 //13 testing existed email id and diferent confirm email
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@ad.com')
                ->type('password', '')
                ->type('password_confirm', '')
                  ->press('Register')
                ->assertSee('Entered email is not matching with your email');

 //14 testing existed email id and same confirm email
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '')
                ->type('password_confirm', '')
                ->assertSee('Password is required');


 //15 testing password field with 2 characters
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('Confirm Password is required');

 //16 testing password field and confirm fields both are different
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '34')
                ->press('Register')
                ->assertSee('Please enter the same value');

 //17 testing password and confirm password with same value
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->press('Register')
                ->assertSee('Please check the checkbox');

 //18 testing checkbox
               $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee('The email has already been taken.');

 //19 testing password and confirm password with 2 characters
                $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin6@admin.com')
                ->type('email_confirm', 'admin6@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee('The password must be between 3 and 32 characters.');

 //  20 testing with first name,last name ,password and confirm password as same inputs
               $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin6@admin.com')
                ->type('email_confirm', 'admin6@admin.com')
                ->type('password', '123')
                ->type('password_confirm', '123')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee('Password should not match first name or last name');


 // 21 testing with firstname,last nameand password as different inputs
                 $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '123')
                ->type('email', 'admin409@admin.com')
                ->type('email_confirm', 'admin409@admin.com')
                ->type('password', '1234')
                ->type('password_confirm', '1234')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertPathIs('/laravel55/public/my-account');

 // 22 Add new group:click on save button with empty field
                    $browser->visit('/admin/groups/create')
                    ->type('name','')
                    ->click('.btn-success')
                    ->waitForText('Error: Please check')
                    ->assertSee('Error: Please check the form below for errors');
                  

 // 23 Add new group:click on cancel button with empty field
                     $browser->visit('/admin/groups/create')
                    ->type('name','')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

 // 24 Add new group:Click on save button with existed group
                    $browser->visit('/admin/groups/create')
                    ->type('name','admin')
                    ->click('.btn-success')
                    ->assertSee('The name has already been taken.');

 // 25 Add new group:Click on cancel button with existed group
                    $browser->visit('/admin/groups/create')
                    ->type('name','admin')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

 // 26 Add new group:click on cancel button with input
                    $browser->visit('/admin/groups/create')
                    ->type('name','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

 //  27 Add new group:click on save button with input data
                    $browser->visit('/admin/groups/create')
                    ->type('name','lorvent')
                    ->click('.btn-success')
                    ->assertSee('Success: Group was successfully created.');
                   

 // 28 Add new group:click on save button followed by cancel button with empty field
                    $browser->visit('/admin/groups/create')
                    ->type('name','')
                    ->click('.btn-success')
                    ->assertSee('Error: Please check the form below for errors')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

 // 29 Group list:Click on delete icon and cancel icon in pop up form
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-62"]')//delete icon id in group list
                    ->click('.modal.in [data-dismiss="modal"]')
                    ->assertSee('Manage Groups');

//  30 Group list:Click on delete icon and cancel button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->waitForText('Delete Group')
                    ->click('.close')
                    ->assertSee('Manage Groups');

//  31 Group list:Click on Delete icon and delete button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->waitForText('Delete Group')
                    ->click('.btn-danger')
                    ->assertSee('Success: Group was successfully deleted.');

//  32 Group list:edit icon:with out edit click on save button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')//edit icon id in group list
                    ->click('.btn-success')
                    ->assertSee('Success: Group was successfully updated.');

// 33 Group list:edit icon:with out edit click on cancel button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitForText('Delete Group')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

// 34 Group list:edit icon: edit group name and click on save button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->type('.form-control','something')
                    ->click('.btn-success')
                    ->assertPathIs('/laravel55/public/admin/groups');

// 35 Group list:edit icon: edit group name (add extra name with existed name)and click on save button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->keys('.form-control','something')
                    ->click('.btn-success')
                    ->assertPathIs('/laravel55/public/admin/groups');

//36 Group list: Edit icon :edit group name and click on cancel button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->type('.form-control','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

// 37 Group list: Edit icon :edit group name (add extra name with existed name) and click on cancel button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->keys('.form-control','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

 //38 Group list:edit icon:Edit the group name as existed name and click on submit button
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->type('.form-control','user')
                    ->click('.btn-success')
                    ->assertSee('Error: Please check the form below for errors');

//39 Group list:edit icon:Edit the group name as existed name and click on cancel button
                     $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-59"]')
                    ->waitFor('#name')
                    ->type('.form-control','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/groups');

//40 Group list:Click on Users exist icon  and then cancel icon
                    $browser->visit('/admin/groups')
                    ->click('[id="canvas-for-livicon-54"]')//user exist icon id in group list
                    ->waitForText('Group contains users')
                    ->click('.modal.in [data-dismiss="modal"]')
                    ->assertpathIs('/laravel55/public/admin/groups');

 // 41 Blog Category:click on save button with empty field
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','')
                    ->click('.btn-success')
                    ->assertSee('The title field is required.');

//42 Blog Category:click on Save and followed by cancel button with out inputs
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','')
                    ->click('.btn-success')
                    ->assertSee('The title field is required.')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

// 43 Blog Category:click on save button with input
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','helloooo')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog category was ')
                    ->assertSee('Success: Blog category was successfully created.');

 //44 Blog Category:click on cancel  button with empty field
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

// 45 Blog Category:click on cancel button with input
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','hai')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

//  46 Blog Category:Click on Save button with existed blog category name
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','hello1234')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog category was ')
                    ->assertSee('Success: Blog category was successfully created.');

// 47 Blog Category:Click on Save button with 2 Characters
                    $browser->visit('/admin/blogcategory/create')
                    ->type('.form-control','he')
                    ->click('.btn-success')
                    ->assertSee('The title must be at least 3 characters.');

// 48 Blog category:Edit icon:with out edit click on save button
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->click('.btn-success')
                      ->waitForText('Success: Blog category was ')
                    ->assertSee('Success: Blog category was successfully updated.');

 //49 Blog category:Edit icon:edit the blog category name and click on submit
                     $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->type('.form-control','hellelllo')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog category')
                    ->assertSee('Success: Blog category was successfully updated.');

// 50 Blog category:Edit icon:edit the blog category name(add extra text to existed name )and click on submit
                     $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->keys('.form-control','hellelllo123')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog category')
                    ->assertSee('Success: Blog category was successfully updated.');

// 51 Blog category:Edit icon:edit the blog caterorty name with existed name ,click on submit
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->type('.form-control','hello')
                    ->click('.btn-success')
                    ->assertSee('The title has already been taken.');

 // 52 Blog category:Blog category exist icon:click on icon and then click on cancel icon
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-56"]')
                    ->click('.close');

//  53 Blog category:Click on delete icon and cancel icon in pop up form
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->click('.close')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

//   54 Blog category:Click on delete icon and cancel button
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->click('.modal.in [data-dismiss="modal"]')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

 // 55 Blog category:click on delete iocn and then delete button
                    $browser->visit('/admin/blogcategory')
                    ->click('[id="canvas-for-livicon-60"]')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blogcategory');

// 56 Blog category:Search filed
                    $browser->visit('/admin/blogcategory')
                    ->type('[id="table_filter"] [type="search"]','hello')
                   ->assertSee("hello");

// 57 Blog category:Show entries drop down
                  $browser->visit('/admin/blogcategory')
                  ->select('.dataTables_length','25')
                  ->driver->executeScript('window.scrollTo(0, 1000);');//window scroll down
                  $browser
                  ->waitForText('Showing 1 to 25 of 28 entries')
                  ->assertSee('Showing 1 to 25 of 28 entries');

 // 58 Blog category:Pagination( to move from first page to second page)
                  $browser->visit('/admin/blogcategory')
                  ->driver->executeScript('window.scrollTo(0, 400);');
                  $browser
                  ->waitForText('Showing 1 to 10 of 28 entries')
                  ->click('[data-dt-idx="2"]')
                  ->assertpathIs('/laravel55/public/admin/blogcategory');

// 59 Add New blog:Click on publish button with empty fields
                    $browser->visit('/admin/blog/create')
                    ->click('.btn-success')
                    ->waitForText('The title field is')
                    ->assertSee('The title field is required.');

// 60 Add new blog:click on save button followed by cancel button with empty field
                    $browser->visit('/admin/blog/create')
                    ->click('.btn-success')
                    ->assertSee('Error: Please check the form below for errors')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

// 61 Add new blog : Click on Discard button with empty fields
                    $browser->visit('/admin/blog/create')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

//62 Add new blog:Click on Publish button with title field only
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->click('.btn-success')
                    ->assertSee('The content field is required.');

// 63  Add new blog : click on Publish button with title and content fields inputs
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->click('.btn-success')
                    ->assertSee('The blog category id field is required.');

//64  Add new blog : Click on Publish with manditory fields inputs
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->select('blog_category_id','4')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog was')
                    ->assertSee('Success: Blog was successfully created.');
                   
 //65  Add new blog :Click on Discard button with Title field
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

 // 66  Add new blog :Click on Discard with Title and Content field
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

// 67  Add new blog :Click on Discard with manditory  fields
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->select('blog_category_id','4')//drop doen of blog category
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

//**68  Add new blog :click on Publish with all fields
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->select('blog_category_id','1')
                    ->type('[placeholder="Tags..."]','409')
                    ->attach('image',__DIR__.'/laravel55/tests/Browser.png')//select file
                    ->waitFor('[class="btn btn-success"]')
                    ->click('.btn-success')
                    ->waitForText('Success: Blog')
                    ->assertPathIs('/laravel55/public/admin/blog')
                    ->assertSee('Success: Blog was successfully created.');

 // 69  Add new blog :click on Discard with all fields
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->type('.note-editable ','lorvent')
                    ->select('blog_category_id','1')
                    ->type('[placeholder="Tags..."]','409')
                     ->attach('image',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog/create');

 //70  Add new blog :content field  menus
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->click('.note-icon-magic')// selecting text style 
                   ->clickLink('Header 1')
                   ->keys('.note-editable ','lorvent')
                   ->click('.note-icon-bold')// selecting bold
                   ->keys('.note-editable ','lorvent')
                   ->click('.note-icon-underline')//selecting underline
                   ->keys('.note-editable ','lorvent')
                   ->click('.note-icon-eraser')//selecting earser icon
                   ->keys('.note-editable ','lorvent')
                   ->click('[data-original-title="Font Family"]')//selecting courier New font family
                   ->clickLink('Courier New')
                   ->keys('.note-editable ','lorvent')
                   ->click('[data-original-title="More Color"]')//selecting font background colour
                   ->click('[data-original-title="#FF0000"]')
                   ->keys('.note-editable ','lorvent')
                   ->click('.note-icon-unorderedlist')// selecting unorderedlist
                   ->keys('.note-editable ','lorvent')
                   ->click('.note-icon-orderedlist')//selecting ordered list
                   ->keys('.note-editable ','lorvent')
                  ;

//71  Add new blog :Paragraph Default alignment( left side alignment)
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')
                    ->click('.note-icon-align-left')
                    ->keys('.note-editable ','lorvent');

//72  Add new blog : Different  alignmnets
                    $browser->visit('/admin/blog/create')
                    ->type('.form-control','hello')  
                    ->click('[data-original-title="Paragraph"]')
                    ->mouseover('.note-align>button:nth-child(3)') //mouse over on center alignment( tooltip name displaying on center alignment)
                    ->click('.note-icon-align-center')//selecting center alignment
                    ->keys('.note-editable ','lorvent')
                    ->click('.note-icon-align-right')//selecting right alignment
                    ->keys('.note-editable ','lorvent')
                    ->click('.note-icon-align-justify')//selecting justify
                    ->keys('.note-editable ','lorvent')
                    ->click('.note-icon-align-outdent')//selecting outdent
                    ->keys('.note-editable ','lorvent')
                    ->click('.note-icon-align-indent')//selecting indent
                    ->keys('.note-editable ','lorvent')
                     ;
// 73  Add new blog :Table(selecting 5 rows and 5 columns)
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-table')
                   ->click('[style="width: 10em; height: 10em;"]');

//*74  Add new blog : Link:Click on insert button with all fields
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello123')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-link')
                   ->type('.note-link-url','http://localhost/laravel55/public/admin/blog/create')
                   ->check('[type="checkbox"]')
                   ->click('.note-link-btn')
                   ->select('blog_category_id','1')
                   ->type('[placeholder="Tags..."]','409')
                   ->attach('image',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                   ->click('.btn-success')
                   ->assertPathIs('/laravel55/public/admin/blog');

// 75  Add new blog : Link:Click on insert button with out check box
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-link')
                   ->type('.note-link-url','http://localhost/laravel55/public/admin/blog/create')
                   ->uncheck('[type="checkbox"]')
                   ->click('.note-link-btn');

 //  76  Add new blog :Link:Click on cancel icon with input
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-link')
                   ->type('.note-link-url','http://localhost/laravel55/public/admin/blog/create')
                   ->check('[type="checkbox"]')
                   ->click('.close');

//   77  Add new blog :Link:Click on Cancel icon with empty fields
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-link')
                   ->click('.close');

//*78  Add new blog :Image:Click on insert button with one field(i.e. Select from files)
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-picture')
                   ->attach('.note-image-input',__DIR__.'/C:\xampp\htdocs\laravel55\tests\Browser.png')
                   ->waitForText('Add New Blog');

// 79  Add new blog : Image:Click on insert button with one field(i.e. Image URL)
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-picture')
                   ->type('.note-image-url','https://www.w3schools.com/css/trolltunga.jpg')
                   ->click('.note-image-btn');

//80  Add new blog : Image:click on insert button with all fields
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hellohello')
                   ->type('.note-editable ','lorvent123')
                   ->click('.note-icon-picture')
                   ->attach('.note-image-input',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                   ->click('.note-icon-picture')
                   ->type('.note-image-url','https://www.w3schools.com/css/trolltunga.jpg')
                   ->click('.note-image-btn')
                   ->select('blog_category_id','1')
                   ->type('[placeholder="Tags..."]','409')
                   ->attach('image',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                   ->click('.btn-success')
                   ->waitForText('Success: Blog was')
                   ->assertSee('Success: Blog was successfully created.');
            

// 81  Add new blog :Image:Click on Cancel icon with empty fields
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-picture') 
                   ->click('.modal.in [data-dismiss="modal"]');

//82  Add new blog :Image:click on Cancel icon with input
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-picture') 
                   ->type('.note-image-url','https://www.w3schools.com/css/trolltunga.jpg')
                   ->click('.modal.in [data-dismiss="modal"]');


//*83  Add new blog :Video:Click on insert with input field(with all fileds in  add new blog)
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-video')
                   ->type('.note-video-url ','https://www.youtube.com/watch?v=9FWIG_c6PfI')
                   ->click('.note-video-btn')
                   ->select('blog_category_id','1')
                   ->type('[placeholder="Tags..."]','409')
                   ->attach('image',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                   ->click('.btn-success')
                   ->assertPathIs('/laravel55/public/admin/blog');

// 84  Add new blog :Video:Click on Cancel icon with empty field in video 
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-video')
                   ->click('.modal.in [data-dismiss="modal"]');

// 85  Add new blog :Video:Click on cancel icon with  input
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-video')
                   ->type('.note-video-url ','https://www.youtube.com/watch?v=9FWIG_c6PfI')
                   ->click('.modal.in [data-dismiss="modal"]');

//86  Add new blog :Full screen
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-arrows-alt')
                   ->click('.note-icon-arrows-alt')
                   ->assertPathIs('/laravel55/public/admin/blog/create');

//87  Add new blog :Code view
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-code')
                   ->click('.note-icon-code')
                   ->assertPathIs('/laravel55/public/admin/blog/create');

//88*  Add new blog :Help
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','hello')
                   ->type('.note-editable ','lorvent')
                   ->click('.note-icon-question')
                   ->waitForText('Summernote 0.8.8 · Project · Issues')
                   ->click('.modal.in [data-dismiss="modal"]')
                   ->select('blog_category_id','1')
                   ->type('[placeholder="Tags..."]','409')
                   ->attach('image',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                   ->click('.btn-success')
                   ->waitForText('Success: Blog was')
                   ->assertSee('Success: Blog was successfully created.');
                 

//90   Add new blog :Full screen then double click on code view and then click on full screen icon
                    $browser->visit('/admin/blog/create')
                    ->click('.note-icon-arrows-alt')
                    ->click('.note-icon-code')
                    ->click('.note-icon-code')
                    ->click('.note-icon-arrows-alt')
                    ->assertPathIs('/laravel55/public/admin/blog');

 //91 Blog List:Create:Click on Publish button with Title field of 2 characters
                   $browser->visit('/admin/blog/create')
                   ->type('.form-control','he')
                   ->type('.note-editable ','lo')
                   ->select('blog_category_id','1')
                   ->click('.btn-success')
                   ->assertSee('The title must be at least 3 characters.');

//92 Blog List:Click on View Blog & comment and then click on send comment button with empty fields
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('[class="btn btn-success btn-md"]')
                     ->assertPathIs('/laravel55/public/admin/blog/3');

//93 Blog List:Click on View Blog & comment and click on send comment button with name field input only
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lr')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('.btn-success')
                     ->assertPathIs('/laravel55/public/admin/blog/3');
// 94 Blog List:Click on View Blog & comment and click on send comment buton with name and email with out @
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lr')
                     ->type('email','hgjhh')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('.btn-success')
                     ->assertpathIs('/laravel55/public/admin/blog/3');

// 95 Blog List:Click on View Blog & comment and click on send comment buton with manditory fields(name field  with 2 characters and email with out @)
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lr')
                     ->type('email','hgjhh')
                     ->type('comment','dfhghdg')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('.btn-success')
                     ->assertSee('The name must be at least 3 characters.')
                     ->assertpathIs('/laravel55/public/admin/blog/3');

// 96 Blog List:Click on View Blog & comment and click on send comment buton with manditory fields(with out @ in email)
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lorvent')
                     ->type('email','hgjhh')
                     ->type('comment','dfhghdg')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('.btn-success')
                     ->assertSee('The email must be a valid email address.');

//  97 Blog List:Click on View Blog & comment and click on send comment buton with manditory fields(comment field with 2 characters)
                      $browser->visit('/admin/blog')
                      ->click('[id="canvas-for-livicon-59"]')
                      ->type('name','ldfdfgf')
                      ->type('email','hgjhh@gmail.com')
                      ->type('comment','df')
                      ->driver->executeScript('window.scrollTo(0, 1500);');
                      $browser
                      ->click('.btn-success')
                      ->assertSee('The comment must be at least 3 characters.')
                      ->assertpathIs('/laravel55/public/admin/blog/3');

//98 Blog List:Click on View Blog & comment and click on send comment button with all valid inputs of manditory fields
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lorvent')
                     ->type('email','hgjhh@gmail.com')
                     ->type('comment','dfhghdg')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                     $browser
                     ->click('.btn-success')
                     ->assertPathIs('/laravel55/public/admin/blog/3');

//99 Blog List:Click on View Blog & comment and click on send comment button with all fields
                     $browser->visit('/admin/blog')
                     ->waitFor('[id="canvas-for-livicon-59"]')
                     ->click('[id="canvas-for-livicon-59"]')
                     ->type('name','lorvent')
                     ->type('email','hgjhh@gmail.com')
                     ->type('website','www.w3schools.com')
                     ->type('comment','dfhghdg')
                     ->driver->executeScript('window.scrollTo(0, 1000);');
                      $browser
                     ->click('.btn-success')
                     ->assertPathIs('/laravel55/public/admin/blog/3');

 //100 Blog list:Click on update blog icon and click on Publish button  with out any changes
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-62"]')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->click('.btn-success')
                    ->assertSee('Success: Blog was successfully updated.')
                    ->assertPathIs('/laravel55/public/admin/blog');

 //101 Blog list:Click on update blog icon and click on Discard button  with out any changes
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-62"]')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog');

// 102 Blog list:Click on update blog icon and click on publish button with title name changed
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-62"]')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->type('[placeholder="Post title here..."]','lorvent')
                    ->click('.btn-success')
                    ->assertSee('Success: Blog was successfully updated.')
                    ->assertPathIs('/laravel55/public/admin/blog');

//103 Blog list:Click on update blog icon and click on dicard button with title name changed
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-62"]')
                    ->click('[id="canvas-for-livicon-62"]')
                    ->type('[placeholder="Post title here..."]','lorvent')
                    ->click('.btn-danger')
                    ->assertPathIs('/laravel55/public/admin/blog');

 //104 Blog List: Click on delete icon and cancel icon on pop up form
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-61"]')
                    ->click('[id="canvas-for-livicon-61"]')
                    ->click('.close')
                    ->assertPathIs('/admin/blog');

// 105 Blog List:Click on delete icon and cancel button
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-63"]')
                    ->click('[id="canvas-for-livicon-63"]')
                    ->click('.modal.in [data-dismiss="modal"]')
                    ->assertPathIs('/laravel55/public/admin/blog');

// 106 Blog List:click on delete icon and then delete button
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="canvas-for-livicon-63"]')
                    ->click('[id="canvas-for-livicon-63"]')
                    ->click('.btn-danger')
                    ->assertSee('Success: Blog was successfully deleted.')
                    ->assertPathIs('/laravel55/public/admin/blog');

// 107 Blog list:Pagination
                  $browser->visit('/admin/blog')
                  ->driver->executeScript('window.scrollTo(0, 1000);');
                   $browser
                  ->waitFor('[data-dt-idx="2"]')
                  ->click('[data-dt-idx="2"]')
                  ->waitForText('Showing 11 to 20 of 28 entries')
                  ->assertpathIs('/laravel55/public/admin/blog');

// 108 Blog list:Search filed with in the table data
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="table_filter"]')
                    ->type('[id="table_filter"] [type="search"]','lorvent')
                    ->waitForText('lorvent')
                    ->assertSee("lorvent");

// 109 Blog list:Search filed out of the table data
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="table_filter"]')
                    ->type('[id="table_filter"] [type="search"]','lorventttttttt')
                    ->waitForText('No matching')
                    ->assertSee('No matching records found');

 // 110 Blog list:Show entries drop down
                    $browser->visit('/admin/blog')
                    ->waitFor('[id="table_length"]')
                    ->select('.dataTables_length','25')
                    ->driver->executeScript('window.scrollTo(0, 2500);');
                     $browser
                    ->waitForText('Showing 1 to 25')
                    ->assertSee('Showing 1 to 25 of 27 entries');

 // 111 Task:Click on Add Task with empty fields(accepting alert)
                     $browser->visit('/admin/tasks')
                     ->click('.add_button')
                     ->driver->switchTo()->alert()->accept();

 // 112 Task:Click on Add task with Task description field only
                     $browser->visit('/admin/tasks')
                      ->waitFor('[id="task_description"]')
                    ->type('task_description','lorvent')
                    ->click('.add_button')
                     ->driver->switchTo()->alert()->accept();

// 113 Task:click on Add task with Deadline field only
                    $browser->visit('/admin/tasks')
                    ->click('#task_deadline')
                    ->click('#task_deadline+.bootstrap-datetimepicker-widget .today')
                    ->click('.add_button')
                    ->driver->switchTo()->alert()->accept();

//114 Task:Click on Add task with two fileds of data (but description is in special characters and then enter alphabets)
                     $browser->visit('/admin/tasks')
                     ->waitFor('[id="task_description"]')
                     ->type('task_description','@#')
                     ->click('#task_deadline')
                     ->click('#task_deadline+.bootstrap-datetimepicker-widget .today')
                     ->click('.add_button')
                     ->driver->switchTo()->alert()->accept();
                      $browser
                     ->waitForText('Tasks')
                     ->type('task_description','lorvent')
                     ->click('.add_button')
                     ->waitForText('Tasks');

 // 115 Task: Click on Add Task with all fields of valid data
                     $browser->visit('/admin/tasks')
                     ->waitFor('[id="task_description"]')
                     ->type('task_description','lorvent')
                     ->click('#task_deadline')
                     ->click('#task_deadline+.bootstrap-datetimepicker-widget .today')
                     ->click('.add_button')
                     ->assertPathIs('laravel55/public/admin/tasks');

// 116 Task:Click on Add task with existed task and same date also
                     $browser->visit('/admin/tasks')
                     ->waitFor('[id="task_description"]')
                     ->type('task_description','lorvent')
                     ->click('#task_deadline')
                     ->click('#task_deadline+.bootstrap-datetimepicker-widget .today')
                     ->click('.add_button')
                     ->assertPathIs('/laravel55/public/admin/tasks');

 //117 Task:Click on Add task with existed task and present   date 
                     $browser->visit('/admin/tasks')
                     ->type('task_description','lorvent')
                     ->click('#task_deadline')
                     ->click('#task_deadline+.bootstrap-datetimepicker-widget .today')
                     ->click('.add_button')
                     ->assertPathIs('/laravel55/public/admin/tasks');

//****118 Task:Click on Add task with existed task and future date 
                    $attribute = $browser->select('#task_deadline','2017/09/29');
                    $browser->visit('/admin/tasks')
                    ->type('task_description','lorvent')
                    ->click($attribute)
                    ->click('.add_button')
                    ->assertPathIs('/laravel55/public/admin/tasks');

 // 119 Task:Active check box
                      $browser->visit('/admin/tasks')
                      ->check('[id="9"] [type="checkbox"]')
                      ->assertPathIs('/laravel55/public/admin/tasks');

//120 Task:Activate check box and delete that task
                      $browser->visit('/admin/tasks')
                      ->check('[id="16"] [type="checkbox"]')
                      ->click('[id="16"] [class="glyphicon glyphicon-trash"]')
                     ->assertPathIs('/laravel55/public/admin/tasks');

//121 Task:Click on delete iocn
                      $browser->visit('/admin/tasks')
                      ->click('[id="22"] [class="glyphicon glyphicon-trash"]')
                      ->assertPathIs('/laravel55/public/admin/tasks');


//122 Task:CLick on edit icon and then delete with out edit the task
                      $browser->visit('/admin/tasks')
                       ->click('[id="23"] [class="glyphicon glyphicon-pencil"]')
                       ->click('[id="23"] [class="glyphicon glyphicon-trash"]')
                       ->assertPathIs('/laravel55/public/admin/tasks');

//  123 Task:Click on edit icon and then save icon with out edit the task
                      $browser->visit('/admin/tasks')
                      ->click('[id="24"] [class="glyphicon glyphicon-pencil"]')
                      ->click('[id="24"] [class="glyphicon glyphicon-saved"]')
                      ->assertPathIs('/laravel55/public/admin/tasks');

 //   124 Task:edit the task and then click on save icon
                    $browser->visit('/admin/tasks')
                    ->click('[id="24"] [class="glyphicon glyphicon-pencil"]')
                    ->type('[id="24"] [name="text"]','lrrr123')
                    ->click('[id="24"] [class="glyphicon glyphicon-saved"]')
                    ->assertPathIs('/laravel55/public/admin/tasks');

// 125 Task:edit the task (add a text to the existed task name)and then click on save icon
                    $browser->visit('/admin/tasks')
                    ->click('[id="24"] [class="glyphicon glyphicon-pencil"]')
                    ->keys('[id="24"] [name="text"]','lrrr123')
                    ->click('[id="24"] [class="glyphicon glyphicon-saved"]')
                    ->assertPathIs('/laravel55/public/admin/tasks');

// 126 Task:edit the task and then click on delete icon( default selecting first task)
                    $browser->visit('/admin/tasks')
                    ->click('[id="24"] [class="glyphicon glyphicon-pencil"]')
                    ->keys('[id="24"] [name="text"]','lrrr123')
                    ->click('[id="24"] [class="glyphicon glyphicon-trash"]')
                    ->assertPathIs('/laravel55/public/admin/tasks');

// 127 Add newuser:Click on Next button with empty fields
                   $browser->visit('/admin/users/create')
                   ->click('ul.pager li.next a')
                   ->assertSee('The first name is require');

 //128 Add new user:Click on next button with first name field input only
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->click('ul.pager li.next a')
                   ->assertSee('The last name is required');

// 129 Add new user:Click on next button with first name and last name fields only
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->click('ul.pager li.next a')
                   ->assertSee('The email address is required');

 // 130 Add new user:Click on next button with invalid email id
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg')
                   ->click('ul.pager li.next a')
                   ->assertSee('The input is not a valid email address');

 // 131 Add new user:Click on Next button with first name ,last name and email fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->click('ul.pager li.next a')
                   ->assertSee('Password is required');

//132 Add new user:Click on Next button with except confirm password field and password same as first name
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','lr')
                   ->click('ul.pager li.next a')
                   ->assertSee('Password should not match first name')
                   ->assertSee('Confirm Password is required');

 //133 Add new user:Click on Next button with except confirm password field
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->click('ul.pager li.next a')
                   ->assertSee('Confirm Password is required');

// 134 Add new user:Click on Next button with different inputs of password and confirm password fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','34')
                   ->click('ul.pager li.next a')
                   ->assertSee('Please enter the same value');

 //135 Add new user:Click on Next button with same inputs of password and confirm password fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                  ->assertPathIs('/laravel55/public/admin/users/create');

// 136 Add new user:Click on next button in Bio tab with empty fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                   $browser
                   ->click('ul.pager li.next a')
                   ->assertSee('Bio is required and cannot be empty');

// 137 Add new user:Click on next button in Bio tab with manditory field only
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                   $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->assertPathIs('/laravel55/public/admin/users/create');

  // 138 Add new user:Click on Next button with manditory field along with date of birth field in Bio tab
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->click('#dob')
                   ->click('#dob+.bootstrap-datetimepicker-widget .today')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->assertPathIs('/laravel55/public/admin/users/create');

//**139 Add new user:Click on Next button with all fields(manditory and optional) in Bio tab
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->click('#dob')
                   ->click('#dob+.bootstrap-datetimepicker-widget .today')
                   ->attach('#pic',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                   $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->assertPathIs('/laravel55/public/admin/users/create');

// 140 Add new user:Click on Next button in Address tab with empty fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->click('ul.pager li.next a')
                   ->assertSee('Please select a gender');

// 141 Add new user:Click on Next button in Address tab with manditory field
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('ul.pager li.next a')
                   ->assertPathIs('/laravel55/public/admin/users/create');

// 142 Add new user:Click on finish button in User Group tab with empty fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('You must select a group');

 //143 Add new user:Click on finish button in User Group tab with Group drop down field only
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','5')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('Please check the checkbox to activate');


// 144 Add new user:Click on finish button in User tab with  all manditory fields fields (first name with 2 characters in user profile tab)
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr')
                   ->type('last_name','lr123')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','1234')
                   ->type('password_confirm','1234')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','1')
                   ->check('[class="iCheck-helper"]')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('The first name must be at least 3 characters.');

 //  145 Add new user:Click on finish button in User tab with  all manditory fields fields (last name with 2 characters in user profile tab)
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr123')
                   ->type('last_name','lr')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','1234')
                   ->type('password_confirm','1234')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','1')
                   ->check('[class="iCheck-helper"]')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('The last name must be at least 3 characters.');

// 146 Add new user:Click on finish button in User tab with  all manditory fields fields (password with 2 characters in user profile tab)
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lr123')
                   ->type('last_name','lr123')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','12')
                   ->type('password_confirm','12')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','1')
                   ->check('[class="iCheck-helper"]')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('The password must be between 3 and 32 characters.')
                   ->assertSee('Confirm Password is required');

//147 Add new user:Click up to finish button with all valid inputs with manditory fields
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lras')
                   ->type('last_name','lras')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','1234')
                   ->type('password_confirm','1234')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 1000);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','1')
                   ->check('[class="iCheck-helper"]')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('Success: User was successfully created.')
                   ->asserPathIs('/laravel55/public/admin/users');

// 148 Add new user:Click on finish button with existed email id
                   $browser->visit('/admin/users/create')
                   ->type('first_name','lras')
                   ->type('last_name','lras')
                   ->type('email','hfghfg@gmail.com')
                   ->type('password','1234')
                   ->type('password_confirm','1234')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[name="group"]','1')
                   ->check('[class="iCheck-helper"]')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('The email has already been taken.');

  // 149 Users:Users list: Click on delete user icon and delete button on pop up form
                      $browser->visit('/admin/users')
                      ->click('[id="canvas-for-livicon-63"]')
                      ->click('.btn-danger')
                      ->assertSee('Success: User was successfully deleted.');

 // 150 Users:Users list: click on delete user icon and then close button
                    $browser->visit('/admin/users')
                    ->click('[id="canvas-for-livicon-63"]')
                    ->click('.modal.in [data-dismiss="modal"]');

 // 151   139 Users:Userslist ,click on delete user icon and then close icon
                   $browser->visit('/admin/users')
                   ->waitForText('Actions')
                   ->click('[id="canvas-for-livicon-61"]')
                   ->waitForText('Delete User')
                   ->click('.close');

 // 152 Users:with out edit any field,update the user
                    $browser->visit('/admin/users/2/edit')
                    ->click('ul.pager li.next a')
                    ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                    ->type('bio','gfhg')
                    ->click('ul.pager li.next a')
                    ->driver->executeScript('window.scrollTo(0, 500);');
                     $browser
                    ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                    ->click('#rootwizard > div > ul > li.next.finish > a')
                    ->assertSee('Success: User was successfully updated.');

 // 153 Users:edit the manditory fields(except password and confirm password fields) in each and every tab and update the user
                   $browser->visit('/admin/users/2/edit')
                   ->type('first_name','dgfhfg')
                   ->type('last_name','gdhgdhfd')
                   ->type('email','hggh@gmail.com')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                   ->type('bio','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[id="groups"]','1')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('Success: User was successfully updated.');

 // 154 Users:edit(add few text to that fields) the manditory fields(except password and confirm password fields) in each and every tab and update the user
                   $browser->visit('/admin/users/2/edit')
                   ->keys('[name="first_name"]','dgfhfg')
                   ->keys('[name="last_name"]','gdhgdhfd')
                   ->keys('[name="email"]','mm')
                   ->click('ul.pager li.next a')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                   ->keys('[name="bio"]','gfhg')
                   ->click('ul.pager li.next a')
                   ->select('[name="gender"]','female')
                   ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                   ->click('#rootwizard > div > ul > li:nth-child(2) > a')
                   ->select('[id="groups"]','1')
                   ->click('#rootwizard > div > ul > li.next.finish > a')
                   ->assertSee('Success: User was successfully updated.');


  //155 View Profile:Click on submit button with empty fields in Change password tab
                    $browser->visit('/admin/users/1')
                    ->click('[href="#tab2"]')
                    ->waitFor('#password')
                    ->click('.btn-primary')
                    ->driver->switchTo()->alert()->accept();

  // 156 View Profile:Click on Reset button with empty fields in change password tab
                    $browser->visit('/admin/users/1')
                    ->click('[href="#tab2"]')
                    ->click('.btn-default');

   // 157 View profile:click on submit button with password field only in change password tab(accepting alert )
                    $browser->visit('/admin/users/1')
                    ->click('[href="#tab2"]')
                    ->click('.btn-primary')
                    ->driver->switchTo()->alert()->accept();
                    $browser
                    ->type('#password','admin')
                    ->click('.btn-primary')
                    ->driver->switchTo()->alert()->accept();


     //158 View profile:Click on Reset button with password field only in change password tab
                    $browser->visit('/admin/users/1')
                    ->click('[href="#tab2"]')
                    ->click('.btn-primary')
                    ->driver->switchTo()->alert()->accept();
                    $browser
                    ->type('password','admin')
                    ->click('.btn-default');

     // 159 view profile:Click on submit button with different inputs of password and confirm password
                     $browser->visit('/admin/users/1')
                     ->click('[href="#tab2"]')
                     ->type('password','admin')
                     ->type('confirm_password','adm')
                     ->click('.btn-primary');

 //  160 view profile:Click on Reset button with different inputs of password and confirm password
                     $browser->visit('/admin/users/1')
                     ->click('[href="#tab2"]')
                     ->type('password','admin')
                     ->type('confirm_password','adm')
                     ->click('.btn-default');

  // 162 View profile:Click on Reset button with same inputs of password and confirm password
                     $browser->visit('/admin/users/1')
                     ->click('[href="#tab2"]')
                     ->type('password','admin')
                     ->type('confirm_password','admin')
                     ->click('.btn-default');

   // 163 View profile:Click on Submit button with same inputs of password and confirm password as 2 characters(accepting alert) and then enter password as "admin"
                     $browser->visit('/admin/users/1')
                     ->click('[href="#tab2"]')
                     ->type('password','12')
                     ->type('confirm_password','12')
                     ->click('.btn-primary')
                     ->driver->switchTo()->alert()->accept();
                      $browser
                     ->type('password','admin');

   //164  View profile:Click on Submit button with same inputs of password and confirm password
                     $browser->visit('/admin/users/1')
                     ->click('[href="#tab2"]')
                     ->type('password','admin')
                     ->type('confirm_password','admin')
                     ->click('.btn-primary')
                     ->driver->switchTo()->alert()->accept();

   // 165 UserProfile:Advanced user Profile:Click on Message tab and then Change passowrd tab and click on reset with password field
                    $browser->visit('/admin/user_profile')
                    ->click('[href="#tab-messages"]')
                    ->click('[href="#tab-change-pwd"]')
                    ->type('password','admin')
                    ->click('.btn-default ');

   // 166 Users:Deleted users
                     $browser->visit('/admin/deleted_users')
                     ->click('[id="canvas-for-livicon-55"]')
                     ->assertSee('Success: User was successfully restored.');

    // 167 Users:Users List,search one user  in users list
                    $browser->visit('/admin/users')
                    ->type('[id="table_filter"] [type="search"]','John')
                    ->assertSee("John");

    // 168 Users:Users list,search one out of userslist
                    $browser->visit('/admin/users')
                    ->waitFor('#table_filter > label > input')
                    ->type('[id="table_filter"] [type="search"]','321')
                    ->waitForText('Showing 0 to 0 of 0 entries (filtered from 14 total entries)')
                    ->assertSee('No matching records found');

    // 169 Users:Show entries drop down in user list
                    $browser->visit('/admin/users')
                    ->select('.dataTables_length','25')
                    ->assertSee('Showing 1 to 3 of 3 entries')
                    ->assertpathIs('/laravel55/public/admin/users');

    // 170 User:Pagination in userlist
                $browser->visit('/admin/users')
                ->driver->executeScript('window.scrollTo(0, 1000);');
                  $browser
                ->click('[data-dt-idx="2"]')
                ->assertSee('Showing 11 to 11 of 11 entries');
            
     // 171 Calendar:Click on create event and then click on cancel icon with empty field
                     $browser->visit('/admin/calendar')
                     ->click('.btn-success')
                     ->click('[class="close reset"]');

     // 172 Calendar:Click on create event and then click on close button with empty field with selected colour
                     $browser->visit('/admin/calendar')
                     ->click('.btn-success')
                     ->click('[id="color-chooser-btn"]')
                     ->click('a.palette-primary')
                     ->click('[class="btn btn-danger pull-right reset"]');

     //  173 Calendar:Click on Create event and then click on Add button with empty field
                     $browser->visit('/admin/calendar')
                     ->click('.btn-success')
                     ->click('[class="btn btn-success pull-left"]');

     //  174 Calendar:Click on create event and then click on cancel icon with input and with out select any colour from drop down and again click on create event button
                     $browser->visit('/admin/calendar')
                     ->click('.btn-success')
                     ->type('[placeholder="Event"]','hjfhjd')
                     ->click('[class="close reset"]')
                     ->click('.btn-success');

     // 175 Calendar:Click on create event and then click on Add button with input with out colour
                       $browser->visit('/admin/calendar')
                       ->click('.btn-success')
                       ->type('[placeholder="Event"]','hjfhjd')
                       ->click('[class="btn btn-success pull-left"]');

      //  176 Claendar:Click on Create event and then click on Add button with colour
                      $browser->visit('/admin/calendar')
                      ->click('.btn-success')
                      ->type('[placeholder="Event"]','hjfhjd')
                      ->click('[id="color-chooser-btn"]')
                      ->click('a.palette-primary')
                      ->click('[class="btn btn-success pull-left"]');

     // 177 Calendar:Activate check box and Drag one event to present  date
                      $browser->visit('/admin/calendar')
                      ->check('[class="iCheck-helper"]')
                      ->drag('[class="external-event palette-warning fc-event ui-draggable ui-draggable-handle"]','[data-date="2017-09-05"]');

//***178 Calendar:Activate check box and Drag one event to present  date
                      $browser->visit('/admin/calendar')
                      ->waitForText('September 2017')
                      ->check('[class="iCheck-helper"]')
                      ->drag('[class="external-event palette-danger fc-event ui-draggable ui-draggable-handle"]','[data-date="2017-09-27"]');

 // 179 Calendar:Click on dragable event (plus ) icon
                     $browser->visit('/admin/calendar')
                     ->click('.fa-plus');

 //  180 Calendar:click on event in calendar
                     $browser->visit('/admin/calendar')
                     ->click('.fc-content');

//***181 calendar:click on event(in particular date in calendar) and then close that form by using cancel icon
                    $attribute = $browser->text('span');
                    $browser->visit('/admin/calendar') 
                    ->click('#calendar span:nth-child(5)')
                    ->pause(3000)
                    ->click('.close');

//***182 calendar:click on event and then close that form by using close button
                    $browser->visit('/admin/calendar')
                    ->click('.fc-content')
                    ->click('.btn-danger');

    //183 calendar:click on left,right arrows and today tab
                  $browser->visit('/admin/calendar')
                  ->click('[class="fc-icon fc-icon-right-single-arrow"]')
                  ->click('[class="fc-icon fc-icon-left-single-arrow"]')
                  ->click('[class="fc-icon fc-icon-left-single-arrow"]')
                  ->click('[class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right"]');

//***184 Calendar:delete the event from event List
                  $browser->visit('/admin/calendar')
                  ->click('[class="fa fa-times event-clear"]','Repeating Event ');

  //185 Laravel Examples:Ajax data tables,Testing search fields with in the table data only
                  $browser->visit('/admin/datatables')
                  ->type('[id="table1_filter"] [type="search"]','jacobs.frances@mann.com')
                  ->assertSee("jacobs.frances@mann.com");

   //186 Laravel Examples:Ajax data tables,Testing search fields out of the data in table
                  $browser->visit('/admin/datatables')
                  ->type('[id="table1_filter"] [type="search"]','123')
                  ->waitForText('Showing 0 to 0 of 0 entries (filtered from 49 total entries)')
                  ->assertSee("No matching records found");

 //187  Laravel Examples:Ajax data tables,Testing show entries drop dowm
                  $browser->visit('/admin/datatables')
                  ->select('.dataTables_length','25')
                  ->driver->executeScript('window.scrollTo(0, 1000);');
                   $browser
                  ->assertSee('Showing 1 to 25 of 50 entries');

 //188 Laravel Examples:Ajax data tables,testing sorting ID column
                $browser->visit('/admin/datatables')
                ->waitForText('ID')
                ->click('#table1 > thead > tr > th.sorting_asc')
                ->waitForText('ID')
                ->click('#table1 > thead > tr > th.sorting_desc')
                ->waitForText('ID');

 //189 Laravel Examples:Ajax data tables,testing sorting First Name column
                $browser->visit('/admin/datatables')
                ->waitForText('ID')
                ->click('#table1 > thead > tr > th:nth-child(2)')
                ->waitForText('ID')
                ->click('#table1 > thead > tr > th:nth-child(2)')
                ->waitForText('ID');

//190 Laravel Examples:Ajax data tables,testing sorting Last Name column
                   $browser->visit('/admin/datatables')
                   ->waitForText('ID')
                   ->click('#table1 > thead > tr > th:nth-child(3)')
                   ->waitForText('ID')
                   ->click('#table1 > thead > tr > th:nth-child(3)')
                   ->waitForText('ID');

//191 Laravel Examples:Ajax data tables,testing sorting the User E-mail column
                    $browser->visit('/admin/datatables')
                    ->waitForText('ID')
                    ->click('#table1 > thead > tr > th:nth-child(4)')
                    ->waitForText('ID')
                    ->click('#table1 > thead > tr > th:nth-child(4)')
                    ->waitForText('ID');

//192 Laravel Examples:Ajax data tables,Testing pagination(move to next page)
                  $browser->visit('/admin/datatables')
                  ->driver->executeScript('window.scrollTo(0, 500);');
                    $browser
                 ->waitForText('Showing 1 to 10 of 49 entries')
                 ->click('[data-dt-idx="2"]')
                 ->waitForText('Showing 11 to 20 of 49 entries')
                 ->assertSee('Showing 11 to 20 of 50 entries');

//193 Laravel Examples:Editable data tables,Testing search field with in the table data only
                  $browser->visit('admin/editable_datatables')
                  ->waitFor('#sample_editable_1_filter > label > input')
                  ->type('[id="sample_editable_1_filter"] [type="search"]','210')
                  ->waitForText('Showing 0 to 0 of 0 entries')
                   ->assertSee('Showing 1 to 1 of 1 entries (filtered from 50 total entries)');

 //194 Laravel Examples:Editable data tables,Testing search field out of the table data
                  $browser->visit('admin/editable_datatables')
                  ->type('[id="sample_editable_1_filter"] [type="search"]','123')
                  ->waitForText('No matching')
                  ->assertSee('No matching records found');

//195 Laravel Examples:Editable data tables,Testing show entries drop dowm
                  $browser->visit('admin/editable_datatables')
                  ->select('.dataTables_length','25')
                  ->waitFor('.dataTables_length')
                  ->driver->executeScript('window.scrollTo(0, 2500);');
                  $browser
                  ->waitForText('Showing 1 to 25 of 49 entries')
                  ->assertSee('Showing 1 to 25 of 49 entries');

//196 Laravel Examples:editable data tables,Testing pagination(move to next page)
                  $browser->visit('admin/editable_datatables')
                  ->driver->executeScript('window.scrollTo(0, 1000);');
                  $browser
                  ->click('[data-dt-idx="2"]')
                  ->waitForText('Showing 11 to 20 of 49 entries')
                  ->assertSee('Showing 11 to 20 of 49 entries');

//197  Laravel Examples:Editable data tables,Testing Edit icon and then save with out edit any field
                  $browser->visit('/admin/editable_datatables')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a');

  // 198 Laravel Examples:Editable data tables,Testing Edit icon and then save with edit the point field
                  $browser->visit('/admin/editable_datatables')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->type('[name="points"]','220')
                  ->waitFor('#points')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a');

// 199 Laravel Examples:Editable data tables,Testing Edit icon and then save with edit the point field as Alphabets(accepting pop up error form)
                   $browser->visit('/admin/editable_datatables')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->type('[name="points"]','255sddf')
                  ->waitFor('#points')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('[class="sa-confirm-button-container"]');

 // 200 Laravel Examples:Editable data tables,Testing Edit icon and then cancel with edit the point field as  special characters(accepting pop up error form)
               $browser->visit('/admin/editable_datatables')
               ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
               ->waitFor('#points')
               ->keys('[name="points"]','#$%')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
               ->click('[class="sa-confirm-button-container"]');

 // 201 Laravel Examples:Editable data tables,Testing Edit icon of one row and then click on another row edit icon
                  $browser->visit('/admin/editable_datatables')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->waitFor('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
                  ->click('#sample_editable_1 > tbody > tr:nth-child(3) > td:nth-child(6) > a')
                  ->click('.modal.in [data-dismiss="modal"]');

 // 202 Laravel Examples:Editable data tables,Click on Edit and then cancel with out edit
               $browser->visit('/admin/editable_datatables')
               ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
               ->waitFor('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(7) > a');

// 203 Laravel Examples:Editable data tables,Click on Edit and then cancel with edited point field
               $browser->visit('/admin/editable_datatables')
               ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(6) > a')
               ->type('points','125')
               ->waitFor('#points')
               ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(7) > a');

 // 204 Laravel Examples:Editable data table,click on delete and then close icon on popup form
              $browser->visit('/admin/editable_datatables')
               ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
              ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(7) > a')
              ->waitForText('Are you sure to delete?')
              ->click('.close');

 // 205   Laravel Examples:Editable data table,click on delete and then close button on popup form
              $browser->visit('/admin/editable_datatables')
              ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
              ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(7) > a')
              ->waitForText('Are you sure to delete?')
              ->click('.btn-default');

// 206   Laravel Examples:Editable data table,click on delete and then Delete button on popup form
              $browser->visit('/admin/editable_datatables')
              ->waitFor('#sample_editable_1 > tbody > tr:nth-child(1) > td:nth-child(6) > a')
              ->click('#sample_editable_1 > tbody > tr:nth-child(2) > td:nth-child(7) > a')
              ->waitForText('Are you sure to delete?')
              ->click('.btn-danger');

// 207 Laravel Examples:Editable data table,testing sorting ID column
              $browser->visit('/admin/editable_datatables')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(1)')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(1)')
               ->waitForText('ID');

// 208 Laravel Examples:Editable data table,testing sorting First Name column
              $browser->visit('/admin/editable_datatables')
             ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(2)')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(2)')
              ->waitForText('ID');

// 209 Laravel Examples:Editable data table,testing sorting Last Name column
              $browser->visit('/admin/editable_datatables')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(3)')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(3)')
              ->waitForText('ID');

// 210 Laravel Examples:Editable data table,testing sorting Points column
              $browser->visit('/admin/editable_datatables')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(4)')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(4)')
              ->waitForText('ID');

// 211 Laravel Examples:Editable data table,testing sorting Notes column
              $browser->visit('/admin/editable_datatables')
             ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(5)')
              ->waitForText('ID')
              ->click('#sample_editable_1 > thead > tr > th:nth-child(5)')
              ->waitForText('ID');

// 212 Laravel Examples:Custom Data Tables:Data range form,Search field testing with in the table data only
              $browser->visit('/admin/custom_datatables')
              ->waitFor('#table1_filter > label > input')
              ->type('[id="table1_filter"] [type="search"]','Bauch')
              ->waitForText('Showing 1 to 1 of 1 entries ')
              ->assertSee("Bauch");

// 213 Laravel Examples:Custom Data Tables:Data range form,Search field testing except table data only
              $browser->visit('/admin/custom_datatables')
              ->waitFor('#table1_filter > label > input')
              ->type('[id="table1_filter"] [type="search"]','lorvent123')
              ->waitForText('No matching')
              ->assertSee('No matching records found');

// 214 Laravel Examples:Custom Data Tables:Data range form,testing show intries drop down
            $browser->visit('/admin/custom_datatables')
            ->waitFor('#table1_length > label > select')
            ->select('[id="table1_length"]','25')
            ->driver->executeScript('window.scrollTo(0, 1000);');
             $browser
            ->waitForText('Showing 1 to 25 of 47 entries')
            ->assertSee('Showing 1 to 25 of 47 entries');

 // 215 Laravel Examples:Custom Data Tables:Data range form,testing Id range slider(draging right side)
            $browser->visit('/admin/custom_datatables')
            ->waitFor('[id="id_range"]')
            ->dragRight('div.slider.slider-horizontal div.slider-handle.min-slider-handle',50)
            ->waitFor('[id="id_range"]')
            ->driver->executeScript('window.scrollTo(0, 1000);');
            $browser
            ->waitForText('Showing 1 to 10 of 47 entries')
            ->assertSee('Showing 1 to 10 of 47 entries');

// 216 Laravel Examples:Custom Data Tables:Data range form,testing Id range slider(draging left side)
           $browser->visit('/admin/custom_datatables')
          ->waitFor('[id="id_range"]')
          ->dragLeft('div.slider.slider-horizontal div.slider-handle.max-slider-handle',50)
          ->waitFor('[id="id_range"]')
          ->driver->executeScript('window.scrollTo(0, 1000);');
          $browser
          ->waitForText('Showing 1 to 10 of 47 entries')
          ->assertSee('Showing 1 to 10 of 47 entries');

 // 217 Laravel Examples:custom Data Tables:Data Range form,testing next buttons(pagibnation)
         $browser->visit('/admin/custom_datatables')
         ->waitFor('[id="id_range"]')
         ->driver->executeScript('window.scrollTo(0, 400);');
         $browser
         ->click('#table1_paginate > ul > li:nth-child(4) > a')
         ->waitForText('Showing 21 to 30 of 47 entries')
         ->assertSee('Showing 21 to 30 of 47 entries');

 // 218 Laravel Examples:Custom Data tables:Data Range form,Testing sorting ID column
          $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th.sorting_asc')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th.sorting_desc')
         ->waitForText('ID');

 // 219 Laravel Examples:Custom Data tables:Data Range form,Testing sorting First Name column column
          $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(2)')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(2)')
         ->waitForText('ID');

// 220 Laravel Examples:Custom Data tables:Data Range form,Testing sorting Last Name column
         $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(3)')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(3)')
         ->waitForText('ID');

// 221 Laravel Examples:Custom Data tables:Data Range form,Testing sorting User Email  column
         $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(4)')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(4)')
         ->waitForText('ID');

//222 Laravel Examples:Custom Data tables:Data Range form,Testing sorting Job column
         $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(5)')
        ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(5)')
         ->waitForText('ID');

//223 Laravel Examples:Custom Data tables:Data Range form,Testing sorting Age column
         $browser->visit('/admin/custom_datatables')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(6)')
         ->waitForText('ID')
         ->click('#table1 > thead > tr > th:nth-child(6)')
         ->waitForText('ID');

//224 Laravel Examples:Custom Data Tables: Radio Selection Filter Table,testing search field with in the table data
         $browser->visit('/admin/custom_datatables')
         ->driver->executeScript('window.scrollTo(0, 700);');
         $browser
         ->waitFor('#table2_filter > label > input')
         ->type('[id="table2_filter"] [type="search"]','Bauch')
         ->waitForText('Showing 1 to 1 of 1 entries (filtered from 47 total entries)')
         ->assertSee("Bauch");

// 225 Laravel Examples:Custom Data Tables: Radio Selection Filter Table,testing search field out of the table data
         $browser->visit('/admin/custom_datatables')
         ->driver->executeScript('window.scrollTo(0, 700);');
         $browser
         ->waitFor('#table2_filter > label > input')
         ->type('[id="table2_filter"] [type="search"]','Easter123')
         ->waitForText('No matching records found')
         ->assertSee('No matching records found');

//226 Laravel Examples:Custom Data Tables:Radio Selection Filter Table,testing show intries drop down
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 700);');
             $browser
             ->waitFor('#table2_filter > label > input')
             ->select('[id="table2_length"]','25')
             ->waitFor('[id="table2_length"]')
             ->driver->executeScript('window.scrollTo(700, 2000);');
             $browser
             ->waitForText('Showing 1 to 25 of 47 entries')
             ->assertSee('Showing 1 to 25 of 47 entries');
     

  //227 Laravel Examples:Custom Data Tables:Radio Selection Filter Table,testing Radio buttons(Below 35 Age)
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 700);');
             $browser
             ->radio('[class="iCheck-helper"]','Below 35')
             ->driver->executeScript('window.scrollTo(700, 1200);');
             $browser
             ->waitForText('Showing 1 to 10 of 12 entries')
             ->assertSee('Showing 1 to 10 of 12 entries');

//**228 Laravel Examples:Custom Data Tables:Radio Selection Filter Table,Testing Radio button(below 50 age)
              $browser->visit('/admin/custom_datatables')
              ->driver->executeScript('window.scrollTo(0, 700);');
              $browser
              ->radio('[class="iCheck-helper"]',' Below 50')
              ->driver->executeScript('window.scrollTo(700, 1200);');
               $browser
              ->waitForText('Showing 1 to 10 of 26 entries')
              ->assertsee('Showing 1 to 10 of 26 entries');


 //**229 Laravel Examples:Custom Data Tables:Radio Selection Filter Table,Testing Radio button(above 50 age)
            $browser->visit('/admin/custom_datatables')
            ->pause(3000)
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->radio('[class="iCheck-helper"]','Above 50')
            ->pause(3000);
 //**230 Laravel Examples:Custom Data Tables:Radio Selection Filter Table,Testing Radio button(All)
            $browser->visit('/admin/custom_datatables')
            ->pause(3000)
            ->driver->executeScript('window.scrollTo(0, 700);');
             $browser
            ->radio('[class="iCheck-helper"]','All')
            ->pause(3000);

 // 231 Laravel Examples:Custom Data Tables:Radio Selection filter Table,testing pagination
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1100);');
            $browser
            ->waitFor('#table2_paginate > ul > li.paginate_button.active > a')
            ->click('#table2_paginate > ul > li:nth-child(3) > a')
            ->waitForText('Showing 11 to 20 of 47 entries')
            ->assertSee('Showing 11 to 20 of 47 entries');

// 232 Laravel Examples:Custom data tables:Radio Selection filter Table,testing ID column sorting
              $browser->visit('/admin/custom_datatables')
              ->driver->executeScript('window.scrollTo(0, 700);');
              $browser
              ->waitForText('ID')
              ->click('#table2 > thead > tr > th:nth-child(1)')
              ->waitForText('ID')
              ->click('#table2 > thead > tr > th:nth-child(1)')
              ->waitForText('ID');

//233 Laravel Examples:Custom data tables:Radio Selection filter Table,testing Fisrt Name column sorting
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->waitForText('ID')
            ->click('#table2 > thead > tr > th:nth-child(2)')
            ->waitForText('ID')
            ->click('#table2 > thead > tr > th:nth-child(2)')
            ->waitForText('ID');

//234 Laravel Examples:Custom data tables:Radio Selection filter Table,testing Last Name column sorting
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->waitForText('ID')
            ->click('#table2 > thead > tr > th:nth-child(3)')
            ->waitForText('ID')
            ->click('#table2 > thead > tr > th:nth-child(3)')
            ->waitForText('ID');

//235 Laravel Examples:Custom data tables:Radio Selection filter Table,testing User Email column sorting
            $browser->visit('/admin/custom_datatables')
            ->pause(3000)
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->click('#table2 > thead > tr > th:nth-child(4)')
            ->pause(3000)
            ->click('#table2 > thead > tr > th:nth-child(4)');

 //236 Laravel Examples:Custom data tables:Radio Selection filter Table,testing Job column sorting
            $browser->visit('/admin/custom_datatables')
            ->pause(3000)
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->click('#table2 > thead > tr > th:nth-child(5)')
            ->pause(3000)
            ->click('#table2 > thead > tr > th:nth-child(5)');

 //237 Laravel Examples:Custom data tables:Radio Selection filter Table,testing Age column sorting
            $browser->visit('/admin/custom_datatables')
            ->pause(3000)
            ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
            ->click('#table2 > thead > tr > th:nth-child(6)')
            ->pause(3000)
            ->click('#table2 > thead > tr > th:nth-child(6)');


 //238 Laravel Examples: Custom Data Tables:Selection Filter Table,Testing Profession Drop down
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitFor('#professions')
            ->select('[id="professions"]','5')
            ->waitForText('Showing 1 to 1 of 1 entries')
            ->assertsee('Showing 1 to 1 of 1 entries');

 //239 Laravel Examples:Custom Data Tables:Selection Filter Table,Testing Search field with in the table data
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitFor('#table3_filter > label > input')
            ->type('[id="table3_filter"] [type="search"]','Millwright')
            ->waitForText('Showing 1 to 1 of 1 entries (filtered from 47 total entries)')
            ->assertSee("Millwright");

 //240 Laravel Examples:Custom Data Tables:Selection Filter Table,Testing Search field with out of the data in the data table
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitFor('#table3_filter > label > input')
            ->type('[id="table3_filter"] [type="search"]','Marketing Manager123')
            ->waitForText('No matching records found')
            ->assertSee('No matching records found');

 //241 Laravel Examples:Custom Data Tables:Selection Filter Table,Testing show entries drop down
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 1500);');
             $browser
             ->waitFor('#table3_length > label > select')
             ->select('[id="table3_length"]','25')
             ->driver->executeScript('window.scrollTo(1500, 2300);');
             $browser
             ->waitForText('Showing 1 to 25 of 47 entries')
             ->assertsee('Showing 1 to 25 of 47 entries');

 //242 Laravel Examples:Custom Data Tables:Selection Filter Table,testing pagination
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2100);');
            $browser
            ->waitFor('#table3_previous > a')
            ->click('#table3_paginate > ul > li:nth-child(4) > a')
            ->waitForText('Showing 21 to 30 of 47 entries')
            ->assertSee('Showing 21 to 30 of 47 entries');

//243  Laravel Examples:Custom data tables:Selection Filter Table,testing ID column sorting
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 1500);');
              $browser
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th.sorting_asc')
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th.sorting_desc')
             ->waitForText('ID');

 //244  Laravel Examples:Custom data tables:Selection Filter Table,testing First Name column sorting
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 1500);');
             $browser
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th:nth-child(2)')
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th:nth-child(2)')
             ->waitForText('ID');

 // 245 Laravel Examples:Custom data tables:Selection Filter Table,testing Last Name column sorting
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(3)')
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(3)')
            ->waitForText('ID');

//246 Laravel Examples:Custom data tables:Selection Filter Table,testing User Email column sorting
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(4)')
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(4)')
            ->waitForText('ID');

 //247 Laravel Examples:Custom data tables:Selection Filter Table,testing job column sorting
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 1500);');
             $browser
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th:nth-child(5)')
             ->waitForText('ID')
             ->click('#table3 > thead > tr > th:nth-child(5)')
             ->waitForText('ID');

//248  Laravel Examples:Custom data tables:Selection Filter Table,testing age column sorting
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 1500);');
            $browser
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(6)')
            ->waitForText('ID')
            ->click('#table3 > thead > tr > th:nth-child(6)')
            ->waitForText('ID');

//249 Laravel Examples:Custom Data Tables: Button Filter Table,testing button(Male)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2200);');
            $browser
            ->waitForText('Button Filter Table')
            ->click('#buttonMale')
            ->driver->executeScript('window.scrollTo(2200, 2500);');
            $browser
            ->waitForText('Showing 1 to 10 of 23 entries')
            ->assertSee('Showing 1 to 10 of 23 entries');

 //250 Laravel Examples:Custom Data Tables: Button Filter Table,testing button(Female)
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 2200);');
             $browser
             ->waitForText('Button Filter Table')
             ->click('#buttonFemale')
             ->driver->executeScript('window.scrollTo(2200, 2500);');
             $browser
             ->waitForText('Showing 1 to 10 of 24 entries')
             ->assertSee('Showing 1 to 10 of 24 entries');

 //251 Laravel Examples:Custom Data Tables: Button Filter Table,testing button(All)
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 2200);');
             $browser
             ->waitForText('Button Filter Table')
             ->click('#buttonAll')
             ->driver->executeScript('window.scrollTo(2200, 2500);');
             $browser
             ->waitForText('Showing 1 to 10 of 47 entries')
             ->assertSee('Showing 1 to 10 of 47 entries');

//252 Laravel Examples:Cutom Data Tables:Button Filter Table,testing search field with in the table data
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2200);');
            $browser
            ->waitFor('#table4_filter > label > input')
            ->type('[id="table4_filter"] [type="search"]','51')
            ->waitForText('Showing 1 to 3 of 3 entries (filtered from 47 total entries)')
            ->assertSee("51");

//253 Laravel Examples:Cutom Data Tables:Button Filter Table,testing search field with out of the table data
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2200);');
            $browser
            ->waitFor('#table4_filter > label > input')
           ->type('[id="table4_filter"] [type="search"]','511')
            ->waitForText('No matching records found')
            ->assertSee('No matching records found');

// 254 Laravel Examples:Cutom Data Tables:Button Filter Table,testing show entries drop down field
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
            $browser
            ->waitFor('#table4_length > label > select')
            ->select('[id="table4_length"]','25')
            ->driver->executeScript('window.scrollTo(2300, 3200);');
            $browser
            ->waitForText('Showing 1 to 25 of 47 entries')
            ->assertSee('Showing 1 to 25 of 47 entries');
            

 // 255 Laravel Examples:Custom Data Tables:Button Filter Table,testing pagination
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2600);');
            $browser
            ->waitFor('#table4_previous > a')
            ->click('#table4_paginate > ul > li:nth-child(3) > a')
            ->waitForText('Showing 11 to 20 of 47 entries')
            ->assertsee('Showing 11 to 20 of 47 entries');
           
 //256 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
             $browser
             ->waitForText('ID')
            ->click('#table4 > thead > tr > th.sorting_asc')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th.sorting_desc')
            ->waitForText('ID');

// 257 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
           ->driver->executeScript('window.scrollTo(0, 2300);');
            $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(2)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(2)')
            ->waitForText('ID');

 //258 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
             $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(3)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(3)')
            ->waitForText('ID');

 // 259 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
              $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(4)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(4)')
            ->waitForText('ID');

 //260 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
              $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(5)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(5)')
            ->waitForText('ID');

 //261 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
              $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(6)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(6)')
            ->waitForText('ID');

 //262 Laravel Examples:Custom Data Tables:Button Filter Table,testing Sorting ID column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 2300);');
              $browser
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(7)')
            ->waitForText('ID')
            ->click('#table4 > thead > tr > th:nth-child(7)')
            ->waitForText('ID');

 //263 Laravel Examples:Custom Data Tables: All Custom Filters Table,testing button(Male)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitForText(' All Custom Filters Table')
            ->click('#buttonMale2')
            ->driver->executeScript('window.scrollTo(3000, 3500);');
            $browser
            ->waitForText('Showing 1 to 10 of 23 entries')
            ->assertSee('Showing 1 to 10 of 23 entries');

 //264 Laravel Examples:Custom Data Tables: All Custom Filters Table,testing button(Female)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
            ->waitForText(' All Custom Filters Table')
            ->click('#buttonFemale2')
            ->driver->executeScript('window.scrollTo(3000, 3500);');
             $browser
            ->waitForText('Showing 1 to 10 of 24 entries')
            ->assertsee('Showing 1 to 10 of 24 entries');

//265 Laravel Examples:Custom Data Tables: All Custom Filters Table,testing button(All)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitForText(' All Custom Filters Table')
            ->click('#buttonAll2')
            ->driver->executeScript('window.scrollTo(3000, 3500);');
            $browser
            ->waitForText('Showing 1 to 10 of 47 entries')
            ->assertSee('Showing 1 to 10 of 47 entries');

// **266 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing ID Range slide bar
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->dragRight('div.slider.slider-horizontal div.slider-handle.min-slider-handle',50)
            ->assertSee('Showing 1 to 10 of 38 entries');

//267 Laravel Examples: Custom Data Tables:All Custom Filters Table,Testing Profession Drop down
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitFor('#professions2')
            ->select('[id="professions2"]','5')
            ->assertsee('Showing 1 to 1 of 1 entries');

 //268 Laravel Examples:Cutom Data Tables:All Custom Filters Table,testing search field with in the table data
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitFor('#table5_filter > label > input')
            ->type('[id="table5_filter"] [type="search"]','51')
            ->waitForText('Showing 1 to 3 of 3 entries (filtered from 47 total entries)')
            ->assertSee('Showing 1 to 3 of 3 entries (filtered from 47 total entries)');

 //269 Laravel Examples:Cutom Data Tables:All Custom Filters Table,testing search field with out of the table data
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitFor('#table5_filter > label > input')
            ->type('[id="table5_filter"] [type="search"]','511')
            ->waitForText('Showing 0 to 0 of 0 entries (filtered from 47 total entries)')
            ->assertSee('No matching records found');

 //270 Laravel Examples:Cutom Data Tables:All Custom Filters Table,testing show entries drop down field
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3500);');
            $browser
            ->waitFor('#table5_length > label > select')
            ->select('[id="table5_length"]','25')
            ->driver->executeScript('window.scrollTo(3500, 5500);');
            $browser
            ->waitForText('Showing 1 to 25 of 47 entries')
            ->assertsee('Showing 1 to 25 of 47 entries');

 // **271 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing Radio buttons(Below 35 Age)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->radio('[class="custom-radio2"] [id="radio_one"]','35');


//**272 Laravel Examples:Custom Data Tables:All Custom Filters Table,Testing Radio button(below 50 age)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser 
            ->radio('[class="iCheck-helper"]',' Below 50');

//**273 Laravel Examples:Custom Data Tables:All Custom Filters Table,Testing Radio button(above 50 age)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
             ->radio('[class="iCheck-helper"]',' Above 50');

//**274 Laravel Examples:Custom Data Tables:All Custom Filters Table,Testing Radio button(All)
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->radio('[class="iCheck-helper"]',' All');

//274 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting ID column
             $browser->visit('/admin/custom_datatables')   
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th.sorting_asc')
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th.sorting_desc')
             ->waitForText('ID');

 //275 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting firstname column
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(2)')
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(2)')
             ->waitForText('ID');

 //276 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting lastname column
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
            ->click('#table5 > thead > tr > th:nth-child(3)')
            ->waitForText('ID')
            ->click('#table5 > thead > tr > th:nth-child(3)')
            ->waitForText('ID');

 //277 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting User email column
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
            ->waitForText('ID')
            ->click('#table5 > thead > tr > th:nth-child(4)')
            ->waitForText('ID')
            ->click('#table5 > thead > tr > th:nth-child(4)')
            ->waitForText('ID');

 //278 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting Job column
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(5)')
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(5)')
             ->waitForText('ID');

 //278 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting Age column
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(6)')
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(6)')
             ->waitForText('ID');

 //279 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing sorting Gender column
             $browser->visit('/admin/custom_datatables')
             ->driver->executeScript('window.scrollTo(0, 3000);');
             $browser
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(7)')
             ->waitForText('ID')
             ->click('#table5 > thead > tr > th:nth-child(7)')
             ->waitForText('ID');

  //280 Laravel Examples:Custom Data Tables:All Custom Filters Table,testing pagination
            $browser->visit('/admin/custom_datatables')
            ->driver->executeScript('window.scrollTo(0, 4500);');
            $browser
            ->click('#table5_paginate > ul > li:nth-child(3) > a')
            ->assertsee('Showing 11 to 20 of 49 entries');

//**281 Laravel Examples:Multiple file uploads:add file
            $browser->visit('/admin/multiple_upload')
            ->attach('file',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png')
            ->click('.btn-primary');

//**282 Laravel Examples:Multiple file uploads:after upload a file delete that file with out check box activation(single file)
                $browser->visit('/admin/multiple_upload')
                ->attach('file',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png')
                ->click('.btn-primary')
                ->click('.btn-danger');

//**283 Laravel Examples:Multiple file uploads:after upload the files delete that files by using check boxs(more than one file at a time)
                  $browser->visit('/admin/multiple_upload')                  
                  ->attach('file',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png')
                  ->attach('file',__DIR__.'/Screenshot from 2016-07-25 18:20:09.png')
                  ->click('.btn-primary')
                  ->click('[type="checkbox"]')
                  ->click('.btn-danger');

 //**284 laravel Example:Multiple file uploads:attach the files and then click on cancel upload button
                  $browser->visit('/admin/multiple_upload')
                  ->attach('file',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png')
                  ->click('.btn-warning');

 //**285 Laravel Example:Drop Zone:upload a file
                  $browser->visit('/admin/dropzone')
                  ->attach('[method="POST"]',__DIR__.'/Screenshot from 2016-07-11 11:46:44.png');


// 286 Data Tables:Advanced Data tables:TableTools,Testing search field with in the table data
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_filter > label > input')
           ->type('[id="table1_filter"] [type="search"]','Larry')
           ->driver->executeScript('window.scrollTo(0, 400);'); 
            $browser
           ->assertSee('Showing 1 to 10 of 18 entries (filtered from 36 total entries)');

 // 287 Data Tables:Advanced Data tables:TableTools,Testing search field with out of the table data
           $browser->visit('/admin/advanced_tables')
          ->waitFor('#table1_filter > label > input')
          ->type('[id="table1_filter"] [type="search"]','lorvent')
          ->waitForText('Showing 0 to 0 of 0 entries (filtered from 36 total entries)')
           ->assertSee('No matching records found');

 //288  Data Tables:Advanced Data tables:TableTools,Testing Show entries drop down
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_length > label > select')
           ->select('[id="table1_length"]','25')
           ->driver->executeScript('window.scrollTo(0, 1000);'); 
           $browser
           ->assertsee('Showing 1 to 25 of 36 entries');

 // 289 Data Tables:Advanced Data tables:TableTools,Testing Pagination
            $browser->visit('/admin/advanced_tables')
            ->waitFor('#table1_length > label > select')
            ->driver->executeScript('window.scrollTo(0, 400);');
            $browser
            ->click('#table1_paginate > ul > li:nth-child(4) > a')
            ->assertsee('Showing 21 to 30 of 36 entries');

 // 290 Data Tables:Advanced Data tables:TableTools,Testing copy button in group button
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_filter > label > input')
           ->click('[class="btn btn-default buttons-copy buttons-html5"]')
           ->waitForText('Copied 36 rows to clipboard');

 // 291 Data Tables:Advanced Data tables:TableTools,Testing CSV button in group button
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_filter > label > input')
           ->click('[class="btn btn-default buttons-csv buttons-html5"]');

// 292 Data Tables:Advanced Data tables:TableTools,Testing PDF button in group button
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_filter > label > input')
           ->click('[class="btn btn-default buttons-pdf buttons-html5"]');

 //293  Data Tables:Advanced Data tables:TableTools,Testing Print button in group button
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1_filter > label > input')
           ->click('[class="btn btn-default buttons-print"]');

 //294  Data Tables:Advanced Data Tables:TableTools,Testing First Name column sorting
            $browser->visit('/admin/advanced_tables')
            ->waitFor('#table1 > thead > tr > th.sorting_asc')
            ->click('#table1 > thead > tr > th.sorting_asc')
            ->waitFor('#table1 > thead > tr > th.sorting_desc')
            ->click('#table1 > thead > tr > th.sorting_desc');

 // 295 Data Tables:Advanced Data Tables:TableTools,Testing Last Name column sorting
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1 > thead > tr > th:nth-child(2)')
          ->click('#table1 > thead > tr > th:nth-child(2)')
          ->waitFor('#table1 > thead > tr > th:nth-child(2)')
          ->click('#table1 > thead > tr > th:nth-child(2)');

 // 296 Data Tables:Advanced Data Tables:TableTools,Testing User Name column sorting
           $browser->visit('/admin/advanced_tables')
           ->waitFor('#table1 > thead > tr > th:nth-child(3)')
          ->click('#table1 > thead > tr > th:nth-child(3)')
          ->waitFor('#table1 > thead > tr > th:nth-child(3)')
          ->click('#table1 > thead > tr > th:nth-child(3)');

 // 297 Data Tables:Advanced Data Tables:TableTools,Testing User Email column sorting
           $browser->visit('/admin/advanced_tables')
          ->waitFor('#table1 > thead > tr > th:nth-child(4)')
          ->click('#table1 > thead > tr > th:nth-child(4)')
          ->waitFor('#table1 > thead > tr > th:nth-child(4)')
          ->click('#table1 > thead > tr > th:nth-child(4)');

 // 298 Data Tables:Advanced Data tables: Re-order Columns,Testing search field with in the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2_filter > label > input')
           ->type('[id="table2_filter"] [type="search"]','Jacob')
           ->waitForText('Showing 1 to 1 of 1')
           ->assertSee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

 // 299 Data Tables:Advanced Data tables: Re-order Columns,Testing search field with out of the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2_filter > label > input')
            ->type('[id="table2_filter"] [type="search"]','lorvent')
            ->waitForText('No matching')
           ->assertSee('No matching records found');

 //300 Data Tables:Advanced Data tables:Re-order Columns,Testing Show entries drop down
           $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2_length > label > select')
            ->select('[id="table2_length"]','25')
             ->driver->executeScript('window.scrollTo(800, 1200);');
            $browser
            ->waitForText('Showing 1 to 17')
            ->assertsee('Showing 1 to 17 of 17 entries');

 // 301 Data Tables:Advanced Data tables: Re-order Columns,Testing Pagination
           $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 1300);');
            $browser
           ->waitFor('#table2_filter > label > input')
           ->click('#table2_paginate > ul > li:nth-child(3) > a')
           ->waitForText('Showing 11 to 17')
           ->assertsee('Showing 11 to 17 of 17 entries');

// 302 Data Tables:Advanced Data tables: Re-order Columns,Testing Drag the columns
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
             ->dragLeft('#table2 > thead > tr > th:nth-child(5)',500)//By using grag left
            // ->drag('#table2 > thead > tr > th:nth-child(5)','#table2 > thead > tr > th:nth-child(3)')// by using Drag and drop 
            ->waitFor('#table2 > thead > tr > th.sorting_asc');

 //303 Data Tables:Advanced Data Tables:Re-order Columns,Testing '#'' column sorting
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2 > thead > tr > th.sorting_asc')//selector of # column
            ->click('#table2 > thead > tr > th.sorting_asc')
            ->waitFor('#table2 > thead > tr > th.sorting_desc')
            ->click('#table2 > thead > tr > th.sorting_desc');

// 304 Data Tables:Advanced Data Tables:Re-order Columns,Testing First Name column sorting
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2 > thead > tr > th:nth-child(2)')//selector of first name
           ->click('#table2 > thead > tr > th:nth-child(2)')
           ->waitFor('#table2 > thead > tr > th:nth-child(2)')
            ->click('#table2 > thead > tr > th:nth-child(2)');

 // 305 Data Tables:Advanced Data Tables:Re-order Columns,Testing Last Name column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 800);');
            $browser
            ->waitFor('#table2 > thead > tr > th:nth-child(3)')//selector of last name
          ->click('#table2 > thead > tr > th:nth-child(3)')
          ->waitFor('#table2 > thead > tr > th:nth-child(3)')
          ->click('#table2 > thead > tr > th:nth-child(3)');

 //306  Data Tables:Advanced Data Tables:Re-order Columns,Testing User Name column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 800);');
           $browser
           ->waitFor('#table2 > thead > tr > th:nth-child(4)')//selector of user name
          ->click('#table2 > thead > tr > th:nth-child(4)')
           ->waitFor('#table2 > thead > tr > th:nth-child(4)')
          ->click('#table2 > thead > tr > th:nth-child(4)');

// 307 Data Tables:Advanced Data Tables:Re-order Columns,Testing User Email column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 800);');
           $browser
           ->waitFor('#table2 > thead > tr > th:nth-child(5)')//selector of User Email
          ->click('#table2 > thead > tr > th:nth-child(5)')
           ->waitFor('#table2 > thead > tr > th:nth-child(5)')
          ->click('#table2 > thead > tr > th:nth-child(5)');

 //308 Data Tables:Advanced Data Tables: Add/Remove rows Table,testing Delete Row button
          $browser->visit('/admin/advanced_tables')
          ->driver->executeScript('window.scrollTo(0, 1400);');
          $browser
          ->click('.btn-primary');

 //309 Data Tables:Advanced Data Tables: Add/Remove rows Table,testing Delete Row button with out select any Row
          $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
           $browser
          ->click('.btn-danger')
          ->driver->switchTo()->alert()->accept();//accepting alert(click on ok button)

 //310 Data Tables:Advanced Data Tables: Add/Remove rows Table,testing Delete Row button with selected one Row
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
           $browser
          ->click(' #table3 > tbody > tr:nth-child(1) > td.sorting_1')
          ->click('.btn-danger');

 //311 Data Tables:Advanced Data tables: Add/Remove rows Table,Testing search field with in the table data
            $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
            $browser
            ->waitFor('#table3_filter > label > input')
           ->type('[id="table2_filter"] [type="search"]','Jacob')
           ->waitForText('Showing 1 to 1 of 1')
           ->assertSee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

 //312 Data Tables:Advanced Data tables: Add/Remove rows Table,Testing search field with out of the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
            $browser
            ->waitFor('#table3_filter > label > input')
            ->type('[id="table2_filter"] [type="search"]','lorvent')
            ->waitForText('Showing 0 to 0 of 0 entries (filtered from 17 total entries)')
           ->assertSee('No matching records found');

//313 Data Tables:Advanced Data tables:Add/Remove rows Table,   Testing Show entries drop down
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
            $browser
            ->waitFor('#table3_length > label > select')
            ->select('[id="table3_length"]','25')
            ->driver->executeScript('window.scrollTo(1400,1900);');
            $browser
            ->waitForText('Showing 1 to 17')
            ->assertSee('Showing 1 to 17 of 17 entries');
        
 //314 Data Tables:Advanced Data tables: Add/Remove rows Table,Testing Pagination
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1900);');
            $browser
            ->waitFor('#table3_paginate > ul > li:nth-child(3) > a')
           ->click('#table3_paginate > ul > li:nth-child(3) > a')
           ->assertSee('Showing 11 to 17 of 17 entries');

//315  Data Tables:Advanced Data Tables:Add/Remove rows Table,Testing '#'' column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 1400);');
            $browser
            ->waitFor('#table3 > thead > tr > th.sorting_desc')
            ->click('#table3 > thead > tr > th.sorting_desc')
            ->waitFor('#table3 > thead > tr > th.sorting_asc')
           ->click('#table3 > thead > tr > th.sorting_asc');

//316 Data Tables:Advanced Data Tables:Add/Remove rows Table,Testing First Name column sorting
             $browser->visit('/admin/advanced_tables')
             ->driver->executeScript('window.scrollTo(0, 1400);');
             $browser
             ->waitFor('#table3 > thead > tr > th:nth-child(2)')
             ->click('#table3 > thead > tr > th:nth-child(2)')
              ->waitFor('#table3 > thead > tr > th:nth-child(2)')
             ->click('#table3 > thead > tr > th:nth-child(2)');

 //317 Data Tables:Advanced Data Tables:Add/Remove rows Table,Testing Last Name column sorting
           $browser->visit('/admin/advanced_tables')
          ->driver->executeScript('window.scrollTo(0, 1400);');
          $browser
          ->waitFor('#table3 > thead > tr > th:nth-child(3)')
          ->click('#table3 > thead > tr > th:nth-child(3)')
          ->waitFor('#table3 > thead > tr > th:nth-child(3)')
          ->click('#table3 > thead > tr > th:nth-child(3)');

//318 Data Tables:Advanced Data Tables:Add/Remove rows Table,Testing User Name column sorting
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 1400);');
            $browser
            ->waitFor('#table3 > thead > tr > th:nth-child(4)')
            ->click('#table3 > thead > tr > th:nth-child(4)')
            ->waitFor('#table3 > thead > tr > th:nth-child(4)')
            ->click('#table3 > thead > tr > th:nth-child(4)');

 //319 Data Tables:Advanced Data Tables:Add/Remove rows Table,Testing User Email column sorting
           $browser->visit('/admin/advanced_tables')
          ->driver->executeScript('window.scrollTo(0, 1400);');
          $browser
          ->waitFor('#table3 > thead > tr > th:nth-child(5)')
          ->click('#table3 > thead > tr > th:nth-child(5)')
          ->waitFor('#table3 > thead > tr > th:nth-child(5)')
          ->click('#table3 > thead > tr > th:nth-child(5)');

 //320 Data Tables:Advanced Data Tables:Scroller ,Testing search field with in the table data
             $browser->visit('/admin/advanced_tables')
             ->driver->executeScript('window.scrollTo(0, 2100);');
             $browser
             ->waitFor('#sample_5_filter > label > input')
             ->type('[id="sample_5_filter"] [type="search"]','Camino 1.0')
             ->assertSee('Showing 1 to 1 of 1 entries (filtered from 43 total entries)');

//321 Data Tables:Advanced Data tables: Scroller,Testing search field with out of the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2100);');
            $browser
            ->waitFor('#sample_5_filter > label > input')
            ->type('[id="sample_5_filter"] [type="search"]','lorvent')
           ->assertSee('No matching records found');

//322 Data Tables:Advanced Data tables: Scroller,testing scroll bar from top to bottom
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2100);');
            $browser
            ->driver->executeScript('document.querySelector("#sample_5_wrapper .dataTables_scrollBody").scrollTo(0, 600);');
            $browser
            ->waitForText('Showing 17 to 22 of 43 entries')
            ->assertsee('Showing 17 to 22 of 43 entries');
            
//323 Data Tables:Advanced Data Tables:Scroller,Testing Rendering engine  column sorting
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2100);');
            $browser
            ->waitForText('Browser')
            ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th.sorting_asc')
            ->waitForText('Browser')
            ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th.sorting_desc');

//324 Data Tables:Advanced Data Tables:Scroller,Testing Browser column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2000);');
            $browser
            ->waitForText('Rendering engine')
           ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(2)')
           ->waitForText('Rendering engine')
            ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(2)');

 // 325 Data Tables:Advanced Data Tables:Scroller,Testing Platforms column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2000);');
           $browser
          ->waitForText('Rendering engine')
          ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(3)')
           ->waitForText('Rendering engine')
          ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(3)');

//326 Data Tables:Advanced Data Tables:Scroller,Testing Engine version column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2000);');
            $browser
            ->waitForText('Rendering engine')
           ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4)')
            ->waitForText('Rendering engine')
           ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4)');

//327 Data Tables:Advanced Data Tables:Scroller,Testing CSS grade column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2000);');
           $browser
           ->waitForText('Rendering engine')
           ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(5)')
            ->waitForText('Rendering engine')
           ->click('#sample_5_wrapper > div.dataTables_scroll > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(5)');

//328 Data Tables:Advanced Data tables:  Inline Edit Table,Testing search field with in the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
            ->waitFor('#inline_edit_filter > label > input')
           ->type('[id="inline_edit_filter"] [type="search"]','Jacob')
           ->waitForText('Showing 1 to 6 of 6')
           ->assertSee('Showing 1 to 6 of 6 entries (filtered from 24 total entries)');

//329 Data Tables:Advanced Data tables:  Inline Edit Table,Testing search field with out of the table data
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2200);');
            $browser
            ->waitFor('#inline_edit_filter > label > input')
            ->type('[id="table2_filter"] [type="search"]','lorvent')
           ->assertSee('No matching records found');

 //330 Data Tables:Advanced Data tables: Inline Edit Table, Testing Show entries drop down
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2200);');
            $browser
            ->waitFor('#inline_edit_length > label > select')
            ->select('[id="inline_edit_length"]','25')
            ->driver->executeScript('window.scrollTo(2200,3400);');
            $browser
            ->assertsee('Showing 1 to 24 of 24 entries'); 

//331 Data Tables:Advanced Data tables:  Inline Edit Table,Testing Pagination
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2800);');
            $browser
            ->waitFor('#inline_edit_paginate > ul > li:nth-child(3) > a')
            ->click('#inline_edit_paginate > ul > li:nth-child(3) > a')
            ->assertsee('Showing 11 to 20 of 24 entries');

//332 Data Tables:Advanced Data tables:Inline Edit Table,Edit the first name of first row
           $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
            ->waitForText('First Name')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td.sorting_1')
           ->type('#inline_edit td input','dgh')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td.sorting_1')
             ->waitForText('First Name');

 //333 Data Tables:Advanced Data tables:Inline Edit Table,Edit the last name of first row by using keys 
           $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
           ->waitForText('First Name')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(2)')
           ->keys('#inline_edit td input','jhgj')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(2)')
           ->waitForText('First Name');

 //334 Data Tables:Advanced Data tables:Inline Edit Table,Edit the User name of first row
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
            ->waitForText('First Name')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(3)')
           ->type('#inline_edit td input','jhgj')
            ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(3)')
           ->waitForText('First Name');

//335 Data Tables:Advanced Data tables:Inline Edit Table,Edit the User Email of first row
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
             ->waitForText('First Name')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(4)')
           ->keys('#inline_edit td input','jhgj')
           ->click('#inline_edit > tbody > tr:nth-child(1) > td:nth-child(4)')
           ->waitForText('First Name');

//336 Data Tables:Advanced Data Tables:Inline Edit Table,Testing First name column sorting
            $browser->visit('/admin/advanced_tables')
            ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
            ->waitForText('First Name')
            ->click('#inline_edit > thead > tr > th.sorting_asc')
            ->waitForText('First Name')
            ->click('#inline_edit > thead > tr > th.sorting_desc');

//337 Data Tables:Advanced Data Tables:Inline Edit Table,Testing Last name column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2500);');
            $browser
            ->waitForText('First Name')
           ->click('#inline_edit > thead > tr > th:nth-child(2)')
            ->waitForText('First Name')
            ->click('#inline_edit > thead > tr > th:nth-child(2)');

//338 Data Tables:Advanced Data Tables:Inline Edit Table,Testing User name column sorting
           $browser->visit('/admin/advanced_tables')
           ->driver->executeScript('window.scrollTo(0, 2500);');
           $browser
           ->waitForText('First Name')
           ->click('#inline_edit > thead > tr > th:nth-child(3)')
           ->waitForText('First Name')
           ->click('#inline_edit > thead > tr > th:nth-child(3)');

//339 Data Tables:Advanced Data Tables:Inline Edit Table,Testing User Email column sorting
          $browser->visit('/admin/advanced_tables')
          ->driver->executeScript('window.scrollTo(0, 2500);');
          $browser
          ->waitForText('First Name')
          ->click('#inline_edit > thead > tr > th:nth-child(4)')
          ->waitForText('First Name')
          ->click('#inline_edit > thead > tr > th:nth-child(4)');

//340 Data Tables:Advanced Datatables2:Dropdown column searching,testing search field with out the table data
          $browser->visit('/admin/advanced_tables2')
          ->waitFor('#table1_filter > label > input')
          ->type('[id="table1_filter"] [type="search"]','lorvent')
          ->assertSee("No matching records found");

//341 Data Tables:Advanced Datatables2:Dropdown column searching,testing search field with in the table data
          $browser->visit('/admin/advanced_tables2')
          ->waitFor('#table1_filter > label > input')
          ->type('[id="table1_filter"] [type="search"]','Jacob')
          ->assertSee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

//342 Data Tables:Advanced Datatables2:Dropdown column searching,testing show entries drop down
          $browser->visit('/admin/advanced_tables2')
          ->waitFor('#table1_length')
          ->select('[id="table1_length"]','25')
          ->driver->executeScript('window.scrollTo(0,800);');
          $browser
          ->assertsee('Showing 1 to 17 of 17 entries');

//343 Data Tables:Advanced Datatables2:Dropdown column searching,Pagination testing
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 400);');
          $browser
          ->waitForText('Showing 1 to 10 of 17 entries')
          ->click('#table1_paginate > ul > li:nth-child(3) > a')
          ->waitForText('Showing 11 to 17 ')
          ->assertSee('Showing 11 to 17 of 17 entries');

//344 Data Tables:Advanced Data Tables2:Dropdown column searching,Testing '#' column sorting
           $browser->visit('/admin/advanced_tables2')
           ->waitForText('#')
          ->click('#table1 > thead > tr > th.sorting_asc')
           ->waitForText('#')
          ->click('#table1 > thead > tr > th.sorting_desc');

//345 Data Tables:Advanced Data Tables2:Dropdown column searching,Testing First Name column sorting
           $browser->visit('/admin/advanced_tables2')
           ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(2)')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(2)');

//346  Data Tables:Advanced Data Tables2:Dropdown column searching,Testing Last Name column sorting
           $browser->visit('/admin/advanced_tables2')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(3)')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(3)');

//347 Data Tables:Advanced Data Tables2:Dropdown column searching,Testing User Name column sorting
           $browser->visit('/admin/advanced_tables2')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(4)')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(4)');

//348 Data Tables:Advanced Data Tables2:Dropdown column searching,Testing User Email column sorting
           $browser->visit('/admin/advanced_tables2')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(5)')
          ->waitForText('#')
          ->click('#table1 > thead > tr > th:nth-child(5)');

//349 Data Tables:Advanced Data Tables2:Dropdown column searching,Select '#'column drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 200);');
          $browser
          ->select('#table1 > tfoot > tr > th:nth-child(1) > select','23')
          ->waitForText('Showing 1 to 1 of 1 entries ')
          ->assertsee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

//350 Data Tables:Advanced Data Tables2:Dropdown column searching,Select First Name column drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 200);');
           $browser
          ->select('#table1 > tfoot > tr > th:nth-child(2) > select','Jacob')
          ->waitForText('Showing 1 to 1 of 1 entries ')
          ->assertsee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

//351 Data Tables:Advanced Data Tables2:Dropdown column searching,Select Last Name column drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 200);');
           $browser
          ->select('#table1 > tfoot > tr > th:nth-child(3) > select','Thornton')
          ->waitForText('Showing 1 to 1 of 1 entries ')
          ->assertsee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

 //352 Data Tables:Advanced Data Tables2:Dropdown column searching,Select User Name column drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 200);');
          $browser
         ->select('#table1 > tfoot > tr > th:nth-child(4) > select','JacobThornton')
         ->waitForText('Showing 1 to 1 of 1 entries')
          ->assertsee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

//353 Data Tables:Advanced Data Tables2:Dropdown column searching,Select User Email column drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 200);');
          $browser
         ->select('#table1 > tfoot > tr > th:nth-child(5) > select','JacobThornton@test.com')
        ->waitForText('Showing 1 to 1 of 1 entries ')
          ->assertsee('Showing 1 to 1 of 1 entries (filtered from 17 total entries)');

// 354 Data Tables:Advanced Data Tables2:Child rows,Search field testing with out of the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 500);');
          $browser
          ->waitFor('#table2_filter > label > input')
          ->type('[id="table2_filter"] [type="search"]','harryss')
          ->assertSee('No matching records found');

//355 Data Tables:Advanced Data Tables2:Child rows,Search field testing with in the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 800);');
          $browser
          ->waitFor('#table2_filter > label > input')
          ->type('[id="table2_filter"] [type="search"]','Harry')
          ->assertSee('Showing 1 to 1 of 1 entries (filtered from 20 total entries)');

//356 Data Tables:Advanced Data Tables2:Child rows,show entries drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 500);');
          $browser
          ->waitFor('#table2_length > label > select')
          ->select('[id="table2_length"]','25')
          ->driver->executeScript('window.scrollTo(500, 1500);');
          $browser
          ->assertSee('Showing 1 to 20 of 20 entries');

//357 Data Tables:Advanced Data tables2:Child rows,Pagination testing
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1000);');
          $browser
          ->waitForText('Showing 1 to 10 of 20 entries')
          ->click('#table2_paginate > ul > li:nth-child(3) > a')
          ->assertSee('Showing 11 to 20 of 20 entries');

//358 Data Tables:Advanced Data tables2:Child rows,testing expand button(+ icon) and collapse
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 800);');
          $browser
          ->waitForText('#')
          ->click('#table2 > tbody > tr:nth-child(1) > td.details-control')
          ->waitForText('User name:')
          ->click('#table2 > tbody > tr.shown > td.details-control');

//359 Data Tables:Advanced data tables2:Child rows,testing '#' column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 800);');
          $browser
          ->waitForText('#')
          ->click('#table2 > thead > tr > th.sorting_asc')
          ->waitForText('#')
          ->click('#table2 > thead > tr > th.sorting_desc');

//360 Data Tables:Advanced data tables2:Child rows,testing first name column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 800);');
          $browser
           ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(3)')
          ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(3)');

//361 Data Tables:Advanced data tables2:Child rows,testing last name column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 500);');
          $browser
          ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(4)')
          ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(4)');

//362 Data Tables:Advanced data tables2:Child rows,testing User Email column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 500);');
          $browser
          ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(5)')
          ->waitForText('#')
          ->click('#table2 > thead > tr > th:nth-child(5)');

//363 Data Tables:Advanced data tables2:Show / Hide Columns,Search field testing with out of the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitFor('#example_filter > label > input')
          ->type('[id="example_filter"] [type="search"]','harryss')
          ->waitForText('Showing 0 to 0 of 0 entries (filtered from 40 total entries)')
          ->assertSee("No matching records found");

//364 Data Tables:Advanced Data Tables2:Show / Hide Columns,Search field testing with in the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitFor('#example_filter > label > input')
          ->type('[id="example_filter"] [type="search"]','Books')
          ->waitForText('Showing 1 to 2 of 2 ')
          ->assertSee('Showing 1 to 2 of 2 entries (filtered from 40 total entries)');

//365 Data Tables:Advanced Data Tables2:Show / Hide Columns,show entries drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitFor('#example_length > label > select')
          ->select('[id="example_length"]','25')
          ->driver->executeScript('window.scrollTo(1500,2400);');
          $browser
          ->waitForText('Showing 1 to 25')
          ->assertsee('Showing 1 to 25 of 40 entries');

//366 Data Tables:Advanced Data tables2:Show / Hide Columns,Pagination testing
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1835);');
          $browser
          ->waitForText('Showing 1 to 10 of 40 entries')
          ->click('#example_paginate > ul > li:nth-child(3) > a')
          ->assertsee('Showing 11 to 20 of 40 entries');

//367 Data Tables:Advanced Data tables2:Show/Hide column,testing Name button in Toggle Column button group
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('[data-column="0"]');

//368 Data Tables:Advanced Data tables2:Show/Hide column,testing User Name button in Toggle Column button group
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('[data-column="1"]');

//369 Data Tables:Advanced Data tables2:Show/Hide column,testing Email button in Toggle Column button group
           $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 1500);');
           $browser
           ->waitForText('Toggle column:')
           ->click('[data-column="2"]');

//370 Data Tables:Advanced Data tables2:Show/Hide column,testing Department button in Toggle Column button group
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('[data-column="3"]');

//371 Data Tables:Advanced Data tables2:Show/Hide column,testing Contact button in Toggle Column button group
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
           $browser
           ->waitForText('Toggle column:')
          ->click('[data-column="4"]');

//372 Data Tables:Advanced data tables2:Show/Hide column,testing Name column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th.sorting_asc')
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th.sorting_desc');

//373 Data Tables:Advanced data tables2:Show/Hide column,testing User name column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(2)')
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(2)');

//374 Data Tables:Advanced data tables2:Show/Hide column,testing Email column sorting
           $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 1500);');
           $browser
           ->waitForText('Toggle column:')
           ->click('#example > thead > tr > th:nth-child(3)')
           ->waitForText('Toggle column:')
           ->click('#example > thead > tr > th:nth-child(3)');

//375 Data Tables:Advanced data tables2:Show/Hide column,testing Department column sorting
          $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 1500);');
          $browser
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(4)')
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(4)');

//376 Data Tables:Advanced data tables2:Show/Hide column,testing Contact column sorting
          $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 1500);');
           $browser
           ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(5)')
          ->waitForText('Toggle column:')
          ->click('#example > thead > tr > th:nth-child(5)');

//377 Data Tables:Advanced data tables2: Form fields inside the table,Search field testing with out of the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2300);');
           $browser
           ->waitFor('#table4_filter > label > input')
          ->type('[id="table4_filter"] [type="search"]','harryss')
          ->waitForText('Showing 0 to 0 of 0 entries (filtered from 57 total entries)')
          ->assertSee('No matching records found');

//378 Data Tables:Advanced Data Tables2: Form fields inside the table,Search field testing with in the table data
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2300);');
          $browser
          ->waitFor('#table4_filter > label > input')
          ->type('[id="table4_filter"] [type="search"]','tokyo')
           ->driver->executeScript('window.scrollTo(2300, 3000);');
          $browser
          ->waitForText('Showing 1 to 5 of 5 entries')
          ->assertSee('Showing 1 to 5 of 5 entries (filtered from 57 total entries)');

 //379 Data Tables:Advanced Data Tables2: Form fields inside the table,show entries drop down
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
           $browser
           ->waitForText('Show')
           ->select('[id="table4_length"]','25')
           ->driver->executeScript('window.scrollTo(2250, 3500);');
           $browser
           ->assertsee('Showing 1 to 25 of 57 entries');
        
//380 Data Tables:Advanced Data tables2: Form fields inside the table,Pagination testing
           $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 3000);');
            $browser
            ->waitForText('Showing 1 to 10 of 57 entries')
           ->click('#table4_paginate > ul > li:nth-child(3) > a')
           ->assertSee('Showing 11 to 20 of 57 entries');

//381 Data Tables:Advanced data tables2:Form fields inside the table,testing Name column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
          $browser
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th.sorting_asc')
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th.sorting_desc');

//382 Data Tables:Advanced data tables2:Form fields inside the table,testing Age column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
          $browser
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(2)')
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(2)');

//383 Data Tables:Advanced data tables2:Form fields inside the table,testing Position column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
          $browser
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(3)')
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(3)');

//384 Data Tables:Advanced data tables2: Form fields inside the table,testing Office column sorting
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
           $browser
           ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(4)')
          ->waitForText('Name')
          ->click('#table4 > thead > tr > th:nth-child(4)');

//385 Data tables:Advanced data tables2:Form fields inside the table,testing drop down office
          $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
          $browser
          ->waitForText('Office')
          ->select('#row-5-office','London');

 //386 Data tables:Advanced data tables2:Form inside the table,edit the age
           $browser->visit('/admin/advanced_tables2')
          ->driver->executeScript('window.scrollTo(0, 2250);');
           $browser
           ->waitForText('Age')
          ->type('[id="row-5-age"]','36');

 //387 Data tables:Advanced data tables2:Form inside the table,edit the Position
           $browser->visit('/admin/advanced_tables2')
           ->driver->executeScript('window.scrollTo(0, 2250);');
           $browser
          ->driver->executeScript('window.scrollTo(0, 2250);');
           $browser
          ->keys('[id="row-5-position"]','Accountss');

 //388 Data tables:Responsive data tables: Responsive Flip Table,testing search field without of the table data
          $browser->visit('/admin/responsive_tables')
          ->waitFor('#DataTables_Table_0_filter > label > input')
          ->type('[id="DataTables_Table_0_filter"] [type="search"]','aaadu')
          ->waitForText('Showing 0 to 0 of 0 entries (filtered from 11 total entries)')
          ->assertSee('No matching records found');

 //389 Data tables:Responsive data tables: Responsive Flip Table,testing search field with the table data only
          $browser->visit('/admin/responsive_tables')
          ->waitFor('#DataTables_Table_0_filter > label > input')
          ->type('[id="DataTables_Table_0_filter"] [type="search"]','ADU')
          ->waitForText('Showing 1 to 1 of 1 entries ')
          ->assertSee('Showing 1 to 1 of 1 entries (filtered from 11 total entries)');

//390 Data tables:Responsive data tables:Responsive flip table,testing show entries drop down
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Show')
          ->select('[id="DataTables_Table_0_length"]','25')
          ->driver->executeScript('window.scrollTo(0, 500);');
          $browser
          ->assertsee('Showing 1 to 11 of 11 entries');
        

 //391 Data tables:Responsive data tables:Responsive flip table,testing pagination
          $browser->visit('/admin/responsive_tables')
          ->driver->executeScript('window.scrollTo(0, 400);');
          $browser
          ->waitForText('Showing 1 to 10 of 11 entries')
          ->click('#DataTables_Table_0_paginate > ul > li:nth-child(3) > a')
          ->waitForText('Showing 11 to 11 ')
          ->assertsee('Showing 11 to 11 of 11 entries');

 //392 Data tables:Responsive data tables:Responsive flip table,testing Code column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th.sorting_asc')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th.sorting_desc');

//393 Data tables:Responsive data tables:Responsive flip table,testing Company column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(2)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(2)');

//394 Data tables:Responsive data tables:Responsive flip table,testing Price column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(3)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(3)');

 //395 Data tables:Responsive data tables:Responsive flip table,testing Change column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(4)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(4)');

 //396 Data tables:Responsive data tables:Responsive flip table,testing Change% column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(5)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(5)');

//397  Data tables:Responsive data tables:Responsive flip table,testing Open column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(6)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(6)');

//398 Data tables:Responsive data tables:Responsive flip table,testing High column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(7)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(7)');

//399 Data tables:Responsive data tables:Responsive flip table,testing Low column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(8)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(8)');

//400 Data tables:Responsive data tables:Responsive flip table,testing Volume column sorting
          $browser->visit('/admin/responsive_tables')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(9)')
          ->waitForText('Code')
          ->click('#DataTables_Table_0 > thead > tr > th:nth-child(9)');

 //401 Lock Screen:click on Go button with empty password field
           $browser->visit('/admin/1/lockscreen')
           ->click('#index')
           ->assertSee('Please enter password');

//402 Lock Screen:click on Go button with unregisterd password field
           $browser->visit('/admin/1/lockscreen')
           ->type('user','123')
           ->click('#index')
           ->assertSee('You have entered a Wrong Password');

 //403 Lock Screen:click on Go button with registerd password field
           $browser->visit('/admin/1/lockscreen')
           ->type('[name="user"]','admin')
           ->click('#index')
          ->assertPathIs('/laravel55/public/admin');

 //404 Forgot Password:Click on Reset button with empty field
           $browser->visit('/admin/signin')
           ->click('[href="#toforgot"]')
          ->click('#reset_pw > p.login.button > input')
          ->waitForText('A registered')
           ->assertSee('A registered email address is required');

 //405 Forgot Password:Click on Reset button with  registerd email id with out @
           $browser->visit('/admin/signin')
           ->click('[href="#toforgot"]')
           ->waitFor('#reset_pw > p.login.button > input')
           ->type('[placeholder="your@mail.com"]','admin')
           ->click('#reset_pw > p.login.button > input')
             ->assertSee('The input is not a valid email address')
            ->assertPathIs('/admin/signin');

 //406 Forgot Password:Click on Reset button with unregisterd email id
           $browser->visit('/admin/signin')
           ->waitFor('#email')
           ->click('[href="#toforgot"]')
           ->type('[placeholder="your@mail.com"]','admindgdfg@admin.com')
            ->click('#reset_pw > p.login.button > input')
                ->assertSee('Error: Email is incorrect.')
            ->assertPathIs('/laravel55/public/admin/signin');
    

 // 407 Forgot Password:Click on Reset button with registerd email id
           $browser->visit('/admin/signin')
           ->waitFor('#email')
           ->click('[href="#toforgot"]')
           ->type('[placeholder="your@mail.com"]','admin@admin.com')
           ->click('#reset_pw > p.login.button > input')
           ->assertSee('Success: Password recovery email successfully sent.')
          ->assertPathIs('/laravel55/public/admin/signin');

 //408  Front end :Click on Login button with empty fields
            $browser->visit('/login')
            ->click('.btn-primary')
            ->assertSee('The email address is required');

 //409 Front end:Click on Login button with email field with out @
            $browser->visit('/login')
            ->type('email','admin')
            ->click('.btn-primary')
            ->assertSee('The input is not a valid email address');

 //410 Front end:Click on Login button with unregisterd email ,with empty passward
            $browser->visit('/login')
            ->type('email','adminad@gmail.com')
            ->click('.btn-primary')
            ->assertSee('Password is required');

  // 411 Front end:Click on Login button with unregisterd email ,with registred password
            $browser->visit('/login')
            ->type('email','adminad@gmail.com')
            ->type('password','admin')
            ->click('.btn-primary')
            ->assertSee('Error: Email or password is incorrect.');

 // 412 Front end:Click on Login button with registerd email,with unregisterd password
            $browser->visit('/login')
            ->type('email','admin@admin.com')
            ->type('password','admin123')
            ->click('.btn-primary')
            ->assertSee('Error: Email or password is incorrect.');

 //413  Front end:Click on Login button with registerd email and password
            $browser->visit('/login')
            ->type('email','admin@admin.com')
            ->type('password','admin')
            ->click('.btn-primary')
           ->assertPathIs('/laravel55/public/my-account');

 // 414 Front end:Click on Login button with Password field only
            $browser->visit('/login')
            ->type('password','admin')
            ->click('.btn-primary')
            ->assertSee('The email address is required');

 //415  Front end:Forgot password:
            $browser->visit('/login')
            ->click('[id="forgot_pwd_title"]')
            ->assertPathIs('/laravel55/public/forgot-password');

 //416 Front end:Forgot password:Click on Reset your Password button with empty email id field
           $browser->visit('/forgot-password')
           ->click('.btn-primary')
           ->assertSee('The email address is required');

 //417 Front end:Forgot password:Click on Reset your Password button with email id with out @
           $browser->visit('/forgot-password')
           ->type('email','gfhdgf')
           ->click('.btn-primary')
           ->assertSee('The input is not a valid email address');

 //418 Front end:Forgot password:Click on Reset your Password button with un registered email id
           $browser->visit('/forgot-password')
           ->type('email','gfhdgf@gmial.com')
           ->click('.btn-primary')
           ->assertSee('Error: Email is incorrect.');

 // 419 Front end:Forgot password:Click on Reset your Password button with registered email id
           $browser->visit('/forgot-password')
           ->type('email','admin@admin.com')
           ->click('.btn-primary')
           ->assertSee('Success: Password recovery email successfully sent.');

 //420 Front end:Register:Click on Sign up button with empty fields
            $browser->visit('/register')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('First name is required');

 //421 Front end:Register:Click on Sign up button with First name field only
            $browser->visit('/register')
            ->type('first_name','admin')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('Last name is required');

 // 422 Front end:Register:Click on Sign up button with First name and Last name fields
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('The email address is required');

 //423  Front end:Register:Click on Sign up button with First name , Last name and email id with out @ fields
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','fgfgf')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('The input is not a valid email address');

 //424 Front end:Register:Click on Sign up button with First name , Last name and with existed email id
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','admin@admin.com')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('Password is required');

 // 425 Front end:Register:Click on Sign up button with First name , Last name and password as the same
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','admin@admin.com')
            ->type('password','admin')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('Password should not match first/last Name');

 //426 Front end:Register:Click on Sign up button with Except Confirm Password field
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','admin@admin.com')
            ->type('password','admin1')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('Confirm Password is required');

 // 427 Front end:Register:Click on Sign up button with different password and confirm password fields
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','admin@admin.com')
            ->type('password','admin1')
            ->type('password_confirm','admin')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('Please enter the same value')
            ->assertSee('Confirm Password should match with password');

 //428  Front end:Register:Click on Sign up button with same password and confirm password fields(existed email id)
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','admin@admin.com')
            ->type('password','admin1')
            ->type('password_confirm','admin1')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('The email has already been taken');

 // 429 Front end:Register:Click on Sign up button with First name,last name,passwprd and cofirm password as 2 characters
            $browser->visit('/register')
            ->type('first_name','ad')
            ->type('last_name','ad')
            ->type('email','adminyuy@admin.com')
            ->type('password','12')
            ->type('password_confirm','12')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertSee('The first name must be at least 3 characters.')
            ->assertSee('The last name must be at least 3 characters.')
           ->assertSee('The password must be between 3 and 32 characters.');

 // 430 Front end:Register:Click on Sign up button with email id as special characters
            $browser->visit('/register')
            ->type('first_name','addff')
            ->type('last_name','adddf')
            ->type('email','!#$%@gmail.com')
            ->assertSee('The input is not a valid email address');

 //431  Front end:Register:Click on Sign up button with all valid inputs
            $browser->visit('/register')
            ->type('first_name','admin')
            ->type('last_name','admin')
            ->type('email','adminad@admin.com')
            ->type('password','admin1')
            ->type('password_confirm','admin1')
            ->click('[class="btn btn-block btn-primary"]')
            ->assertPathIs('/laravel55/public/my-account');

           
// Crud builder:click on Register button with empty fields
            $browser->visit('/admin/generator_builder')
            ->click('.btn-success')
            ->waitForText('Something went wrong!')
            ->click('[class="confirm"]')
            ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Click on Register button with Modal Name only
            $browser->visit('/admin/generator_builder')
            ->waitFor('#txtModelName')
            ->type('model_name','fgsdd')
            ->click('.btn-success')
            ->waitForText('Something went wrong!')
           ->click('[class="confirm"]')
           ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Click on register button with Field name only
           $browser->visit('/admin/generator_builder')
           ->waitFor('#container > tr > td:nth-child(1) > input')
           ->type('#container > tr > td:nth-child(1) > input','datess')
           ->click('.btn-success')
          ->waitForText('Something went wrong!')
          ->click('[class="confirm"]')
          ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Click on register button with Modal name and Field name
           $browser->visit('/admin/generator_builder')
           ->waitFor('#txtModelName')
           ->type('model_name','fgsdssds')
           ->type('#container > tr > td:nth-child(1) > input','dates')
           ->click('.btn-success')
           ->waitForText('Something went wrong!')
           ->click('[class="confirm"]')
           ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Click on register button with Modal name and Field name as Dateee and DB type as integer ,validation as date and Html as date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','Dataaass')
       ->type('#container > tr > td:nth-child(1) > input','dataaeasss')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Click on register button with Modal name and Field name as Date and DB type as integer ,validation as date and Html as date for one field,and another filed field name as fname,DB type as text,validation as required,Html as text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','date')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnAdd')
       ->click('.btn-primary')
       ->type('#container > tr:nth-child(2) > td:nth-child(1) > input','first name')
       ->select('#container > tr:nth-child(2) > td:nth-child(2) > select','text')
       ->click('#container > tr:nth-child(2) > td:nth-child(3) > span > span.selection > span > ul > li.select2-search.select2-search--inline > input')
       ->select('#container > tr:nth-child(2) > td:nth-child(3) > select','required')
       ->select('#container > tr:nth-child(2) > td:nth-child(4) > select','text')
       ->driver->executeScript('window.scrollTo(0, 1000);');
         $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as passwrd and Db type as string,validation as integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','passwrdss')
       ->type('#container > tr > td:nth-child(1) > input','passwrdss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
      ->waitFor('#btnGenerate')
      ->click('.btn-success')
      ->waitForText('Files created successfully',10)
      ->assertSee('Files created successfully');

 // Crud builder:Field name as Psword and Db type as string,validation as integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','pswords')
       ->type('#container > tr > td:nth-child(1) > input','pswordse')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
      ->waitFor('#btnGenerate')
      ->click('.btn-success')
      ->waitForText('Files created successfully',10)
      ->assertSee('Files created successfully');

// Crud builder:Field name as Passwordps and Db type as integer,validation as integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','passwordpss')
       ->type('#container > tr > td:nth-child(1) > input','passwordpss')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
      ->waitFor('#btnGenerate')
      ->click('.btn-success')
     ->waitForText('Files created successfully',10)
      ->assertSee('Files created successfully');

 // Crud builder:Field name as Passwordn and Db type as string,validation as email and Html as text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','passwordns')
       ->type('#container > tr > td:nth-child(1) > input','passwordns')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
      ->waitFor('#btnGenerate')
      ->click('.btn-success')
      ->waitForText('Files created successfully',10)
      ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as string,validation as required and Html as text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','texts')
       ->type('#container > tr > td:nth-child(1) > input','texts')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as email and Db type as string,validation as required and Html as email
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','emailsss')
       ->type('#container > tr > td:nth-child(1) > input','emailss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as number and Db type as string,validation as required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','numberssss')
       ->type('#container > tr > td:nth-child(1) > input','numberss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as Dates and Db type as string,validation as required and Html as date
        $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','datessss')
       ->type('#container > tr > td:nth-child(1) > input','datesss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as file and Db type as string,validation as required and Html as file
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','filessss')
       ->type('#container > tr > td:nth-child(1) > input','filesss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as uniquePassword and Db type as string,validation as required and Html as password
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','uniqueuniques')
       ->type('#container > tr > td:nth-child(1) > input','unqpwords')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as select and Db type as string,validation as required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','selectsss')
       ->type('#container > tr > td:nth-child(1) > input','selectss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','sad,fgsf,gdfgh,sfdg')
       ->driver->executeScript('window.scrollTo(0, 100);');
        $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as radio and Db type as string,validation as required and Html as Radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','radiosss')
       ->type('#container > tr > td:nth-child(1) > input','radioss')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','shhad,fgsg')
       ->driver->executeScript('window.scrollTo(0, 100);');
        $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// ***Crud builder:Field name as checkbox and Db type as string,validation as required and Html as Check box
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','checkboxsses')
       ->type('#container > tr > td:nth-child(1) > input','checkboxses')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','shhvc')
        ->driver->executeScript('window.scrollTo(0, 1000);');
        $browser              
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as string,validation as email and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','first')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as email and Db type as string,validation as email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','second')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as number and Db type as string,validation as email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','third')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


 // Crud builder:Field name as date and Db type as string,validation as email and Html as date
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fourth')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as file and Db type as string,validation as email and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as password and Db type as string,validation as email and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','sixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as select and Db type as string,validation as email and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','seventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
         $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->waitFor('[class="confirm"]')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as radio and Db type as string,validation as email and Html as radio
       $browser->visit('/admin/generator_builder')
         ->waitFor('#txtModelName')
       ->type('model_name','eightth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
        $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as checkbox and Db type as string,validation as email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','ninenth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
        ->type('#container > tr > td:nth-child(4) > input','check')
        ->driver->executeScript('window.scrollTo(0, 1000);');
        $browser
        ->waitFor('#btnGenerate')
        ->click('.btn-success')
        ->waitForText('Files created successfully',10)
        ->click('[class="confirm"]')
        ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as text and Db type as string,validation as date and Html as text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','firstd')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as string,validation as date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','secondd')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as number and Db type as string,validation as date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','thirdd')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as date and Db type as string,validation as date and Html as date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fourthd')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as string,validation as date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fifthd')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as string,validation as date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','sixthh')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as string,validation as date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','seevv')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as radio and Db type as string,validation as date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','eight')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as string,validation as date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','nine')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
        ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as string,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','firstda')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully')
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as string,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','seconddd')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfullu');

// Crud builder:Field name as number and Db type as string,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','thirddd')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as string,validation as Integer  and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fourthhh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as string,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fifthh')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as string,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','sixthhh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as Radio and Db type as string,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','seventhh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as string,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','eighthh')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
        ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as string,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','firsttt')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully')
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as string,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','secondddd')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as string,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','thirddddd')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as string,validation as Boolean  and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fourthhhhh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as string,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fifthhh')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as string,validation as Boolean and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','sixthhhh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as Radio and Db type as string,validation as Boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','seventhhh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as string,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','eighthhh')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','string')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Text,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Text,validation as Required and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Text,validation as Required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as Date and Db type as Text,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as text,validation as Required  and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as text,validation as Required and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Text,validation as Required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtsevanth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as Radio and Db type as Text,validation as Required and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txteighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Text,validation as Required and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
      ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


// Crud builder:Field name as TextArea and Db type as Text,validation as Required and Html as TextArea
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txttenth')
       ->type('#container > tr > td:nth-child(1) > input','TextArea')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','textarea')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as Text,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Text,validation as Email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtesecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Text,validation as Email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtethird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as text,validation as Email  and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtefourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as text,validation as Email and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtefifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Text,validation as Email and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtesixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as Radio and Db type as Text,validation as Email and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txteseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Text,validation as Email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txteeighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


// Crud builder:Field name as TextArea and Db type as Text,validation as Email and Html as TextArea
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txteninthh')
       ->type('#container > tr > td:nth-child(1) > input','TextArea')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','textarea')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as Text,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtdfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Text,validation as Date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtdsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Text,validation as Date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as text,validation as Date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdfourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as text,validation as Date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdfifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Text,validation as Date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully'); 

 
// Crud builder:Field name as Radio and Db type as Text,validation as Date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Text,validation as Date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdeighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


// Crud builder:Field name as TextArea and Db type as Text,validation as Date and Html as TextArea
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtdninthh')
       ->type('#container > tr > td:nth-child(1) > input','TextArea')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','textarea')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as Text,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtifirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Text,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtisecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Text,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtithird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as text,validation as Integer and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtifourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as text,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtififth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Text,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtisixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Text,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtiseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Text,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtieighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


// Crud builder:Field name as TextArea and Db type as Text,validation as Integer and Html as TextArea
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtininthh')
       ->type('#container > tr > td:nth-child(1) > input','TextArea')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','textarea')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as Text,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtbfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Text,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','txtbsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Text,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as text,validation as Boolean and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbfourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as text,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbfifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Text,validation as Boolean and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Text,validation as Boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Text,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbeighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as TextArea and Db type as Text,validation as Boolean and Html as TextArea
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','txtbninthh')
       ->type('#container > tr > td:nth-child(1) > input','TextArea')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','textarea')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as text and Db type as Integer,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','inttfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Integer,validation as Required and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','inttsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Integer,validation as Required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Integer,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intttfourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Integer,validation as Required and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Integer,validation as Required and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Integer,validation as Required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Integer,validation as Required and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intteighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Integer,validation as Required and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Integer,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Integer,validation as Email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intesecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Integer,validation as Email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intethird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Integer,validation as Email and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inttefourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Integer,validation as Email and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intefifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Integer,validation as Eamil and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intesixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Integer,validation as email and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inteseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Integer,validation as Email and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inteeighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Integer,validation as Email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intenineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Integer,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intdfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Integer,validation as Date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intdsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Integer,validation as Date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Integer,validation as Date and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdfourthh')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Integer,validation as Date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Integer,validation as Date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Integer,validation as Date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Integer,validation as Date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intedighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Integer,validation as Date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intdnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Integer,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intifirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Integer,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intisecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Feld name as number and Db type as Integer,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intithird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Integer,validation as Integer and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intifourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Integer,validation as Integer and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intififth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Integer,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intisixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Integer,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intiseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Integer,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','inteiighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Integer,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intinineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Integer,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intbfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Integer,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','intbsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Integer,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Integer,validation as Boolean and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbfourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Integer,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbfifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Integer,validation as Boolean and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Integer,validation as boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Integer,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','intbeight')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','integer')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


// Crud builder:Field name as text and Db type as Float,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltrfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Float,validation as Required and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltrsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Float,validation as Required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Float,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Float,validation as Required and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Float,validation as Required and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as float,validation as Required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Float,validation as Required and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltreighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Float,validation as Required and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltrnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

    // Crud builder:Field name as text and Db type as Float,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Float,validation as Email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltesecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Float,validation as Email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltethird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Float,validation as Email and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltefourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Float,validation as Email and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltefifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as float,validation as Email and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltesixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Float,validation as Email and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','flteseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Float,validation as Email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','flteeigth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');
    
    // Crud builder:Field name as text and Db type as Float,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltdfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Float,validation as Date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltdsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Float,validation as Date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Float,validation as Date and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Float,validation as Date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Float,validation as Date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as select and Db type as float,validation as Date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');  

 
// rtPaCrud builder:Field name as Radio and Db type as Float,validation as Date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdeighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Float,validation as Date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltdnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


 // Crud builder:Field name as text and Db type as Float,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltifirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Float,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltisecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Float,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltithird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Float,validation as Integer and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltifourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Float,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltififth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as float,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltisixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Float,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltiseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Float,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltieigth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Float,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltbfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Float,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','fltbsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Float,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Float,validation as Boolean and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbfourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','booleanr')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Float,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbfifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as float,validation as Boolean and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Float,validation as Boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Float,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','fltbeigth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','float')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
      ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Decimal,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmrfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Decimal,validation as Required and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmrsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Decimal,validation as Required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Decimal,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Decimal,validation as Required and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Decimal,validation as Required and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Decimal,validation as Required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Decimal,validation as Required and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmreighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Decimal,validation as required and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmrnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');
    
// Crud builder:Field name as text and Db type as Decimal,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Decimal,validation as Email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmesecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Decimal,validation as Email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmethird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Decimal,validation as Email and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmefourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Decimal,validation as email and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmefifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Decimal,validation as email and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmesixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Decimal,validation as email and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmeseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Decimal,validation as email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmeeightth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');
    
// Crud builder:Field name as text and Db type as Decimal,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmdfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Decimal,validation as Date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmdsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Decimal,validation as Date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Decimal,validation as Date and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Decimal,validation as Date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Decimal,validation as Date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Decimal,validation as Date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Decimal,validation as Date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdeighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Decimal,validation as Date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmdnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Decimal,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmifghffgdhfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

 // Crud builder:Field name as email and Db type as Decimal,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmiisecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Decimal,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmithird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Decimal,validation as Integer and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmifourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Decimal,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmififth')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Decimal,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmisixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Decimal,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmiseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Decimal,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmieightth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');
    
 //Crud builder:Field name as text and Db type as Decimal,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmbfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Decimal,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','dcmbsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Decimal,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Decimal,validation as Boolean and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbfourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Decimal,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbfifth')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Decimal,validation as Boolean and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Decimal,validation as Boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Decimal,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dcmbeightth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','decimal')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//**Crud builder:Field name as text and Db type as Boolean,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','boolnghdfgdrfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','boolean')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Boolean,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','boolnrsecond')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','boolean')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as Checkbox and Db type as Boolean,validation as Required and Html as Checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','boolrthird')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','boolean')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// **Crud builder:Field name as Text and Db type as Boolean,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','boolnbfourth')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','boolean')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Boolean,validation as Boolean and Html as Checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','boolnbfifth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','boolean')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as Text and Db type as Date ,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','daterfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as file and Db type as Date ,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','datersecond')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as Text and Db type as Date ,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dateefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as Text and Db type as Date ,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','datedfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as Date and Db type as Date ,validation as Date and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','datedsecond')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as Text and Db type as Date ,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','dateifirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

//Crud builder:Field name as file and Db type as Date ,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','datebfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','date')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

 // Crud builder:Field name as text and Db type as Binary,validation as Required and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryrfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as email and Db type as Binary,validation as Required and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryrsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Feld name as number and Db type as Binary,validation as Required and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryrthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as Date and Db type as Binary,validation as Required and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryrfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as file and Db type as Binary,validation as Required and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryrfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as password and Db type as Binary,validation as Required and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryrsixth')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');

// Crud builder:Field name as select and Db type as Binary,validation as Required and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryrseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successful');  

 
// Crud builder:Field name as Radio and Db type as Binary,validation as Required and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryreighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Binary,validation as Required and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrygrnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
        ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

 // Crud builder:Field name as text and Db type as Binary,validation as Email and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryefirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Binary,validation as Email and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryesecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Binary,validation as Email and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryethird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as Binary,validation as Required and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryefourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Binary,validation as Email and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryefifth')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Binary,validation as Email  and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryesixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Binary,validation as Email and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryeseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Binary,validation as Email and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryeeighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','email')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
        ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');


 // Crud builder:Field name as text and Db type as Binary,validation as Date and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnrydfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Binary,validation as Date and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnrydsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Binary,validation as Date and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Date and Db type as Binary,validation as Date and Html as Date
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydfourthh')
       ->type('#container > tr > td:nth-child(1) > input','date')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','date')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as file and Db type as Binary,validation as Date and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydfifth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Binary,validation as Date and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydsixth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Binary,validation as Date and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydseventh')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Binary,validation as Date and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydeighth')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Binary,validation as Date and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrydnineth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','date')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
        ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Binary,validation as Integer and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryifirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Binary,validation as Integer and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnryisecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Binary,validation as Integer and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryithird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as Binary,validation as Integer and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryifourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Binary,validation as Integer and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryififth')
       ->type('#container > tr > td:nth-child(1) > input','passwordd')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Binary,validation as Integer and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryisixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Binary,validation as Integer and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryiseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Binary,validation as Integer and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnryieighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','integer')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
        ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

// Crud builder:Field name as text and Db type as Binary,validation as Boolean and Html as Text
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnrybfirst')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as email and Db type as Binary,validation as Boolean and Html as email
       $browser->visit('/admin/generator_builder')
        ->waitFor('#txtModelName')
       ->type('model_name','bnrybsecond')
       ->type('#container > tr > td:nth-child(1) > input','email')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','email')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Feld name as number and Db type as Binary,validation as Boolean and Html as number
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybthird')
       ->type('#container > tr > td:nth-child(1) > input','number')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','number')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');


// Crud builder:Field name as file and Db type as Binary,validation as Boolean and Html as file
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybfourth')
       ->type('#container > tr > td:nth-child(1) > input','file')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','file')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as password and Db type as Binary,validation as Boolean and Html as password
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybfifth')
       ->type('#container > tr > td:nth-child(1) > input','password')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','password')
       ->waitFor('#btnGenerate')
       ->click('.btn-success')
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as select and Db type as Binary,validation as Boolean  and Html as select
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybsixth')
       ->type('#container > tr > td:nth-child(1) > input','select')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','select')
       ->type('#container > tr > td:nth-child(4) > input','hyd,ts,ap')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');  

 
// Crud builder:Field name as Radio and Db type as Binary,validation as Boolean and Html as radio
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybseventh')
       ->type('#container > tr > td:nth-child(1) > input','radio')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','radio')
       ->type('#container > tr > td:nth-child(4) > input','male,female')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully');

// Crud builder:Field name as Checkbox and Db type as Binary,validation as Boolean and Html as checkbox
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','bnrybeighth')
       ->type('#container > tr > td:nth-child(1) > input','checkbox')
       ->select('.txtdbType','binary')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','boolean')
       ->select('.drdHtmlType','checkbox')
       ->type('#container > tr > td:nth-child(4) > input','fhh')
       ->driver->executeScript('window.scrollTo(0, 1000);');
                    $browser
        ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder');

//Crud builder:Field name as Text and Db type as Text,validation as Required and Html as Text and then create a page
       $browser->visit('/admin/generator_builder')
       ->waitFor('#txtModelName')
       ->type('model_name','textrequiredttext')
       ->type('#container > tr > td:nth-child(1) > input','text')
       ->select('.txtdbType','text')
       ->click('#container > tr > td:nth-child(3) > span > span.selection > span > ul')
       ->select('.txtValidation','required')
       ->select('.drdHtmlType','text')
       ->waitFor('#btnGenerate')
       ->click('.btn-success') 
       ->waitForText('Files created successfully',10)
       ->assertSee('Files created successfully')
       ->click('[class="confirm"]')
       ->assertPathIs('/laravel55/public/admin/generator_builder')
       ->Pause(5000)
       ->visit('/admin');
//Crud Builder:crete field and then edit 
       $browser->visit('/admin/textrequiredttexts')//created page with empty fields
       ->click('.glyphicon-plus')//Click on create button
       ->waitFor('#text')
       ->type('#text','abc123#$%')//Text field
       ->click('[class="btn btn-primary"]')//Save button
       ->click('[id="canvas-for-livicon-54"]')
       ->keys('#text','123')//add extra data to previous data
       ->click('[class="btn btn-primary"]')
       ->assertSee('textrequiredtext updated successfully.');

//Crud Builder:Create more text fields
       $browser->visit('/admin/textrequiredtext')
       ->waitForText('textrequiredtext List  Create')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent')//crete new field
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent12')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent123')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent45')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent56')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent87')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent89')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent95')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorventsdfds')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent256')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent145')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent365')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent145')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->click('[class="btn btn-sm btn-default"]')
       ->type('#text','lorvent8956')
       ->click('[class="btn btn-primary"]')
       ->waitForText('textrequiredtext saved successfully.')
       ->asserPathIs('/laravel55/public/admin/textrequired');

//Crud builder: testing show entries drop down
       $browser->visit('/admin/textrequiredtext')
       ->select('.dataTables_length','25')
       ->driver->executeScript('window.scrollTo(0,500);');
        $browser
        ->waitForText('Showing 1 to 15 of 15 entries')
        ->assertSee('Showing 1 to 15 of 15 entries');

//Crud builder:testing Search field with in the table data
        $browser->visit('/admin/textrequiredtext')
        ->waitFor('[id="textrequiredtext-table_filter"]')
        ->type('[id="textrequiredtext-table_filter"] [type="search"]','abc123#$%123')
        ->waitForText('Showing 1 to 1 of 15 entries (filtered from 15 total entries)')
        ->assertSee('abc123#$%123');

//Crud builder:testing Search field without of the  table data
        $browser->visit('/admin/textrequiredtext')
        ->waitFor('[id="textrequiredtext-table_filter"]')
        ->type('[id="textrequiredtext-table_filter"] [type="search"]','abc123#$%12300')
        ->waitForText('Showing 0 to 0 of 0 entries (filtered from 15 total entries)')
        ->assertSee('No matching records found');

//Crud builder:Testing Pagination
        $browser->visit('/admin/textrequiredtext')
        ->waitFor('[id="textrequiredtext-table_filter"]')
        ->driver->executeScript('window.scrollTo(0,800);');
         $browser
         ->waitForText('Showing 1 to 10 of 15 entries')
         ->click('#textrequiredtext-table_paginate > ul > li:nth-child(3) > a')
         ->waitForText('Showing 11 to 15 of 15 entries')
         ->assertSee('Showing 11 to 15 of 15 entries');

// Crud Builder:Text column sorting
          $browser->visit('/admin/textrequired')
         ->waitFor('[id="textrequiredtext-table_filter"]')
         ->click('#textrequiredtext-table > thead > tr > th.sorting_asc')
         ->waitForText('text')
         ->click('#textrequiredtext-table > thead > tr > th.sorting_desc')
         ->waitForText('text')
         ->assertPathIs('/laravel55/public/admin/textrequiredtext');
        

//Crud builder:testing view icon and then click o Back button
       $browser->visit('/admin/textrequiredtext')
       ->waitForText('textrequiredtext List  Create')
       ->click('[id="canvas-for-livicon-53"]')// click on view icon
       ->waitForText('textrequiredtext details')
       ->click('[class="btn btn-default"]')//Click on Back button
       ->assertPathIs('/laravel55/public/admin/textrequiredtext');

//Crud builder:Testing Delete icon and then cancel button on pop up form
        $browser->visit('/admin/textrequiredtext')
        ->waitForText('textrequiredtext List  Create')
        ->click('[id="canvas-for-livicon-55"]')//Click on Delete icon
        ->waitForText('Are you sure to delete this item? This operation is irreversible.')
        ->click('.modal.in [data-dismiss="modal"]')//click on cancel button on pop up form
        ->assertPathIs('/laravel55/public/admin/textrequiredtext');

//Crud Builder:Testing Delete icon and then cancel icon on pop up form
         $browser->visit('/admin/textrequiredtext')
        ->waitForText('textrequiredtext List  Create')
        ->click('[id="canvas-for-livicon-55"]')//Click on Delete icon
        ->waitForText('Are you sure to delete this item? This operation is irreversible.')
        ->click('[class="close"]')//click on cancel icon on pop up form
        ->assertPathIs('/laravel55/public/admin/textrequiredtext');

//Crud Builder:Testing Delete icon and then delete button on pop up form
        $browser->visit('/admin/textrequiredtext')
        ->waitForText('textrequiredtext List  Create')
        ->click('[id="canvas-for-livicon-55"]')//Click on Delete icon
        ->waitForText('Are you sure to delete this item? This operation is irreversible.')
        ->click('.btn-danger')//Click on delete button on pop up form
        ->assertPathIs('/laravel55/public/admin/textrequiredtext');

        });
    }
}