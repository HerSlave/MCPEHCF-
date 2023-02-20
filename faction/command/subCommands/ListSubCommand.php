<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ListSubCommand extends SubCommand {

    /**
     * ListSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("list", "/faction list [page]");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        $factions = [];
        foreach($this->getCore()->getFactionManager()->getFactions() as $faction) {
            $factions[] = $faction;
        }
        if(!arsort($factions)) {
            $sender->sendMessage(Translation::getMessage("errorOccurred"));
            return;
        }
        $page = 1;
        if(isset($args[1])) {
            $page = (int)$args[1];
        }
        $pages = ceil(count($factions) / 10);
        if((!is_numeric($page)) or $page > $pages) {
            $sender->sendMessage(Translation::getMessage("invalidPage"));
            return;
        }
        $factions = array_slice($factions, ($page - 1) * 10, 10);
        $sender->sendMessage(TextFormat::DARK_GREEN . TextFormat::BOLD . "FACTIONS LIST " . TextFormat::RESET . TextFormat::GRAY . "($page/$pages)");
        $place = (($page - 1) * 10) + 1;
        foreach($factions as $faction) {
            $sender->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "$place. " . TextFormat::RESET . TextFormat::YELLOW . $faction->getName() . TextFormat::DARK_GRAY . " | " . TextFormat::GOLD . count($faction->getOnlineMembers()) . " online" . TextFormat::YELLOW . " {$faction->getDTR()} DTR");
            ++$place;
        }
    }
}