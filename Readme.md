# Livewire Toasts

This package allows you to dynamically display toasts notifications via Laravel Livewire components. Toasts are powered by AlpineJS and are displayed without any delay.

## Documentation

- [Livewire Toasts](#livewire-toasts)
  - [Documentation](#documentation)
  - [Requirements](#requirements)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Livewire Component Setup](#livewire-component-setup)
    - [Showing Toasts](#showing-toasts)
  - [Publishing Assets](#publishing-assets)
    - [Custom View](#custom-view)

## Requirements

- AlpineJS version 3.0 or higher

## Installation

You can install the package via composer:

```console
composer require aliowa/livewire-toasts
```

Add the `x-aliowa-livewire-toasts` component to your app layout view:

```html
<body>
  <!-- body here -->
  
  <x-aliowa-livewire-toasts />
</body>
```

By default toasts are styled with TailwindCSS. To autodiscover necessary classes, either [publish toasts views](#custom-view) or add package views location to your `tailwind.config.js` file:

```js
module.exports = {
    content: [
        './vendor/aliowa/**/views/**/*.blade.php',
    ],
```

## Usage

### Livewire Component Setup

Add `Toastable` trait to your livewire component:

```php
<?php

namespace App\Http\Livewire;

use Aliowa\LivewireToasts\Traits\Toastable;
use Livewire\Component;

class SavePost extends Component
{
    use Toastable;

    //component code
}
```

### Showing Toasts

Show a toast providing a message to one of four methods `toastSuccess`, `toastWarning`, `toastDanger`, `toastInfo`:

```php
public function savePost()
{
    $this->toastSuccess('Post has been successfully saved!');

    $this->toastWarning('You have reached the daily post limit!');

    $this->toastDanger('Post has not been saved!');

    $this->toastInfo('A confirmation email has been sent');
}
```

## Publishing Assets

### Custom View

By default toasts view file uses TailwindCSS, but you can publish and change the way toasts will look on your website.

```console
php artisan vendor:publish --tag=aliowa-livewire-toasts:views
```

Now edit the view file `resources/views/vendor/components/aliowa/livewire-toasts/components/toasts.blade.php`. The package will use this view to render the component.