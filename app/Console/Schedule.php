<?php 

namespace App\Console;

use \App\Interface\RedisDependency;

class Schedule extends ScheduleDependency {

    public function run(RedisDependency $redisDependency) {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    } 

    public function exe() {
        $classesForSchedule = $this->dependencyClassesForSchedule();
        foreach($classesForSchedule as $class) {
            $this->run($class);
        }
    }
}   