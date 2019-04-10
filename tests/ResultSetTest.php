<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\SfsResultModels\Tests;

use PHPUnit\Framework\TestCase;
use webignition\SfsResultInterfaces\ResultInterface;
use webignition\SfsResultModels\ResultSet;

class ResultSetTest extends TestCase
{
    public function testAddResult()
    {
        $result = \Mockery::mock(ResultInterface::class);

        $resultSet = new ResultSet();
        $this->assertCount(0, $resultSet);

        $resultSet->addResult($result);
        $this->assertCount(1, $resultSet);
        $this->assertSame($result, $resultSet->current());
    }

    public function testIterator()
    {
        $results = [
            \Mockery::mock(ResultInterface::class),
            \Mockery::mock(ResultInterface::class),
            \Mockery::mock(ResultInterface::class),
        ];

        $resultSet = new ResultSet();

        foreach ($results as $result) {
            $resultSet->addResult($result);
        }

        foreach ($resultSet as $resultIndex => $result) {
            $this->assertSame($results[$resultIndex], $result);
        }
    }
}
