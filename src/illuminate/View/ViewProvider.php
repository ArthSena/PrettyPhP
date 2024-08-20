<?php 

use eftec\bladeone\BladeOne;

/**
 * Renders a BladeOne template and returns the rendered output.
 *
 * @param string $path The path to the BladeOne template file, relative to the views directory.
 * @param array $variables An associative array of variables to be passed to the template.
 *
 * @return string The rendered output of the BladeOne template.
 */
function view($path, $variables = []): string {
    $blade = new BladeOne(APP['views_dir'], APP['cache_views_dir']);
    return $blade->run($path, $variables);
}