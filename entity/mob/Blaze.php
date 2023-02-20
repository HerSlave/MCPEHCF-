<?php

namespace hcf\entity\mob;

use hcf\HCFPlayer;
use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\block\Slab;
use pocketmine\block\Stair;
use pocketmine\entity\Monster;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;

class Blaze extends Monster {

    const FIND_DISTANCE = 10;

    const LOSE_DISTANCE = 25;

    const ATTACK_DISTANCE = 1;

    /** @var int */
    public const NETWORK_ID = self::BLAZE;

    /** @var float */
    public $width = 0.6;

    /** @var float */
    public $height = 1.8;

    /** @var int */
    public $attackDamage;

    /** @var float */
    public $speed;

    /** @var int */
    public $attackWait;

    /** @var int */
    public $regenerationWait;

    /** @var int */
    public $regenerationRate;

    /** @var HCFPlayer|null */
    private $target = null;

    /** @var int */
    private $findNewTargetTicks = 0;

    /** @var int */
    private $jumpTicks = 5;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
        $this->attackDamage = 5;
        $this->speed = 0.75;
        $this->attackWait = 20;
        $this->regenerationRate = 1;
        $this->regenerationWait = 80;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Blaze";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::BLAZE_ROD, 0, mt_rand(0, 1))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }

    /**
     * @param int $tickDiff
     *
     * @return bool
     */
    public function entityBaseTick(int $tickDiff = 1): bool {
        parent::entityBaseTick($tickDiff);
        if(!$this->isAlive()) {
            if(!$this->closed) {
                $this->flagForDespawn();
            }
            return false;
        }
        if($this->hasTarget()) {
            return $this->attackTarget();
        }
        if($this->findNewTargetTicks > 0) {
            $this->findNewTargetTicks--;
        }
        if(!$this->hasTarget() and $this->findNewTargetTicks === 0) {
            $this->findNewTarget();
        }
        if($this->jumpTicks > 0) {
            $this->jumpTicks--;
        }
        if($this->regenerationWait > 0) {
            $this->regenerationWait--;
        }
        if($this->regenerationWait <= 0) {
            $this->setHealth($this->getHealth() + $this->regenerationRate);
        }
        if(!$this->isOnGround()) {
            if($this->motion->y > -$this->gravity * 4) {
                $this->motion->y = -$this->gravity * 4;
            }
            else {
                $this->motion->y += $this->isUnderwater() ? $this->gravity : -$this->gravity;
            }
        }
        else {
            $this->motion->y -= $this->gravity;
        }
        $this->move($this->motion->x, $this->motion->y, $this->motion->z);
        if($this->shouldJump()) {
            $this->jump();
        }
        $this->updateMovement();
        return $this->isAlive();
    }

    /**
     * @return bool
     */
    public function attackTarget(): bool {
        $target = $this->getTarget();
        if($target == null or $target->distance($this) >= self::LOSE_DISTANCE) {
            $this->target = null;
            return true;
        }
        if($this->jumpTicks > 0) {
            $this->jumpTicks--;
        }
        if(!$this->isOnGround()) {
            if($this->motion->y > -$this->gravity * 4) {
                $this->motion->y = -$this->gravity * 4;
            }
            else {
                $this->motion->y += $this->isUnderwater() ? $this->gravity : -$this->gravity;
            }
        }
        else {
            $this->motion->y -= $this->gravity;
        }
        $this->move($this->motion->x, $this->motion->y, $this->motion->z);
        if($this->shouldJump()) {
            $this->jump();
        }
        $x = $target->x - $this->x;
        $y = $target->y - $this->y;
        $z = $target->z - $this->z;
        if($x * $x + $z * $z < 1.2) {
            $this->motion->x = 0;
            $this->motion->z = 0;
        }
        else {
            $this->motion->x = $this->getSpeed() * 0.15 * ($x / (abs($x) + abs($z)));
            $this->motion->z = $this->getSpeed() * 0.15 * ($z / (abs($x) + abs($z)));
        }
        $this->yaw = rad2deg(atan2(-$x, $z));
        $this->pitch = rad2deg(-atan2($y, sqrt($x * $x + $z * $z)));
        $this->move($this->motion->x, $this->motion->y, $this->motion->z);
        if($this->shouldJump()) {
            $this->jump();
        }
        if($this->distance($target) <= self::ATTACK_DISTANCE and $this->attackWait <= 0) {
            $event = new EntityDamageByEntityEvent($this, $target, EntityDamageEvent::CAUSE_ENTITY_ATTACK, $this->getBaseAttackDamage());
            if($target->getHealth() - $event->getFinalDamage() <= 0) {
                $this->target = null;
                $this->findNewTarget();
            }
            $this->broadcastEntityEvent(4);
            $target->attack($event);
            $this->attackWait = 20;
        }
        $this->updateMovement();
        $this->attackWait--;
        return $this->isAlive();
    }

    /**
     * @param EntityDamageEvent $source
     */
    public function attack(EntityDamageEvent $source): void {
        if($source instanceof EntityDamageByEntityEvent) {
            $killer = $source->getDamager();
            if($killer instanceof HCFPlayer) {
                if($this->target === null or $this->target->getName() != $killer->getName()) {
                    $this->target = $killer;
                }
            }
        }
        parent::attack($source);
    }

    public function findNewTarget() {
        $distance = self::FIND_DISTANCE;
        $target = null;
        foreach($this->getLevel()->getPlayers() as $player) {
            if($player->distance($this) <= $distance) {
                $distance = $player->distance($this);
                $target = $player;
            }
        }
        $this->findNewTargetTicks = 60;
        $this->target = ($target != null ? $target : null);
    }

    /**
     * @return bool
     */
    public function hasTarget(): bool {
        $target = $this->getTarget();
        if($target == null) {
            return false;
        }
        return true;
    }

    /**
     * @return HCFPlayer|null
     */
    public function getTarget(): ?HCFPlayer {
        return $this->target;
    }

    /**
     * @return float
     */
    public function getSpeed(): float {
        return ($this->isUnderwater() ? $this->speed / 2 : $this->speed);
    }

    /**
     * @return int
     */
    public function getBaseAttackDamage(): int {
        return $this->attackDamage;
    }

    /**
     * @param int $y
     *
     * @return Block
     */
    public function getFrontBlock($y = 0): Block {
        $dv = $this->getDirectionVector();
        $pos = $this->asVector3()->add($dv->x * $this->getScale(), $y + 1, $dv->z * $this->getScale())->round();
        return $this->getLevel()->getBlock($pos);
    }

    /**
     * @return bool
     */
    public function shouldJump(): bool {
        if($this->jumpTicks > 0) {
            return false;
        }
        return $this->isCollidedHorizontally or
            ($this->getFrontBlock()->getId() != 0 or $this->getFrontBlock(-1) instanceof Stair) or
            ($this->getLevel()->getBlock($this->asVector3()->add(0, -0, 5)) instanceof Slab and
                (!$this->getFrontBlock(-0.5) instanceof Slab and $this->getFrontBlock(-0.5)->getId() != 0)) and
            $this->getFrontBlock(1)->getId() == 0 and
            $this->getFrontBlock(2)->getId() == 0 and
            !$this->getFrontBlock() instanceof Flowable and
            $this->jumpTicks == 0;
    }

    /**
     * @return int
     */
    public function getJumpMultiplier(): int {
        if($this->getFrontBlock() instanceof Slab or $this->getFrontBlock() instanceof Stair or
            $this->getLevel()->getBlock($this->asVector3()->subtract(0, 0.5)->round()) instanceof Slab and
            $this->getFrontBlock()->getId() != 0) {
            $fb = $this->getFrontBlock();
            if($fb instanceof Slab and $fb->getDamage() & 0x08 > 0) {
                return 8;
            }
            if($fb instanceof Stair and $fb->getDamage() & 0x04 > 0) {
                return 8;
            }
            return 4;
        }
        return 16;
    }

    public function jump(): void {
        $this->motion->y = $this->gravity * $this->getJumpMultiplier();
        $this->move($this->motion->x * 1.25, $this->motion->y, $this->motion->z * 1.25);
        $this->jumpTicks = 5;
    }
}