<?php

namespace hcf\crate\types;

use hcf\crate\Crate;
use hcf\crate\Reward;
use hcf\HCFPlayer;
use hcf\item\types\GrapplingHook;
use hcf\item\types\SwiftPearl;
use hcf\item\types\TeleportationBall;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;

class AbilityCrate extends Crate {

    /**
     * AbilityCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::ABILITY, $position, [
            new Reward((new TeleportationBall())->setCount(4), function(HCFPlayer $player) {
                $player->getInventory()->addItem((new TeleportationBall())->setCount(4));
            }),
            new Reward((new SwiftPearl())->setCount(4), function(HCFPlayer $player) {
                $player->getInventory()->addItem((new SwiftPearl())->setCount(4));
            }),
            new Reward(new GrapplingHook(), function(HCFPlayer $player) {
                $player->getInventory()->addItem(new GrapplingHook());
            })
        ]);
    }

    /**
     * @param HCFPlayer $player
     */
    public function spawnTo(HCFPlayer $player): void {
        $particle = $player->getFloatingText($this->getName());
        if($particle !== null) {
            return;
        }
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::RED . TextFormat::BOLD .  "Ability Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
    }

    /**
     * @param HCFPlayer $player
     */
    public function despawnTo(HCFPlayer $player): void {
        $particle = $player->getFloatingText($this->getName());
        if($particle !== null) {
            $particle->despawn($player);
        }
    }
}
