Laravel5 simple rest api.

Readme

1)Download complete laravel setup to your system or server.

2)open .env file in root
change database details.
DB_HOST=localhost
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

3)Mail is not working currently as I have developed in localhost.
  laravel\config\mail.php

set 'pretend' => true to  'pretend' => false

4)find directory sqlbackup and take sql backup file from there and import to your database.

5)Change email and name in app/config/constant.php

=======================================================================================================================================
api urls:
http://localhost/laravel/public/ is baseurl change it according to you:

showall posts
Method GET
http://localhost/laravel/public/api/posts

Create Post
http://localhost/laravel/public/api/posts
Method:POST

Show Particular Post
Method GET
http://localhost/laravel/public/api/posts/{id}

Update a Post
Method PUT
http://localhost/laravel/public/api/posts/{id}

Delete A Post
Method DELETE
http://localhost/laravel/public/api/posts/{id}
=======================================================================================================================================
showall posts
Method GET
http://localhost/laravel/public/api/tags

Create Tag
http://localhost/laravel/public/api/tags
Method:POST

Update Tag
Method PUT
http://localhost/laravel/public/api/tags/{id}

Show Particular Tag
Method GET
http://localhost/laravel/public/api/tags/{id}

Update a Tag
Method PUT
http://localhost/laravel/public/api/tags/{id}

Delete A Tag
http://localhost/laravel/public/api/tags/{id}

Example Curl request for Posts and Tags will be on testapi directory:

postAll.php    ======================= Get all Posts
postCreate.php ======================= Create Post
postUpdate.php ======================= Update Post
postSingle.php ======================= Show a particular post
postDelete.php ======================= Delete post

tagAll.php     ======================= Get all tags
tagCreate.php  ======================= Create tags
tagUpdate.php  ======================= update Tag
tagSingle.php  ======================= Show a particular tag
tagDelete.php  ======================= Delete a tag