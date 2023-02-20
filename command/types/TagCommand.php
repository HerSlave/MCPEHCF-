<?php

namespace hcf\command\types;

use hcf\command\modalForm\TagListForm;
use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class TagCommand extends Command {

    /**
     * TagCommand constructor.
     */
    public function __construct() {
        parent::__construct("tag", "Manage tags.", "/tag <set/add>");
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
            switch($args[0]) {
                case "set":
                    if($sender instanceof HCFPlayer) {
                        $sender->sendForm(new TagListForm($sender));
                        return;
                    }
                    break;
                case "add":
                    if((!$sender->isOp()) and $sender instanceof HCFPlayer) {
                        $sender->sendMessage(Translation::getMessage("noPermission"));
                        return;
                    }
                    if(isset($args[2])) {
                        $tag = $args[2];
                        $player = $this->getCore()->getServer()->getPlayer($args[1]);
                        if($player instanceof HCFPlayer) {
                            $name = $player->getName();
                            $player->addTag($tag);
                            $sender->sendMessage(Translation::getMessage("tagAddSuccess", [
                                "tag" => $tag,
                                "name" => TextFormat::GOLD . $name
                            ]));
                            return;
                        }
                        $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                        return;
                    }
                    $sender->sendMessage(Translation::getMessage("usageMessage", [
                        "usage" => "/tag add <player> <tag>"
                    ]));
                    return;
                    break;
                default:
                    $sender->sendMessage(Translation::getMessage("usageMessage", [
                        "usage" => $this->getUsage()
                    ]));
                    return;
            }
        }
        $sender->sendMessage(Translation::getMessage("usageMessage", [
            "usage" => $this->getUsage()
        ]));
        return;
    }
}