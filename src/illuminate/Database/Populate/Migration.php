<?php namespace Illuminate\Database\Populate;

interface Migration {

    public function up(): void;

    public function down(): void;
    public function truncate(): void;
    public function seed(): void;
    
}