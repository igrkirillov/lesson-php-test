<?php

namespace Tests;

use Dao\UserTableWrapper as UserTableWrapper;
use PHPUnit\Framework\TestCase as TestCase;

require_once (__DIR__ . '/../autoload.php');
spl_autoload_register("autoload");

class UserTableWrapperTest extends TestCase
{
    /**
     * @covers \Dao\UserTableWrapper::insert
     */
    public function testInsert()
    {
        // Arrange
        $id = 1;
        $name = "John Doe";
        $subject = new UserTableWrapper();

        // Act
        $subject->insert(array("id" => $id, "name" => $name));

        // Asserts
        $this->assertEquals(1, count($subject->getRows()));
        $this->assertEquals($id, $subject->getRows()[0]["id"]);
        $this->assertEquals($name, $subject->getRows()[0]["name"]);
    }

    /**
     * @covers \Dao\UserTableWrapper::update
     */
    public function testUpdate()
    {
        // Arrange
        $id = 1;
        $name = "John Doe";
        $subject = new UserTableWrapper();
        $subject->setRows(array(array("id" => $id, "name" => "Bred Pit")));

        // Act
        $subject->update($id, array("id" => $id, "name" => $name));

        // Asserts
        $this->assertEquals(1, count($subject->getRows()));
        $this->assertEquals($id, $subject->getRows()[0]["id"]);
        $this->assertEquals($name, $subject->getRows()[0]["name"]);
    }

    /**
     * @covers \Dao\UserTableWrapper::delete
     */
    public function testDelete()
    {
        // Arrange
        $id = 1;
        $subject = new UserTableWrapper();
        $subject->setRows(array(array("id" => $id, "name" => "Bred Pit")));

        // Act
        $subject->delete($id);

        // Asserts
        $this->assertEquals(0, count($subject->getRows()));
    }

    /**
     * @dataProvider providerTestGet
     * @covers \Dao\UserTableWrapper::get
     */
    public function testGet($initialRows, $id, $name)
    {
        // Arrange
        $subject = new UserTableWrapper();
        $subject->setRows(array(array("id" => $id, "name" => $name)));

        // Act
        $result = $subject->get($id);

        // Asserts
        $this->assertEquals($id, $result["id"]);
        $this->assertEquals($name, $result["name"]);
    }

    function providerTestGet()
    {
        return [
            [
                [array("id" => 1, "name" => "Mr Jonn"), array("id" => 2, "name" => "Miss Mary")],
                2,
                "Miss Mary"
            ],
            [
                [array("id" => 1, "name" => "Mr Jonn")],
                1,
                "Mr Jonn"
            ]
        ];
    }
}