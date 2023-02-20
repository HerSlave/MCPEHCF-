<?php

namespace hcf\crate\task;

use hcf\crate\Crate;
use hcf\HCF;
use hcf\HCFPlayer;
use pocketmine\level\particle\LavaParticle;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\BlockEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\scheduler\Task;

class AnimationTask extends Task {

    /** @var int */
    private $runs = 0;

    /** @var Crate */
    private $crate;

    /** @var HCFPlayer */
    private $player;

    /**
     * AnimationTask constructor.
     *
     * @param Crate $crate
     * @param HCFPlayer $player
     */
    public function __construct(Crate $crate, HCFPlayer $player) {
        $this->crate = $crate;
        $player->setRunningCrateAnimation();
        $this->player = $player;
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick) {
        if($this->player->isClosed()) {
            HCF::getInstance()->getScheduler()->cancelTask($this->getTaskId());
            return;
        }
        ++$this->runs;
        $position = $this->crate->getPosition();
        if($this->runs === 1) {
            $pk = new LevelSoundEventPacket();
            $pk->position = $position;
            $pk->sound = LevelSoundEventPacket::SOUND_CHEST_OPEN;
            $this->player->sendDataPacket($pk);
            $pk = new BlockEventPacket();
            $pk->x = $position->getFloorX();
            $pk->y = $position->getFloorY();
            $pk->z = $position->getFloorZ();
            $pk->eventType = 1;
            $pk->eventData = 1;
            $this->player->sendDataPacket($pk);
            return;
        }
        if($this->runs === 2) {
            $pk = new LevelSoundEventPacket();
            $pk->position = $position;
            $pk->sound = LevelSoundEventPacket::SOUND_LAUNCH;
            $this->player->sendDataPacket($pk);
        }
        if($this->runs === 4) {
            $cx = $position->getX() + 0.5;
            $cy = $position->getY() + 1.2;
            $cz = $position->getZ() + 0.5;
            $radius = 1;
            for($i = 0; $i < 21; $i += 1.1){
                $x = $cx + ($radius * cos($i));
                $z = $cz + ($radius * sin($i));
                $pos = new Vector3($x, $cy, $z);
                $position->level->addParticle(new LavaParticle($pos), [$this->player]);
            }
            for($i = 1; $i <= 4; $i++) {
                $reward = $this->crate->getRewards()[array_rand($this->crate->getRewards())];
                $callable = $reward->getCallback();
                $callable($this->player);
            }
            $pk = new LevelSoundEventPacket();
            $pk->position = $position;
            $pk->sound = LevelSoundEventPacket::SOUND_BLAST;
            $this->player->sendDataPacket($pk);
            return;
        }
        if($this->runs === 6) {
            $pk = new LevelSoundEventPacket();
            $pk->position = $position;
            $pk->sound = LevelSoundEventPacket::SOUND_CHEST_CLOSED;
            $this->player->sendDataPacket($pk);
            $pk = new BlockEventPacket();
            $pk->x = $position->getFloorX();
            $pk->y = $position->getFloorY();
            $pk->z = $position->getFloorZ();
            $pk->eventType = 1;
            $pk->eventData = 0;
            $this->player->sendDataPacket($pk);
            $this->crate->spawnTo($this->player);
            $this->player->setRunningCrateAnimation(false);
            HCF::getInstance()->getScheduler()->cancelTask($this->getTaskId());
        }
    }
}