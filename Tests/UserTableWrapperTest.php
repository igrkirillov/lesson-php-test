<?php

namespace Tests;

use Dao\UserTableWrapper;
use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '/../autoload.php');
spl_autoload_register("autoload");

class UserTableWrapperTest extends TestCase
{
    public function testInsert()
    {
        $subject = new UserTableWrapper();
        $subject->insert(array("id" => 1, "name" => "John Doe"));
        $this->assertEquals(1, count($subject->getRows()));
    }
}