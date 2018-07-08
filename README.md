User Management Prototype
=========================
Info
----
This is simple prototype to represent mine point of view how to architect a software. 
Case study is a REST system to manage user and groups.

Installation
------------

1. To get all vendor dependencies download composer from https://getcomposer.org/download/ 
   (Manual Download, composer.phar) and then run `php composer.phar install`
2. Prototype is build over Zend Framework and PHP.
3. DB script in /data/user_management.sql
4. Set Http server DocumentRoot to "<htdocs-folder-path>/user-management/public"
5. Copy `configuration.php.example` as `configuration.php` and set the database credentials

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (2.4.*)
* [PHP](https://secure.php.net/downloads.php) (7.0.*)

Database model
--------------
* Prototype of the database in data folder

Domain workflow
---------------
1. use `/user/add` API call to add user
2. use `/group/create` API call to create group
3. use `/group/list` API call to get all available groups
4. use `/user/details/<user_id>` API call to get user details
5. use `/user/add-to-group` API call to add user to new group
6. use `/user/remove-from-group/<user_id>/<group_id>` API call 
   to remove user from a group
7. use `/user/list` API call to list all users
8. use `/user/delete/<user_id>` API call to delete user
9. use `/group/delete/<group_id>` API call to delete group

API calls
---------
* POST `<host_url>/user/add`
  request
```
  [
    'name' => name,
    'email' => email
  ]
```

* GET `<host_url>/user/details/<user_id>`
  response
```
  [
    'name' => name,
    'email' => email
    'groups' => [
      [
        'íd' => id,
        'name' => name,
        'description' => id,
      ]
    ]
  ]
```

* POST `<host_url>/user/delete/<user_id>`

* POST `<host_url>/user/add-to-group`
  request
```
  [
    'user_id' => id,
    'group_id' => id
  ]  
```

* POST `<host_url>/user/remove-from-group/<user_id>/<group_id>`

* GET `<host_url>/user/list`
  response
```
  [
    'users' => [
      [
        'íd' => id,
        'name' => name,
      ]
    ]
  ]
```

* GET `<host_url>/group/list`
  response
```
  [
    'groups' => [
      [
        'íd' => id,
        'name' => name,
        'description' => description
      ]
    ]
  ]
```

* POST `<host_url>/group/create`
  request post
```
  [
    'name' => name,
    'description' => description
  ]
```

* POST `<host_url>/group/delete/<group_id>`

Next release task
-----------------
1. Add pagination for list actions /user/list and /group/list
2. Update and add unit tests 
3. Update input filters
4. Optimize database abstraction layer - optimize SQL queries