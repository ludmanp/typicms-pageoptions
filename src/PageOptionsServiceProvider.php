<?php

namespace TypiCMS\Modules\PageOptions;

use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TypiCMS\Modules\Core\Models\Page;
use TypiCMS\Modules\PageOptions\Components\AdminForm;
use TypiCMS\Modules\PageOptions\Components\File;
use TypiCMS\Modules\PageOptions\Components\Image;
use TypiCMS\Modules\PageOptions\Composers\PageTemplateOptionsComposer;
use TypiCMS\Modules\PageOptions\Composers\PublicPageOptionsComposer;
use TypiCMS\Modules\PageOptions\Models\PageOption;
use TypiCMS\Modules\PageOptions\Observers\PageoptionsArrayObserver;
use TypiCMS\Modules\PageOptions\Observers\PageOptionsObserver;

class PageOptionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('page-options')
            ->hasViews()
            ->hasMigration('create_page_options_table')
            ->hasViewComposer('page-options::admin.*', PageTemplateOptionsComposer::class)
            ->hasViewComposer('pages::public.*', PublicPageOptionsComposer::class)
            ->hasViewComponents('pageoptions', Image::class, File::class, AdminForm::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations();

            });
    }

    public function packageBooted()
    {
        parent::packageBooted();

        Page::observe(new PageOptionsObserver());
        PageOption::observe(new PageoptionsArrayObserver());
    }
}
