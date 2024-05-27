<?php

use Illuminate\Support\HtmlString;

if (!function_exists('vite_assets')) {
    /**
     * Get Vite assets for the current environment.
     *
     * @return HtmlString
     */
    function vite_assets(): HtmlString
    {
        if (app()->environment('local')) {
            return getDevServerAssets();
        }

        return getProductionAssets();
    }

    /**
     * Get assets for the development environment.
     *
     * @return HtmlString
     */
    function getDevServerAssets(): HtmlString
    {
        try {
            $devServerUrl = file_get_contents(public_path('hot'));

            if (str_contains($devServerUrl, '127.0.0.1')) {
                return new HtmlString(<<<HTML
                    <script type="module" src="$devServerUrl/@vite/client"></script>
                    <script type="module" src="$devServerUrl/resources/js/app.js"></script>
                HTML);
            }
        } catch (Exception) {
        }

        return new HtmlString('');
    }

    /**
     * Get assets for the production environment.
     *
     * @return HtmlString
     */
    function getProductionAssets(): HtmlString
    {
        $manifestPath = public_path('dist/manifest.json');

        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);

            if (isset($manifest['resources/js/app.js']['file']) && isset($manifest['resources/js/app.js']['css'][0])) {
                return new HtmlString(<<<HTML
                    <script type="module" src="/dist/{$manifest['resources/js/app.js']['file']}"></script>
                    <link rel="stylesheet" href="/dist/{$manifest['resources/js/app.js']['css'][0]}">
                HTML);
            }
        }

        return new HtmlString('');
    }
}
