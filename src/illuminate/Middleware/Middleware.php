<?php namespace Illuminate\Middleware;

interface Middleware {
    
    public function validate($request): bool;

}