<?php

Route::get('/permissions',[App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');