<?php

use App\Http\Controllers\cpanel\CpanelController;

Route::resource('/cpanel', CpanelController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->middleware(['auth','permission:manage cpanel accounts']);

