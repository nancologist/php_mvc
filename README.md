# PHP - Custom MVC with Brad

# RUN PROJECT:
1. ``cd /IdeaProjects/PHP/php_mvc``
2. ``$ docker run -p "80:80" -v ${PWD}/app:/app -v ${PWD}/mysql:/var/lib/mysql mattrayner/lamp:latest``
___
___
___

# 0. Tips
* ``declare(strict_types = 1);`` Activate this to use type in the language! 

* PHP Best Practices: https://odan.github.io/2018/04/05/php-best-practices.html

# Chapter 1: Course Intro & Setup
## 1.1. Welcome to the course
* We will be building a __custom MVC framework__ from the ground up.
* Once the framework is complete, we will build an application on top of it.

## 1.2. Project Files & Questions
## 1.3. XAMPP Environment setup
* This has PHP 7.4.4 inside it!

1. Install Xampp
2. Start the server and click on "Enable"
3. In the very root directory of mac ... in the level of Macintosh-HD you should now see a /lamp directory
4. find /htdocs and test it with a php file!

### Using Docker Image ``mattrayner/lamp`` instead of Xampp
1. https://hub.docker.com/r/mattrayner/lamp
2. ``$ docker pull mattrayner/lamp`` 
3. ``$ docker run -p "127.0.0.1:8585:80" -v ${PWD}/app:/app mattrayner/lamp:latest-1804``

    (Instead of http://127.0.0.1:8585 you can choose any other port.)
___

# Chapter 2: OOP
## 2.1. Destructor
Destructors get called when there is no other references to a particular object and this is usually for clean up and closing the connections to the databases.

Attention: Destructor gets called automatically when the object is not useful anymore!

* Magic constant ``\__Class\__``
___

## 2.2. Magic Methods: __get(PROP_NAME) & __set(PROP_NAME, VALUE)
* The ``__get()`` is kind of a dynamic getter for all props in the class which takes the name of the property and return the value of it if it exists.

* The ``__set()`` is also kind of a dynamic Setter for all props in a class.

## 2.3. Inheritance
* In PHP to inherit the Constructor of the Superclass in the Childclass we can use ``parent::__construct(args...)`` , this works like ``super()`` in JS or Java.

## 2.4. Static Methods and Properties
* Static props using ``self::STATIC_PROP``
* Static Props are independent of Objects of the class.
* Accessing the Static Prop of a class is also with double colon: ``CLASS_NAME::STATIC_PROP``
___
___
___

# Chapter 3: The Framework - The Core
## 3.1. What is MVC?
___

## 3.2. Workflow Explanation - PDO
URL Parameter Format in this project is going to be like this:

``example.com/url=ControllerClasName/MethodInController/ParamOfMethod``
___

## 3.3. Creating the Folder Structure
* After creating all these folders and files we can see them under ``localhost:8585/traversymvc/``

### .htaccess to Restrict Access
* Now we want that in this address that our ``src/`` be hidden, because it's not safe if everyone can see it. so for that :
    1. Create a file: ``.htaccess`` in ``src/``.
___

## 3.4. Direct Everything to index.php
So no matter what the user in the URL puts, we want them all get redirected to ``index.php``

### Mod_Rewrite
It's a PHP module which allows us to rewrite the URL. We will use this module inside a ``.htaccess`` file. 

### .htaccess
This is a file for Apache Directives.  
The LINE-7 makes our URLs look like this ``.com/post`` instead of ``.com/index.php?url=post`` , so it is actually the second one but it looks like prettier through this change.

### Test
Now If you type ".com/traverymvc/public/jklajfkjöa" you still goes to the .com/traversymvc/public/index.php

### Important
Since ``public/index.php`` is the entry point, what we need to do is ``require`` other files from our folder ``src/``  

Some people would pack all requirements inside the index.php but we will use bootstrap.php , it would be a lot neater!

### Statement ``require_once``
The ``require_once`` statement is identical to ``require``, except PHP will check if the file has already been included, and if so, not include (require) it again.
___

## 3.5. Bootstrap File & Core Class
1. If we now go to ``.com/traversymvc`` we get the pae with INDEX DIRECTORIES, but we don't want that it looks like that.

2. We want also to get rid of ``.com/traversymvc/public``

For this two goals we will also use ``.htaccess``

### Testing
Now after adding ``.htaccess`` when we enter ``.com/traversymvc/`` we are actually in ``.com/traversymvc/public``
___

### Conventions
1. Library file names and classes should start with Uppercase!
___

### Class ``Core``
#### Properties
* ``currentController`` : If there is no other controllers, it's going to load by default the Controller ``Pages``. So for example we go to the ``.com/traversymvc/`` and enter nothing after that, this will goes to the Page-Controller!

### Testing
Now when we enter ``.com/traversymvc/index.php?url=hallohelmut`` we get on the page "hallohelmut".

And thanks to the ``public/.htaccess`` LINE-7 now if we also enter ``.com/traversymvc/hallomorti`` we will also get the the "hallomorti" just like as we would have entered ``.com/traversymvc/index.php?url=hallomorti``.
___

## 3.6. Loading the Controller from the ULR
* Goal: if someone enters for example ``.com/traversymvc/post/edit/1`` we want to get an array of ``[post, edit, 1]`` and for that we use the ``explode()``

* ``rtrimt()`` : rtrim — Strip whitespace (or other characters) from the end of a string

* ``filter_var()`` : allows you to filter variables in certain ways. You can filter them as string or numbers.

* In ``Core.php`` LINE-20 : We define the path in ``fie_exists()`` as we were in the ``index.php``!

* ``ucwords()`` : This capitalize the first letter in a word, and we need it in ``Core.php`` for ``$controllerPath`` because the name of Controllers in the libraray are capitalized.

### Testing 1 (Getting URLs)
If you enter ``.com/traversymvc/post/edit/1`` you get an array of post, edit, 1. (Last Commit)

### Testing 2 (Load Controllers)
If you now enter ``.com/traversymvc/`` you will get ``Pages loaded``.

### Testing 3 (Load a Particular Controller)
If you now enter ``.com/traversymvc/post`` you will get the ``Post Controller is instantiated``
___

## 3.7. Mapping Methods & Parameters
### Goal
If someone enters ``.com/traversymvc/post/edit/1`` , the ``1`` should be the parameter for the method ``edit`` in the Controller class ``Post``.  
So our goal is to map the parameter and method in the URL to their methods in the Controllers.
___

* ``method_exists(CLASS, METHOD)``

## Testing 1 (Get 2nd Param in URL as Method Name)
So now if we enter ``.com/traversymvc/pages/about`` we get ``"about"`` on browser.
___

* ``call_user_func_array(CALLBACK_FUNC, PARAM_ARRAY)`` : Calls the callback function given by the first parameter with the parameters in param_arr.

    (In our cass the CALLBACK_FUNC is an array because we should also specify the class of the callback function)
    
## Testing 2 (Get Method Params)
Now if we enter ``.com/traversymvc/pages/about/23`` we get: ``Your ID is: 23``. 

___
___
___

# Chpater 4: The Framework - MVC Workflow

## 4.1. Base Controller Class
__TEST:__ Now if we go to the .com/traversymvc we should get "View does not exist!!!"
___

## 4.2. Loading Views
__TEST:__ Now if we go to .com/traversymvc/ we get the $data['title'] which we passed from Controller to the View in a H1-tag.
___

## 4.3. Config File & AutoLoader
We want to create a config file where we put our Env. Vars.

* ``define(CONST_NAME, VALUE)`` : We use the define() function to declare and assign a value to a constant at runtime.

* ``spl_autload_register()`` : We use this in bootstrap.php to not write rquire_once ... for every module in the library.
___

## 4.4. Header & Footer Includes
We want to create Header and Footer Files and then include them into the main Template.

You use ``APP_ROOT`` when you want address something which is in the backend (src/) and you would use ``URL_ROOT`` when you put something in your frontend (public/) and you want set the path to it, like main.js and style.css in this episode.

__TEST:__  
* Now we see that our .com/traversymvc/ has the title "Traversy MVC" 

* Test CSS: Now we see that at this route our background is red.

* JS TEST : alert(123)
___

## 4.5. Aside - PDO (PHP Data Object) Crash Course
Docs : https://www.php.net/manual/en/book.pdo.php

Our next task is to create our Database library so our php app can connect to our database, to do that we are going to use PDO (PHP Data Object)

PDO provides a Data Access Layer to execute Database Queries and Fetch data

__Our Goal:__ We want to use PDO to do our CRUD operations, but here we want to learn about PDO a bit so:

1. Go to http://127.0.0.1:8585/phpmyadmin/index.php
2. Use the Username & Password which received by running the Docker Image of Lamp.
3. Go to "Database"
4. Create a Database like called "pdo_test" (Set the drop down on "Collection")
5. In the database "pdo_test" create a table called "users"
6. "users" has fields like id, name , email, status
6. Create a use in the "usrers" table
7. Now we should create something called DSN (Database Source Name)

TEST: 
* If we go to http://127.0.0.1:8585/pdo_tutorial/ we should get a blank white page and it's good, because it shows that we have no errors. (Smoke Test: use a wrong $password)

Btw, PDO is very secure, so the clients can't easily do the SQL-Injections

### Named Parameter is a Protection Against SQL Injection
So in the index.php in LINE-15 the ``:status`` instead of a `` . $status`` is there to protect the code from code/sql injections.

TEST2: Now if we go to that ``.com/pdo_tutorial`` we get the name of our User!
___

## 4.6. The Database Class - Part 1
## 4.7. The Database Class - Part 2
## 4.8. Clean Up
___
___
___
