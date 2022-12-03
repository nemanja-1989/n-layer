<?php 

namespace App\Containers;

use Psr\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;

class AppContainer implements ContainerInterface {

    protected array $instances = [];

    public function get(string $id) {
        if($this->has($id)) {
            return $this->instance[$id];
        }
        $instance = $this->createObject($id);
        $this->instances[$id] = $instance;
        return $instance;
    }

    public function has(string $id) :bool {

        return isset($this->instances[$id]);
    }

    public function createObject($className) {

        if(!class_exists($className)) {
            throw new \Exception("Class {$className} doesnt exists!");
        }
        $reflectionClass = new ReflectionClass($className);
        if($reflectionClass->getConstructor() === null) {
            return new $className;
        }
        $parameters = $reflectionClass->getConstructor()->getParameters();
        $dependencies = $this->dependencies($parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function dependencies($parameters) {

        $dependencies = [];
        foreach($parameters as $parameter) {
            $dependencies[] = $this->createObject($parameter->getClass()->getName());
        }
        return $dependencies;
    }
}