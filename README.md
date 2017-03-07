This folder contains new simple app directory structure ready to copy and run

/lib - contains common psr-4 modules
/app - contains everything under \App namespace in src folder + app resource
/public - contains what is exposed in wwwroot
/config - contains environment specific config files (development,production)

When cloning use ```--recursive``` option to clone with all submodules
```
git clone git@github.com:hazardland/app.php.git ./app --recursive
```
But then you will need to ```checkout master``` branch still in every submodule for the first time.
