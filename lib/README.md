Common modules go here
This folder can be placed anywhere on server and can be common for many projects

You can also use composer and leave this dir behind

Note: All libraries must be PSR-4 in order to be autoincluded.
How PSR-4 namespaced class is transleted to path by default:
Class: \Namespace1\Namespace2\Class1
Path: namespace1\src\Namespace2\Class1.php
Where first namespace name is translated to lower case
Then follows src
Then follows case sencetive names of classes and namespaces
Do not like it? Go change php-fig community standadts for psr-4 module
