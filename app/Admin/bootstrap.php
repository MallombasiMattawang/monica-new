<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Facades\Admin;
use App\Admin\Actions;
use App\Admin\Extensions\Column\OpenMap;
use App\Admin\Extensions\Column\FloatBar;
use App\Admin\Extensions\Column\UrlWrapper;
use App\Admin\Extensions\Nav;
use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {

    $navbar->left(Nav\Shortcut::make([
        'Tabel Project' => 'form-import-project',
        'Tabel SAP' => 'form-import-sap',
        'Tabel Smilley' => 'form-import-smilley',
    ], 'fa-download')->title('Import Tabel'));

    $navbar->left(new Nav\Dropdown());

    $navbar->right(new Nav\Synchron())
        ->right(new Nav\AutoRefresh());
});

Encore\Admin\Form::forget(['map', 'editor']);
app('view')->prependNamespace('admin', resource_path('views/admin'));

Admin::css('/css/myadmin.css');
Admin::js('/js/myadmin.js');
