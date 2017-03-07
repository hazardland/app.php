This folder contains new simple app directory structure ready to copy and run

/common - contains common modules between projects
/project - contains project specific modules if any
/public - contains what is exposed in wwwroot
/config - contains environment specific config files (development,production)

When cloning use ```--recursive``` option to clone with all submodules
```
git clone git@github.com:hazardland/project.php.git ./project --recursive
```
But then you will need to ```checkout master``` branch in every submodule for the first time.