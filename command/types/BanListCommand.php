<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;

class BanListCommand extends Command {

    /**
     * BanListCommand constructor.
     */
    public function __construct() {
        parent::__construct("banlist", "Check ban list.");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(($sender instanceof HCFPlayer and $sender->hasPermission("permission.mod"))
            or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
            $sender->sendMessage(TextFormat::DARK_RED . TextFormat::BOLD . "BAN LIST");
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT username FROM bans");
            $stmt->execute();
            $stmt->bind_result($name);
            $players = [];
            while($stmt->fetch()) {
                $players[] = $name;
            }
            $stmt->close();
            $sender->sendMessage(TextFormat::WHITE . implode(", ", $players));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}