<?php

namespace webignition\SfsResultModels;

use webignition\SfsResultInterfaces\ResultInterface;

class Result implements ResultInterface
{
    private $value;
    private $type;
    private $frequency;
    private $appears;
    private $lastSeen;
    private $confidence;
    private $delegatedCountryCode;
    private $countryCode;
    private $asn;
    private $isBlacklisted;
    private $isTorExitNode;

    /**
     * @param string $value
     * @param string $type
     * @param int $frequency
     * @param bool $appears
     * @param bool $isBlacklisted
     * @param \DateTime|null $lastSeen
     * @param float|null $confidence
     * @param string|null $delegatedCountryCode
     * @param string|null $countryCode
     * @param int|null $asn
     * @param bool|null $isTorExitNode
     */
    public function __construct(
        string $value,
        string $type,
        int $frequency,
        bool $appears,
        bool $isBlacklisted,
        ?\DateTime $lastSeen = null,
        ?float $confidence = null,
        ?string $delegatedCountryCode = null,
        ?string $countryCode = null,
        ?int $asn = null,
        ?bool $isTorExitNode = false
    ) {
        $this->value = $value;
        $this->type = $type;
        $this->frequency = $frequency;
        $this->appears = $appears;
        $this->isBlacklisted = $isBlacklisted;
        $this->lastSeen = $lastSeen;
        $this->confidence = $confidence;
        $this->delegatedCountryCode = $delegatedCountryCode;
        $this->countryCode = $countryCode;
        $this->asn = $asn;
        $this->isTorExitNode = is_bool($isTorExitNode) ? $isTorExitNode : false;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    public function getAppears(): bool
    {
        return $this->appears;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLastSeen(): ?\DateTime
    {
        return $this->lastSeen;
    }

    public function getConfidence(): ?float
    {
        return $this->confidence;
    }

    public function getDelegatedCountryCode(): ?string
    {
        if ($this->type !== ResultInterface::TYPE_IP) {
            return null;
        }

        return $this->delegatedCountryCode;
    }

    public function getCountryCode(): ?string
    {
        if ($this->type !== ResultInterface::TYPE_IP) {
            return null;
        }

        return $this->countryCode;
    }

    public function getAsn(): ?int
    {
        if ($this->type !== ResultInterface::TYPE_IP) {
            return null;
        }

        return $this->asn;
    }

    public function isBlacklisted(): bool
    {
        return $this->isBlacklisted;
    }

    public function isTorExitNode(): bool
    {
        if ($this->type !== ResultInterface::TYPE_IP) {
            return false;
        }

        return $this->isTorExitNode;
    }
}
