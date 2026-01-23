#!/bin/bash

# Script to export WordPress data from wp-env
# - Exports database
# - Copies uploads, plugins, and languages folders
# Author: Giovanni Bieller

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Get the theme name from the current directory
THEME_NAME=$(basename "$PWD")

CURRENT_DATE=$(date +%Y%m%d_%H%M%S)
BASE_DIR="../${THEME_NAME}_porting"
EXPORT_DIR="${BASE_DIR}/${CURRENT_DATE}"

# Welcome message
echo -e "${BLUE}============================================${NC}"
echo -e "${BLUE}    WP-ENV Data Export Script${NC}"
echo -e "${BLUE}============================================${NC}"
echo ""

# Check if wp-env is running
print_status "Checking if wp-env is running..."

# Check if WordPress containers are running
RUNNING_CONTAINERS=$(docker ps --filter "name=wordpress" --filter "ancestor=wordpress" -q)
if [ -z "$RUNNING_CONTAINERS" ]; then
    print_error "wp-env doesn't seem to be running. Please start it with 'npm run wp-env start' first."
    exit 1
fi

print_success "wp-env is running"
echo ""
 d
# Create export directory
print_status "Creating export directory: $EXPORT_DIR"
mkdir -p "$EXPORT_DIR"
print_success "Export directory created"
echo ""

# Get the WordPress container ID first
print_status "Getting WordPress container information..."
CONTAINER_ID=$(docker ps --filter "name=wordpress" --filter "ancestor=wordpress" -q | head -n 1)

if [ -z "$CONTAINER_ID" ]; then
    print_error "Could not find WordPress container. Make sure wp-env is running."
    exit 1
fi

print_success "Found WordPress container: $CONTAINER_ID"
echo ""

# Copy uploads folder
print_status "Copying uploads folder..."
UPLOADS_DIR="${EXPORT_DIR}/uploads"
mkdir -p "$UPLOADS_DIR"

if docker cp "${CONTAINER_ID}:/var/www/html/wp-content/uploads/." "$UPLOADS_DIR/"; then
    print_success "Uploads folder copied"
else
    print_warning "Failed to copy uploads folder (it might be empty)"
fi
echo ""

# Copy plugins folder
print_status "Copying plugins folder..."
PLUGINS_DIR="${EXPORT_DIR}/plugins"
mkdir -p "$PLUGINS_DIR"

if docker cp "${CONTAINER_ID}:/var/www/html/wp-content/plugins/." "$PLUGINS_DIR/"; then
    print_success "Plugins folder copied"
else
    print_warning "Failed to copy plugins folder"
fi
echo ""

# Copy languages folder
print_status "Copying languages folder..."
LANGUAGES_DIR="${EXPORT_DIR}/languages"
mkdir -p "$LANGUAGES_DIR"

if docker cp "${CONTAINER_ID}:/var/www/html/wp-content/languages/." "$LANGUAGES_DIR/"; then
    print_success "Languages folder copied"
else
    print_warning "Failed to copy languages folder (it might not exist)"
fi
echo ""

# Build the theme
print_status "Building the theme..."
if npm run build > /dev/null 2>&1; then
    print_success "Theme built successfully"
else
    print_error "Failed to build theme"
    exit 1
fi
echo ""

# Copy theme files
print_status "Copying theme files..."
THEMES_DIR="${EXPORT_DIR}/themes"
THEME_TARGET_DIR="${THEMES_DIR}/${THEME_NAME}"
mkdir -p "$THEME_TARGET_DIR"

# Use rsync to copy files while excluding specific items
rsync -a --progress \
    --exclude='robots.txt' \
    --exclude='php.ini' \
    --exclude='package.json' \
    --exclude='package-lock.json' \
    --exclude='gulpfile.mjs' \
    --exclude='comments.php' \
    --exclude='README.md' \
    --exclude='.wp-env.json' \
    --exclude='.nvmrc' \
    --exclude='.gitignore' \
    --exclude='.commitlintrc.json' \
    --exclude='.babelrc' \
    --exclude='.DS_Store' \
    --exclude='node_modules/' \
    --exclude='scripts/' \
    --exclude='imports/' \
    --exclude='htaccess/' \
    --exclude='docs/' \
    --exclude='pwa/' \
    --exclude='assets/' \
    --exclude='.husky/' \
    --exclude='.github/' \
    --exclude='.git/' \
    ./ "$THEME_TARGET_DIR/" 2>/dev/null

if [ $? -eq 0 ]; then
    print_success "Theme files copied"
else
    print_error "Failed to copy theme files"
    exit 1
fi
echo ""

# Prompt for destination domain
echo ""
echo -e "${BLUE}============================================${NC}"
echo -e "${BLUE}    Database Export & Domain Replacement${NC}"
echo -e "${BLUE}============================================${NC}"
echo ""
print_status "Please enter the destination domain (e.g., giovannibieller.dev):"
read -r DESTINATION_DOMAIN

if [ -z "$DESTINATION_DOMAIN" ]; then
    print_error "No domain provided. Exiting."
    exit 1
fi

print_success "Destination domain set to: $DESTINATION_DOMAIN"
echo ""

# Export database
print_status "Exporting database..."
TEMP_DB_FILE="database_export.sql"
DB_FILE="${EXPORT_DIR}/database_${CURRENT_DATE}.sql"

# Export database inside the container
if wp-env run cli wp db export "$TEMP_DB_FILE" > /dev/null 2>&1; then
    # Copy the exported database from the container
    if docker cp "${CONTAINER_ID}:/var/www/html/${TEMP_DB_FILE}" "$DB_FILE"; then
        print_success "Database exported"
        # Clean up the temporary file in the container
        docker exec "$CONTAINER_ID" rm -f "/var/www/html/${TEMP_DB_FILE}" > /dev/null 2>&1
    else
        print_error "Failed to copy database file from container"
        exit 1
    fi
else
    print_error "Failed to export database"
    exit 1
fi
echo ""

# Replace localhost:8888 with destination domain
print_status "Replacing localhost:8888 with $DESTINATION_DOMAIN..."

# Create a temporary file for sed operations
TEMP_SQL="${DB_FILE}.tmp"

# Perform replacements in the correct order
# 1. Replace localhost:8888 URLs with destination domain (https)

Modifica Modifica
Copia Copia
Elimina Elimina
3
home
https://www.bcp.glueglue.dev
on

Modifica Modifica
Copia Copia
Elimina Elimina
2
siteurl
https://www.bcp.glueglue.dev
on
# 2. Replace protocol-relative URLs
# 3. Remove :8888 ports
# 4. Remove trailing slashes from all URLs
sed -e "s|https://localhost:8888|https://${DESTINATION_DOMAIN}|g" \
    -e "s|http://localhost:8888|https://${DESTINATION_DOMAIN}|g" \
    -e "s|//localhost:8888|//${DESTINATION_DOMAIN}|g" \
    -e "s|localhost:8888|${DESTINATION_DOMAIN}|g" \
    -e "s|:8888||g" \
    -e "s|https://${DESTINATION_DOMAIN}/\([\"']\)|https://${DESTINATION_DOMAIN}\1|g" \
    -e "s|https://${DESTINATION_DOMAIN}/\([^[:alnum:]]\)|https://${DESTINATION_DOMAIN}\1|g" \
    "$DB_FILE" > "$TEMP_SQL"

# Replace original file with the modified one
mv "$TEMP_SQL" "$DB_FILE"

print_success "Domain replacement completed"
echo ""

# Summary
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}    Export Complete!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo "Export location: $EXPORT_DIR"
echo ""
echo "Contents:"
echo "  - Theme: themes/${THEME_NAME}/"
echo "  - Database: $(basename "$DB_FILE") (localhost:8888 → $DESTINATION_DOMAIN)"
echo "  - Uploads: uploads/"
echo "  - Plugins: plugins/"
echo "  - Languages: languages/"
echo ""
print_success "All data has been exported successfully!" 