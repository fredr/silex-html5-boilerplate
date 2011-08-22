<?php
/**
 * Author: Fredrik Enestad @ Devloop AB (fredrik@devloop.se)
 * Date: 2011-08-22
 * Time: 10:43 
 */

require_once __DIR__ . "/../vendor/simpletest/autorun.php";

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests');
        $this->addFile(__DIR__ . "/example_test.php");
    }
}
