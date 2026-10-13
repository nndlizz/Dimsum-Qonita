```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});
```