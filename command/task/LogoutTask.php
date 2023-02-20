<?php

namespace hcf\command\task;

use hcf\HCF;
use hcf\HCFPlayer;
use pocketmine\level\Position;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class LogoutTask extends Task {

    /** @var HCFPlayer */
    private $player;

    /** @var Position */
    private $position;

    /** @var int */
    private $time;

    /** @var int */
    private $maxTime;

    /**
     * LogoutTask constructor.
     *
     * @param HCFPlayer $player
     * @param int $time
     */
    public function __construct(HCFPlayer $player, int $time) {
        $this->player = $player;
        $this->position = $player->asPosition();
        $this->time = $time;
        $this->maxTime = $time;
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick) {
        if($this->player === null or $this->player->isClosed()) {
            HCF::getInstance()->getScheduler()->cancelTask($this->getTaskId());
            return;
        }
        if($this->player->getFloorX() !== $this->position->getFloorX() or $this->player->getFloorY() !== $this->position->getFloorY() or $this->player->getFloorZ() !== $this->position->getFloorZ()) {
            $this->player->setTeleporting(false);
            $this->player->addTitle(TextFormat::DARK_RED . "Failed to log out", TextFormat::GRAY . "You must stand still!");
            HCF::getInstance()->getScheduler()->cancelTask($this->getTaskId());
            return;
        }
        if($this->time >= 0) {
            $this->player->addTitle(TextFormat::DARK_GREEN . "Logging out in", TextFormat::GRAY . "$this->time seconds" . str_repeat(".", ($this->maxTime - $this->time) % 4));
            $this->time--;
            return;
        }
        $this->player->setLogout();
        $this->player->close(null, TextFormat::GREEN . "You have successfully logged out!");
        HCF::getInstance()->getScheduler()->cancelTask($this->getTaskId());
        return;
    }
}
