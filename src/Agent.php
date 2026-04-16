<?php

namespace Atldays\Agent;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Data\Bot;
use Atldays\Agent\Data\Browser;
use Atldays\Agent\Data\Device;
use Atldays\Agent\Data\Os;
use DeviceDetector\Cache\LaravelCache;
use DeviceDetector\DeviceDetector;

final readonly class Agent implements AgentContract
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

    public function userAgent(): string
    {
        return $this->userAgent;
    }

    public function hash(): string
    {
        return hash('sha256', $this->userAgent);
    }

    public function os(): ?Os
    {
        if (!is_array($os = $this->detector()->getOs()) || empty($os)) {
            return null;
        }

        return Os::from($os);
    }

    public function browser(): ?Browser
    {
        if (!is_array($browser = $this->detector()->getClient()) || empty($browser)) {
            return null;
        }

        return Browser::from($browser);
    }

    public function bot(): ?Bot
    {
        if (!is_array($bot = $this->detector()->getBot()) || empty($bot)) {
            return null;
        }

        return Bot::from($bot);
    }

    public function device(): ?Device
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
            'user_agent' => $this->userAgent(),
            'hash' => $this->hash(),
            'os' => $this->os()?->toArray(),
            'browser' => $this->browser()?->toArray(),
            'bot' => $this->bot()?->toArray(),
            'device' => $this->device()?->toArray(),
        ];
    }
}
