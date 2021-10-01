<?php

Route::get('/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
Route::get('/roles/create',[App\Http\Controllers\RoleController::class, 'store'])->name('role.store');