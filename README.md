# PHP - Custom MVC with Brad

# 0. Tips
* ``declare(strict_types = 1);`` Activate this to use type in the language! 

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

## 3.6. Loading the Controller from the ULR
___
___
___