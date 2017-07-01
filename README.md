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

## Favicons generator using RealFaviconGenerator ##
```
#!javascript

gulp favicons
```
Task bound in ```dist``` task too.  
Generate favicons starting from image in ```/assets/img/favicon/base.png``` size ```300x300 px```

## Build project ##

```
#!javascript

gulp dist
```
After the build command a new /dist folder will be created with: css, img, ico, js directories inside.
On deployment you can avoid /assets /node_modules directories.