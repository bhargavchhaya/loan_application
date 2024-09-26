<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = config('repository.repositories', []);
        // Loop through array
        foreach ($repositories as $contract => $repository) {
            // Check if repository is array => loop through inner array
            if (is_array($repository) && !empty($repository)) {
                foreach ($repository as $repo) {
                    // Bind Interfact to a Class
                    $this->app->bind($contract, $repo);        
                }
            } else {
                // Bind Interfact to a Class
                $this->app->bind($contract, $repository);
            }
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
