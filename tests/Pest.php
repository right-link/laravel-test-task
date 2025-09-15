<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

/*
|--------------------------------------------------------------------------
| Pest Test Bootstrap
|--------------------------------------------------------------------------
|
| This file is automatically loaded by Pest. You can use it to set up
| global helpers, macros, or shared uses. Keep it minimal.
|
*/

uses(Tests\TestCase::class)->in('Feature');
uses(Illuminate\Foundation\Testing\RefreshDatabase::class)->in('Feature');
uses(Tests\TestCase::class)->in('Unit');
