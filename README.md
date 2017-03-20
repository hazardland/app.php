This folder contains new simple app directory structure ready to copy and run

```php
/lib #contains common psr-4 autoloadable modules
     #\Namespace1\Namespace2\Class1 => ./lib/namespace1/src/Namespace2/Class1.php
/app #contains everything under \App namespace in src folder + app resource
    /src #contains everything under \App namespace \App\Controller\Home => ./app/src/Controller/Home.php
    /public #contains what is exposed in wwwroot
        index.php #app entry point
    /views #contains app views
    /config #contains app specific config
        /localhost #contains 'locahlost' env config
            config.php #included by app.php using ./config/SERVER/config.php
        /env1 #contains some env1 config
            config.php
    app.php #setups your project env, included by index.php
    server.php #sets env const SERVER, included by app.php
    routes.php #contains app routes
```
When cloning use ```--recursive``` option to clone with all submodules
```
git clone git@github.com:hazardland/app.php.git ./app --recursive
```
But then you will need to ```checkout master``` branch still in every submodule for the first time.

In case of multi app solution you can have common config alongside app configs something like this:
```php
    /config
    /lib
    /app1
        /config
    /app2
        /config
    /app3
        /config
```
