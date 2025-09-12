# INITO WP | Starter Theme

## Init project with Custom Name

```
#!javascript

npm run init
```

It will prompt for a name creating:

1. Name for the theme + manifest + style.css
2. Sanitized slug for the theme + manifest + style.css

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

## Customize Editor Theme

You can customize colors and font sizes of the editor theme changing the `theme.json` file in the root of the project.

## Build project

```
#!javascript

npm run build
```

After the build command a new /dist folder will be created with: css, img, ico, js directories inside.
On deployment you can avoid /assets /node_modules directories.
