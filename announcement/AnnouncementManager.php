<?php

namespace hcf\announcement;

use hcf\announcement\task\BroadcastMessagesTask;
use hcf\HCF;

class AnnouncementManager {

    /** @var HCF */
    private $core;

    /** @var string[] */
    private $messages;

    /** @var int */
    private $currentId = 0;

    /**
     * AnnouncementManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $this->init();
        $core->getScheduler()->scheduleRepeatingTask(new BroadcastMessagesTask($core), 4800);
    }

    public function init(): void {
        $this->messages = [
            "Looking for our buycraft store? It's at valethcf.tebex.io.",
            "Want rewards and support us at the same time? Vote under your username at https://bit.ly/37kt2CS and then do /vote.",
            "Looking for our discord server? It's at https://bit.ly/30y8buf."
        ];
    }

    /**
     * @return string
     */
    public function getNextMessage(): string {
        if(isset($this->messages[$this->currentId])) {
            $message = $this->messages[$this->currentId];
            $this->currentId++;
            return $message;
        }
        $this->currentId = 0;
        return $this->messages[$this->currentId];
    }
}
