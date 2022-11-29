<?php 

namespace App\Interface;

interface RedisDependency {
    /**
     * @return mixed
     */
    public function redisDependencyClassesMethodsForCaching();
}