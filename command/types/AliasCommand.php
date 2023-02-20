<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class AliasCommand extends Command {

    /**
     * AliasCommand constructor.
     */
    public function __construct() {
        parent::__construct("alias", "Check for alts.", "/alias <player>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(isset($args[0])) {
            if(!$sender->isOp()) {
                if(!$sender->hasPermission("permission.staff")) {
                    $sender->sendMessage(Translation::getMessage("noPermission"));
                    return;
                }
            }
            $name = $args[0];
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT ipAddress FROM ipAddress WHERE username = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->bind_result($result);
            $addresses = [];
            while($stmt->fetch()) {
                if($result === null) {
                    $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                }
                $addresses[] = $result;
            }
            $stmt->close();
            $players = [];
            foreach($addresses as $address) {
                $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT username FROM ipAddress WHERE ipAddress = ?");
                $stmt->bind_param("s", $address);
                $stmt->execute();
                $stmt->bind_result($result);
                while($stmt->fetch()) {
                    $players[] = $result;
                }
                $stmt->close();
            }
            $sender->sendMessage(TextFormat::DARK_RED . TextFormat::BOLD . strtoupper($name) . " IS ALSO KNOWN AS:");
            $sender->sendMessage(TextFormat::WHITE . implode(", ", $players));
            return;
        }
        $sender->sendMessage(Translation::getMessage("usageMessage", [
            "usage" => $this->getUsage()
        ]));
        return;
    }
}