<?php

namespace hcf\groups\event;

use hcf\HCFPlayer;
use pocketmine\event\Event;

class GroupChangeEvent extends Event {

    /** @var HCFPlayer */
    private $player;

    /** @var int */
    private $groupId;

    /**
     * GroupChangeEvent constructor.
     *
     * @param HCFPlayer $player
     * @param int $groupId
     */
    public function __construct(HCFPlayer $player, int $groupId) {
        $this->player = $player;
        $this->groupId = $groupId;
    }

    /**
     * @return HCFPlayer
     */
    public function getPlayer(): HCFPlayer {
        return $this->player;
    }

    /**
     * @return int
     */
    public function getGroupIdentifier(): int {
        return $this->groupId;
    }
}