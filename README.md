User Management Prototype
=========================
Info
----
This is simple prototype to represent mine point of view how to architect a software. 
Case study is a REST system to manage user and groups.

Installation
------------

1. To get all vendor dependencies download composer from https://getcomposer.org/download/ 
   (Manual Download, composer.phar) and then run "php composer.phar install"
2. Prototype is build over Zend Framework and PHP. Please check "composer.json" for 
   all dependencies and correct versions

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (2.4.*)
* [PHP](https://secure.php.net/downloads.php) (7.0.*)

Database model
--------------
* Prototype of the database in data folder

API calls
----------------------
* description in doc/API_CALLS.md

Domain workflow
----------------------
* description in doc/DOMAIN_WORKFLOW.md

Next release task
-----------------
1. Add pagination for list actions /user/list and /group/list
2. Update and add unit tests 
3. Update input filters
4. Optimize database abstraction layer - optimize SQL queries
