#!/bin/bash

# Script to rename "INITO WP | Starter Theme" and "inito-wp-theme" throughout the project
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

# Function to sanitize text for slug/identifier usage
sanitize_for_slug() {
    local text="$1"
    # Convert to lowercase, replace spaces and special chars with hyphens, remove multiple hyphens
    echo "$text" | tr '[:upper:]' '[:lower:]' | sed 's/[^a-z0-9]/-/g' | sed 's/-\+/-/g' | sed 's/^-\|-$//g'
}

# Welcome message
echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}    INITO WP Theme Rename Script${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""

# Get the current theme name and slug
CURRENT_NAME="INITO WP | Starter Theme"
CURRENT_SLUG="inito-wp-theme"
print_status "Current theme name: ${YELLOW}${CURRENT_NAME}${NC}"
print_status "Current theme slug: ${YELLOW}${CURRENT_SLUG}${NC}"

# Prompt for new theme name
echo ""
read -p "Enter the new theme name: " NEW_NAME

# Validate input
if [ -z "$NEW_NAME" ]; then
    print_error "Theme name cannot be empty!"
    exit 1
fi

# Generate sanitized slug
NEW_SLUG=$(sanitize_for_slug "$NEW_NAME")

# Show generated slug and allow customization
echo ""
print_status "Generated theme slug: ${GREEN}${NEW_SLUG}${NC}"
read -p "Press Enter to use this slug, or type a custom slug: " CUSTOM_SLUG

if [ ! -z "$CUSTOM_SLUG" ]; then
    NEW_SLUG=$(sanitize_for_slug "$CUSTOM_SLUG")
    print_status "Using custom slug: ${GREEN}${NEW_SLUG}${NC}"
fi

# Confirm the change
echo ""
print_warning "This will replace all occurrences of:"
echo -e "  Theme Name - FROM: ${RED}${CURRENT_NAME}${NC}"
echo -e "  Theme Name - TO:   ${GREEN}${NEW_NAME}${NC}"
echo -e "  Theme Slug - FROM: ${RED}${CURRENT_SLUG}${NC}"
echo -e "  Theme Slug - TO:   ${GREEN}${NEW_SLUG}${NC}"
echo ""
print_warning "Files that will be modified:"
echo "  - package.json (name and themeName)"
echo "  - package-lock.json (name)"
echo "  - style.css (theme name and text domain)"
echo "  - manifest.json (name and short_name)"
echo "  - functions.php (text domain)"
echo "  - README.md (title)"
echo ""

read -p "Are you sure you want to proceed? (y/N): " CONFIRM

if [[ ! $CONFIRM =~ ^[Yy]$ ]]; then
    print_status "Operation cancelled."
    exit 0
fi

echo ""
print_status "Starting theme rename process..."

# Function to replace text in file
replace_in_file() {
    local file="$1"
    local old_text="$2"
    local new_text="$3"
    local description="$4"
    
    if [ -f "$file" ]; then
        # Use sed to replace the text (macOS compatible) - using @ as delimiter to avoid conflicts with |
        if sed -i '' "s@${old_text}@${new_text}@g" "$file" 2>/dev/null; then
            print_success "Updated: $file ($description)"
        else
            print_error "Failed to update: $file ($description)"
        fi
    else
        print_warning "File not found: $file"
    fi
}

# Replace theme names
replace_in_file "package.json" "$CURRENT_NAME" "$NEW_NAME" "theme name in themeName field"
replace_in_file "style.css" "$CURRENT_NAME" "$NEW_NAME" "theme name in header"
replace_in_file "manifest.json" "$CURRENT_NAME" "$NEW_NAME" "app name"
replace_in_file "README.md" "$CURRENT_NAME" "$NEW_NAME" "title"

# Replace theme slugs/identifiers
replace_in_file "package.json" "$CURRENT_SLUG" "$NEW_SLUG" "package name"
replace_in_file "package-lock.json" "$CURRENT_SLUG" "$NEW_SLUG" "package name"
replace_in_file "style.css" "$CURRENT_SLUG" "$NEW_SLUG" "text domain"
replace_in_file "manifest.json" "$CURRENT_SLUG" "$NEW_SLUG" "short name"
replace_in_file "functions.php" "$CURRENT_SLUG" "$NEW_SLUG" "text domain"

echo ""
print_success "Theme rename completed!"
print_status "New theme name: ${GREEN}${NEW_NAME}${NC}"
print_status "New theme slug: ${GREEN}${NEW_SLUG}${NC}"

# Show summary of changes
echo ""
print_status "Summary of changes:"
echo -e "${YELLOW}Theme Name Changes:${NC}"

# Files that should contain the new theme name
NAME_FILES=("package.json" "style.css" "manifest.json" "README.md")
for file in "${NAME_FILES[@]}"; do
    if [ -f "$file" ]; then
        if grep -q "$NEW_NAME" "$file" 2>/dev/null; then
            echo "  ✓ $file"
        else
            echo "  ✗ $file (no changes detected)"
        fi
    fi
done

echo -e "${YELLOW}Theme Slug Changes:${NC}"

# Files that should contain the new theme slug
SLUG_FILES=("package.json" "package-lock.json" "style.css" "manifest.json" "functions.php")
for file in "${SLUG_FILES[@]}"; do
    if [ -f "$file" ]; then
        if grep -q "$NEW_SLUG" "$file" 2>/dev/null; then
            echo "  ✓ $file"
        else
            echo "  ✗ $file (no changes detected)"
        fi
    fi
done

echo ""
print_status "Don't forget to:"
echo "  1. Update any other references in your code"
echo "  2. Test your WordPress theme"
echo "  3. Update documentation if needed"
echo "  4. Clear any caches (npm, WordPress, etc.)"
echo "  5. Update translation files in /lang/ directory if needed"

echo ""
print_success "Script completed successfully!"
