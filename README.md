# INITO WP | Starter Theme

## Install dependencies

```
#!javascript

npm install
```

## Run DEV SERVER with WP-ENV

```
#!javascript

npm start
```

## Run Assets Watch Compiler without WP-ENV

```
#!javascript

gulp watch
```

Watch mode will control changes on `scss` and `js` files

## ACF SEO Fields import

You can find the JSON to import in `/imports` folder.
SEO imports are used for POST, PAGE, TAXONOMY

## Build project

```
#!javascript

npm run build
```

After the build command a new /dist folder will be created with: css, img, ico, js directories inside.
On deployment you can avoid /assets /node_modules directories.
