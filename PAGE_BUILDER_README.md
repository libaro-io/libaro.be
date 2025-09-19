# Page Builder Implementation

This document explains the page builder functionality that has been added to the Project form in the Filament admin panel.

## Overview

The page builder allows you to add dynamic blocks to projects, with different block types that have their own specific fields.

## Block Types

### 1. Image with Text

-   **Fields**: Image, Title, Text
-   **Purpose**: Display an image alongside text content
-   **Use case**: Hero sections, feature highlights, content blocks

### 2. Image Full Width

-   **Fields**: Image only
-   **Purpose**: Display a full-width image
-   **Use case**: Banners, full-width visuals, separators

## Database Structure

The page builder uses a `blocks` table with the following structure:

-   `id`: Primary key
-   `project_id`: Foreign key to the projects table (showcases)
-   `type`: Block type ('image_with_text' or 'image_full_width')
-   `content`: JSON field storing block-specific data
-   `order`: Integer for ordering blocks
-   `created_at` / `updated_at`: Timestamps

## Usage in Filament

1. Navigate to the Projects section in your Filament admin panel
2. Create or edit a project
3. Scroll down to the "Blocks" section
4. Click "Add Block" to create a new block
5. Select the block type from the dropdown
6. Fill in the required fields based on the selected type
7. Set the order number to control the display sequence
8. Save the project

## Technical Implementation

### Models

-   `Block`: Handles individual block data and relationships
-   `Project`: Updated with blocks relationship

### Form Components

-   Repeater component for managing multiple blocks
-   Dynamic field visibility based on block type
-   File upload for images with proper storage configuration

### Features

-   Drag and drop reordering of blocks
-   Collapsible block interface
-   Type-specific field validation
-   Image storage in public disk under 'blocks' directory

## File Structure

```
app/
├── Models/
│   ├── Block.php (new)
│   └── Project.php (updated)
├── Filament/Resources/Projects/Schemas/
│   └── ProjectForm.php (updated)
database/
├── migrations/
│   └── 2025_01_20_000000_create_blocks_table.php (new)
└── factories/
    ├── ProjectFactory.php (new)
    └── ClientFactory.php (new)
tests/Unit/
└── BlockTest.php (new)
```

## Migration

To apply the database changes, run:

```bash
php artisan migrate
```

## Testing

Run the block tests with:

```bash
php artisan test tests/Unit/BlockTest.php
```
