<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\faction\Faction;
use hcf\HCF;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class MapKitCommand extends Command {

    /**
     * MapKitCommand constructor.
     */
    public function __construct() {
        parent::__construct("mapkit", "Show map kit.", "/mapkit");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        $sender->sendMessage(TextFormat::BOLD . TextFormat::DARK_PURPLE . "Map #" . HCF::MAP);
        $sender->sendMessage(" ");
        $sender->sendMessage(TextFormat::LIGHT_PURPLE . "Teams: " . TextFormat::GRAY . Faction::MAX_MEMBERS . " members, " . Faction::MAX_ALLIES . " allies");
        $sender->sendMessage(TextFormat::LIGHT_PURPLE . "Limits: " . TextFormat::GRAY . "Protection " . HCF::MAX_PROTECTION . ", Sharpness " . HCF::MAX_SHARPNESS . ", Power " . HCF::MAX_POWER);
        $sender->sendMessage(TextFormat::LIGHT_PURPLE . "Portals: " . TextFormat::GRAY . "750 and 750 in each quadrants");
        $sender->sendMessage(TextFormat::LIGHT_PURPLE . "Border: " . TextFormat::GRAY . HCF::BORDER);
        $sender->sendMessage(TextFormat::LIGHT_PURPLE . "Build: " . TextFormat::GRAY . HCF::EDIT);
        foreach($this->getCore()->getKOTHManager()->getArenas() as $arena) {
            $firstPosition = $arena->getFirstPosition();
            $secondPosition = $arena->getSecondPosition();
            $x = ($firstPosition->getX() + $secondPosition->getX()) / 2;
            $z = ($firstPosition->getZ() + $secondPosition->getZ()) / 2;
            $sender->sendMessage(TextFormat::LIGHT_PURPLE . "{$arena->getName()}: " . TextFormat::GRAY . "($x, $z, {$firstPosition->getLevel()->getFolderName()})");
        }
    }
}