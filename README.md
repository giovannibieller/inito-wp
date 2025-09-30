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

## Conventional Commits

This project uses [Conventional Commits](https://www.conventionalcommits.org/) specification for commit messages. Commits are automatically validated using commitlint.

### Commit Message Format

```
<type>[optional scope]: <description>

[optional body]

[optional footer(s)]
```

### Types

- **feat**: A new feature
- **fix**: A bug fix
- **docs**: Documentation only changes
- **style**: Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
- **refactor**: A code change that neither fixes a bug nor adds a feature
- **perf**: A code change that improves performance
- **test**: Adding missing tests or correcting existing tests
- **build**: Changes that affect the build system or external dependencies
- **ci**: Changes to our CI configuration files and scripts
- **chore**: Other changes that don't modify src or test files
- **revert**: Reverts a previous commit

### Examples

```bash
feat: add user authentication system
fix: resolve mobile navigation bug
docs: update installation instructions
style: format PHP files according to WordPress standards
refactor: simplify database query logic
perf: optimize image loading performance
test: add unit tests for user registration
build: update gulp configuration for Sass compilation
ci: add GitHub Actions workflow
chore: update dependencies
```

### Rules

- Subject line must be lowercase
- Subject line must not end with a period
- Subject line must be 50 characters or less
- Body and footer lines must be 72 characters or less

### Scripts

- `npm run commitlint:check` - Check the last commit message
- Test your commit message: `echo "feat: add new feature" | npx commitlint`
