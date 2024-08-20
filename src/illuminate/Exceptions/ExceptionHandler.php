<?php namespace Illuminate\Exceptions;

use eftec\bladeone\BladeOne;

class ExceptionHandler {

    public function __construct() {
        set_exception_handler(function(\Throwable $exception){
            $blade = new BladeOne('illuminate/View/Views', APP['cache_views_dir']);
            echo $blade->run('errors.error500', ['exception' => $exception, 'debug' => APP['debug']]);

            //throw $exception;
        });    
    }
}