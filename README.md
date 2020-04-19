# PHP - Custom MVC with Brad

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
