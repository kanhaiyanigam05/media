# 📁 Media Uploader for Laravel

**Image Uploader** is a flexible Laravel package designed to simplify image uploading and management within your project. It supports both single and multiple image uploads and includes a built-in **media gallery Blade component** that allows users to browse and select previously uploaded media assets.

---

## ✨ Features

- ✅ Upload single or multiple images with ease  
- 🖼️ Select images from an organized, reusable media gallery  
- 🔁 Reuse previously uploaded images or videos across your project  
- 🧩 Plug-and-play Blade component for quick UI integration  
- 🔧 Easily customizable through component properties  

---

## 📦 Installation

### Step 1: Register the Repository

Before installation, add the following code to your `composer.json` file to register the custom GitHub repository:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/kanhaiyanigam05/media.git",
        "name": "kanhaiyanigam05/media"
    }
],
```

### Step 2: Require the Package

Run the following command to install the package:

```bash
composer require kanhaiyanigam05/media:"dev-main"
```

### Step 3: Publish the Package Assets

After installation, publish the service provider's assets using:

```bash
php artisan vendor:publish --provider="Media\MediaServiceProvider"
```

After publishing, the following assets will be available:

- **Media assets:** `public/media-assets/*`
- **Components:** `resources/views/components/`
- **Modals:** `resources/views/modal/*`

### Step 4: Run Migrations

To create the necessary database tables for managing media, run:

```bash
php artisan migrate
```

---

## 🧩 Blade Integration

To ensure your layout supports the media uploader’s styles and scripts, include the following Blade stack directives in your layout file (typically `resources/views/layouts/app.blade.php` or `admin.blade.php`):

- `@stack('css')` – Add this in the `<head>` section, **after** your main stylesheets.
- `@stack('models')` – Place this at the **end of your footer**, just after the closing `footer` section, to include media modals.
- `@stack('js')` – Add this near the end of the `<body>`, **after** your main JavaScript files.

---

## 🧱 Usage

### Basic Image Upload and Selection

Use the following Blade component to integrate the media uploader into your view:

```blade
<x-media />
```

This component handles the entire media upload and selection workflow, including modals and previews.

---

## ⚙️ Customization

The Blade component supports several props to control its behavior and layout:

| Prop         | Type     | Description                                                                 |
|--------------|----------|-----------------------------------------------------------------------------|
| `name`       | string   | The input name used during form submission                                  |
| `label`      | string   | Optional label text shown above the component (default: "Image")            |
| `type`       | string   | Media type: `image` or `video` (default: `image`)                           |
| `multiple`   | boolean  | Whether to allow multiple uploads or selections (default: `false`)          |
| `image`      | string   | A single preloaded image path to show in the component                      |
| `images`     | array    | An array of preloaded images to show when multiple selection is enabled     |
| `columns`    | string   | Bootstrap column classes to control media grid layout (default: `col-lg-2 col-md-3 col-4`) |

---

## 📂 Example

### Blade View

```blade
<x-image-uploader 
    name="image" 
    label="Slider" 
    :image="$contents->image" 
    columns="col-lg-6 col-12" 
/>
```

### Controller

```php
$content->image = $request->input('image');
```

This saves the selected image path into the model during form submission.

---

## 📄 License

This package is open-source and distributed under the [MIT License](https://opensource.org/licenses/MIT).  
Feel free to use, modify, and contribute to the project.
