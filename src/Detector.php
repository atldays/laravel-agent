<?php

namespace Atldays\Agent;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Data\Bot;
use Atldays\Agent\Data\Browser;
use Atldays\Agent\Data\Device;
use Atldays\Agent\Data\Os;
use DeviceDetector\Cache\LaravelCache;
use DeviceDetector\DeviceDetector;

final readonly class Detector implements AgentContract
{
    private DeviceDetector $deviceDetector;

    public function __construct(public string $userAgent)
    {
        $this->deviceDetector = tap(new DeviceDetector($this->userAgent), static fn (DeviceDetector $detector) => $detector->setCache(new LaravelCache));
    }

    public function detector(): DeviceDetector
    {
        return tap($this->deviceDetector, static fn (DeviceDetector $detector) => $detector->parse());
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getHash(): string
    {
        return hash('sha256', $this->userAgent);
    }

    public function getOs(): ?Os
    {
        if (!is_array($os = $this->detector()->getOs()) || empty($os)) {
            return null;
        }

        return Os::from($os);
    }

    public function getBrowser(): ?Browser
    {
        if (!is_array($browser = $this->detector()->getClient()) || empty($browser)) {
            return null;
        }

        return Browser::from($browser);
    }

    public function getBot(): ?Bot
    {
        if (!is_array($bot = $this->detector()->getBot()) || empty($bot)) {
            return null;
        }

        return Bot::from($bot);
    }

    public function getDevice(): ?Device
    {
        if (is_null(($detector = $this->detector())->getDevice())) {
            return null;
        }

        return new Device(
            $detector->getDeviceName(),
            $detector->getBrandName(),
            $detector->getModel()
        );
    }

    public function toArray(): array
    {
        return [
            'user_agent' => $this->getUserAgent(),
            'hash' => $this->getHash(),
            'os' => $this->getOs()?->toArray(),
            'browser' => $this->getBrowser()?->toArray(),
            'bot' => $this->getBot()?->toArray(),
            'device' => $this->getDevice()?->toArray(),
        ];
    }
}
