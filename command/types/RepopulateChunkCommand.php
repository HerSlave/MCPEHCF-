<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class RepopulateChunkCommand extends Command {

    /**
     * RepopulateChunkCommand constructor.
     */
    public function __construct() {
        parent::__construct("repopulatechunk", "Repopulate a chunk.", "/repopulatechunk", ["rc"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if((!$sender->isOp()) or (!$sender instanceof HCFPlayer)) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $chunk = $sender->getLevel()->getChunkAtPosition($sender, false);
        if($chunk === null) {
            return;
        }
        $chunk->setPopulated(false);
        $sender->getLevel()->populateChunk($chunk->getX(), $chunk->getZ(), true);
        return;
    }
}