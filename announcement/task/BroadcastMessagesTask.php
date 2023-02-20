<?php

namespace hcf\announcement\task;

use hcf\HCF;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\scheduler\Task;

class BroadcastMessagesTask extends Task {

    /** @var HCF */
    private $plugin;

    /**
     * BroadcastMessagesTask constructor.
     *
     * @param HCF $plugin
     */
    public function __construct(HCF $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param int $currentTick
     *
     * @throws TranslationException
     */
    public function onRun(int $currentTick) {
        $message = $this->plugin->getAnnouncementManager()->getNextMessage();
        $this->plugin->getServer()->broadcastMessage(Translation::getMessage("broadcastMessage", [
            "broadcast" => $message
        ]));
    }
}