<?php

Route::any('add','UserController::class',add);
Route::any('update','UserController::class',update);
Route::any('delete','UserController::class',delete);
Route::any('show','UserController::class',show);

