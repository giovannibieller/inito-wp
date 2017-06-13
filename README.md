# wordpress boilerplate theme #

## Install dependencies ##

```
#!javascript

npm install
```

## Run Dev Server ##

```
#!javascript

gulp watch
```
Watch mode will control changes on ```scss``` and ```js``` files


## Build project ##

```
#!javascript

gulp dist
```
After the build command a new /dist folder will be created with: css, img, ico, js directories inside.
On deployment you can avoid /assets /node_modules directories.