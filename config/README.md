This folder contains config files for varios environment.
Current environment is determined by ```SERVER``` constant.

More often you will run in situations that same code must work on different servers and only changing ```SERVER``` constant  value must deal with configuration differences.
Environment can be for example ```'devel'```, ```'production'```, ```'localhost'```, ```'bluehost'``` or anything.

Also there situations when system administrator wants to make you aware database connection credentials and makes this files hidden from you.

By default config folder uses following structure:

./config
	/localhost
		database
			default.php - a default database connection setup

When you first time try to access default database by:
```php
	Database::get()->query("SELECT 1");
```
Database class will try to include ./config/localhost/database/default.php.
In whic must be:
```
	Database::add(new PDO(...),'default');
```