<?php

namespace hcf\command\modalForm;

use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use libs\form\FormIcon;
use libs\form\MenuForm;
use libs\form\MenuOption;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class TagListForm extends MenuForm {

    /**
     * TagListForm constructor.
     *
     * @param HCFPlayer $player
     */
    public function __construct(HCFPlayer $player) {
        $title = TextFormat::BOLD . TextFormat::AQUA . "Tags";
        $text = "Select a tag.";
        $icon = new FormIcon("https://d1u5p3l4wpay3k.cloudfront.net/minecraft_gamepedia/b/be/Name_Tag.png", FormIcon::IMAGE_TYPE_URL);
        $tags = $player->getTags();
        $options = [];
        foreach($tags as $tag) {
            $options[] = new MenuOption($tag, $icon);
        }
        parent::__construct($title, $text, $options);
    }

    /**
     * @param Player $player
     * @param int $selectedOption
     *
     * @throws TranslationException
     */
    public function onSubmit(Player $player, int $selectedOption): void {
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $tag = $this->getOption($selectedOption)->getText();
        $player->setCurrentTag($tag);
        $player->sendMessage(Translation::getMessage("tagSetSuccess", [
            "tag" => $tag
        ]));
        return;
    }
}