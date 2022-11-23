<?php 

namespace App\Console;

use \App\Interface\RedisDependency;

class Schedule extends ScheduleDependency {

    private function run(RedisDependency $redisDependency) {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    } 

    public function exe() {
        $classesForSchedule = $this->dependencyClassesForSchedule();
        foreach($classesForSchedule as $class) {
            $this->run($class);
        }
    }
}   