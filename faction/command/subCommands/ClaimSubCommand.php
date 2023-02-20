<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

class ClaimSubCommand extends SubCommand {

    /**
     * ClaimSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("claim", "/faction claim");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $faction = $sender->getFaction();
        if($faction === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if($sender->getFactionRole() !== Faction::LEADER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if($faction->getClaim() !== null) {
            $sender->sendMessage(Translation::getMessage("mustUnclaimCurrentClaim"));
            return;
        }
        $item = Item::get(Item::STICK, 0, 1);
        $item->setCustomName(TextFormat::RESET . TextFormat::GOLD . TextFormat::BOLD . "Claiming Stick");
        $item->setLore([
            "",
            TextFormat::RESET . TextFormat::GRAY . "Use this stick to select your first and second claiming position.",
            TextFormat::RESET . TextFormat::GRAY . "Left click block to set first position.",
            TextFormat::RESET . TextFormat::GRAY . "Right click block to set second position.",
            TextFormat::RESET . TextFormat::GRAY . "Sneak and click anywhere to confirm purchase of claim."
        ]);
        if($sender->getInventory()->canAddItem($item)) {
            $sender->getInventory()->addItem($item);
            $sender->setClaiming();
            return;
        }
        $sender->sendMessage(Translation::getMessage("fullInventory"));
    }
}