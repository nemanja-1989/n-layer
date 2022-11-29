<?php 

namespace App\Console;

use \App\Interface\RedisDependency;

class Schedule extends ScheduleDependency {

    /**
     * @param RedisDependency $redisDependency
     * @return void
     */
    private function run(RedisDependency $redisDependency) :void {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    /**
     * @return void
     */
    public function exe() :void {
        $classesForSchedule = $this->dependencyClassesForSchedule();
        foreach($classesForSchedule as $class) {
            $this->run($class);
        }
    }
}   