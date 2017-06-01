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
Dev server will listen to [http://localhost:3000](http://localhost:3000) and **Hot Reloading** will be active on save


## Build project ##

```
#!javascript

gulp dist
```
After the build command a new /dist folder will be created with: css, img, ico, js directories inside.
On deployment you can avoid /assets /node_modules directories.