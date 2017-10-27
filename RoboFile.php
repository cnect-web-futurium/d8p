<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
use D8P\Robo\Tasks as D8PTasks;

/**
 * Class RoboFile.
 */
class RoboFile extends D8PTasks {

  /**
   * Say Hello!
   *
   * @param string $world
   *   Say hello to this.
   */
  public function hello($world) {
    $this->say("Hello, $world");
  }

}
