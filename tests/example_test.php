<?php
/**
 * Author: Fredrik Enestad @ Devloop AB (fredrik@devloop.se)
 * Date: 2011-08-22
 * Time: 10:30 
 */

require_once __DIR__ . "/../vendor/simpletest/autorun.php";
 
class ExampleTest extends UnitTestCase {
  function testExampleThatFails() {
    $this->assertEqual(1,2);
  }
  function testExampleThatSucceeds() {
    $this->assertEqual(2,2);
  }
}
