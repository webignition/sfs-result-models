<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpDocSignatureInspection */

namespace webignition\SfsResultModels\Tests;

use PHPUnit\Framework\TestCase;
use webignition\SfsResultInterfaces\ResultInterface;
use webignition\SfsResultModels\Result;

class ResultTest extends TestCase
{
    public function testCreateIpResult()
    {
        $value = '127.0.0.1';
        $type = ResultInterface::TYPE_IP;
        $frequency = 0;
        $appears = true;
        $isBlacklisted = false;
        $lastSeen = new \DateTime();
        $confidence = 0.01;
        $delegatedCountryCode = 'fr';
        $countryCode = 'fr';
        $asn = 1234;
        $isTorExitNode = true;

        $result = new Result(
            $value,
            $type,
            $frequency,
            $appears,
            $isBlacklisted,
            $lastSeen,
            $confidence,
            $delegatedCountryCode,
            $countryCode,
            $asn,
            $isTorExitNode
        );

        $this->assertSame($value, $result->getValue());
        $this->assertSame($type, $result->getType());
        $this->assertSame($frequency, $result->getFrequency());
        $this->assertSame($appears, $result->getAppears());
        $this->assertSame($isBlacklisted, $result->isBlacklisted());
        $this->assertSame($lastSeen, $result->getLastSeen());
        $this->assertSame($confidence, $result->getConfidence());
        $this->assertSame($delegatedCountryCode, $result->getDelegatedCountryCode());
        $this->assertSame($countryCode, $result->getCountryCode());
        $this->assertSame($asn, $result->getAsn());
        $this->assertSame($isTorExitNode, $result->isTorExitNode());
    }

    /**
     * @dataProvider createEmailResultDataProvider
     */
    public function testCreateNonIpResult(
        string $type,
        ?string $delegatedCountryCode = null,
        ?string $countryCode = null,
        ?int $asn = null
    ) {
        $value = 'user@example.com';
        $frequency = 0;
        $appears = true;
        $isBlacklisted = false;
        $lastSeen = new \DateTime();
        $confidence = 0.01;

        $result = new Result(
            $value,
            $type,
            $frequency,
            $appears,
            $isBlacklisted,
            $lastSeen,
            $confidence,
            $delegatedCountryCode,
            $countryCode,
            $asn
        );

        $this->assertSame($value, $result->getValue());
        $this->assertSame($type, $result->getType());
        $this->assertSame($frequency, $result->getFrequency());
        $this->assertSame($appears, $result->getAppears());
        $this->assertSame($isBlacklisted, $result->isBlacklisted());
        $this->assertSame($lastSeen, $result->getLastSeen());
        $this->assertSame($confidence, $result->getConfidence());
        $this->assertNull($result->getDelegatedCountryCode());
        $this->assertNull($result->getCountryCode());
        $this->assertNull($result->getAsn());
        $this->assertFalse($result->isTorExitNode());
    }

    public function createEmailResultDataProvider()
    {
        return [
            'email, with always-null fields set' => [
                'type' => ResultInterface::TYPE_EMAIL,
                'delegatedCountryCode' => 'de',
                'countryCode' => 'de',
                'asn' => 1244,
            ],
            'email, with always-null fields as null' => [
                'type' => ResultInterface::TYPE_EMAIL,
                'delegatedCountryCode' => null,
                'countryCode' => null,
                'asn' => null,
            ],
            'emailHash, with always-null fields set' => [
                'type' => ResultInterface::TYPE_EMAIL_HASH,
                'delegatedCountryCode' => 'de',
                'countryCode' => 'de',
                'asn' => 1244,
            ],
            'emailHash, with always-null fields as null' => [
                'type' => ResultInterface::TYPE_EMAIL_HASH,
                'delegatedCountryCode' => null,
                'countryCode' => null,
                'asn' => null,
            ],
            'username, with always-null fields set' => [
                'type' => ResultInterface::TYPE_USERNAME,
                'delegatedCountryCode' => 'de',
                'countryCode' => 'de',
                'asn' => 1244,
            ],
            'username, with always-null fields as null' => [
                'type' => ResultInterface::TYPE_USERNAME,
                'delegatedCountryCode' => null,
                'countryCode' => null,
                'asn' => null,
            ],
        ];
    }

    /**
     * @dataProvider ipResultIsTorExitNodeAlwaysReturnsBoolDataProvider
     */
    public function testIpResultIsTorExitNodeAlwaysReturnsBool(?bool $isTorExitNode, bool $expectedIsTorExitNode)
    {
        $result = new Result(
            '127.0.0.1',
            ResultInterface::TYPE_IP,
            0,
            true,
            false,
            new \DateTime(),
            0.2,
            'gb',
            'gb',
            1234,
            $isTorExitNode
        );

        $this->assertSame($expectedIsTorExitNode, $result->isTorExitNode());
    }

    public function ipResultIsTorExitNodeAlwaysReturnsBoolDataProvider(): array
    {
        return [
            'null' => [
                'isTorExitNode' => null,
                'expectedIsTorExitNode' => false,
            ],
            'false' => [
                'isTorExitNode' => false,
                'expectedIsTorExitNode' => false,
            ],
            'true' => [
                'isTorExitNode' => true,
                'expectedIsTorExitNode' => true,
            ],
        ];
    }
}
