<?php 

namespace App\Console;

use App\Interface\FastCacheDependency;
use \App\Interface\RedisDependency;

class Schedule extends ScheduleDependency {

    /**
     * @param RedisDependency $redisDependency
     * @return void
     */
    private function runRedis(RedisDependency $redisDependency) :void {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    /**
     * @param FastCacheDependency $fastCacheDependency
     * @return void
     */
    private function runFastCache(FastCacheDependency $fastCacheDependency) :void {
        $fastCacheDependency->fastCacheDependencyClassesMethodsForCaching();
    }

    /**
     * @return void
     */
    private function exeRedis() {
        foreach($this->dependencyClassesForScheduleRedis() as $class) {
            $this->runRedis($class);
        }
    }

    /**
     * @return void
     */
    private function exeFastCache() {
        foreach($this->dependencyClassesForScheduleFastCache() as $class) {
            $this->runFastCache($class);
        }
    }

    /**
     * @return void
     */
    public function exe() :void {
        $this->exeRedis();
        $this->exeFastCache();
    }
}   