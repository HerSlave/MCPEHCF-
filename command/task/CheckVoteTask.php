<?php

namespace hcf\command\task;

use hcf\crate\Crate;
use hcf\HCFPlayer;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\Internet;

class CheckVoteTask extends AsyncTask {

    const API_KEY = "5gZJeRjK5sWzVLqGVN7jJ1hIkSZZhtwDJP";

    const CHECK_URL = "http://minecraftpocket-servers.com/api-vrc/?object=votes&element=claim&key=" . self:: API_KEY . "&username={USERNAME}";

    const POST_URL = "http://minecraftpocket-servers.com/api-vrc/?action=post&object=votes&element=claim&key=" . self:: API_KEY . "&username={USERNAME}";

    const VOTED = "voted";

    const CLAIMED = "claimed";

    /** @var string[] */
    private $player;

    /**
     * CheckVoteTask constructor.
     *
     * @param string $player
     */
    public function __construct(string $player) {
        $this->player = $player;
    }

    public function onRun() {
        $get = Internet::getURL(str_replace("{USERNAME}", $this->player, self::CHECK_URL));
        if($get === false) {
            return;
        }
        $get = json_decode($get, true);
        if((!isset($get["voted"])) or (!isset($get["claimed"]))) {
            return;
        }
        $this->setResult([
            self::VOTED => $get["voted"],
            self::CLAIMED => $get["claimed"],
        ]);
        if($get["voted"] === true and $get["claimed"] === false) {
            $post = Internet::postURL(str_replace("{USERNAME}", $this->player, self::POST_URL), []);
            if($post === false) {
                $this->setResult(null);
            }
        }
    }

    /**
     * @param Server $server
     *
     * @throws TranslationException
     */
    public function onCompletion(Server $server) {
        $player = $server->getPlayer($this->player);
        if((!$player instanceof HCFPlayer) or $player->isClosed()) {
            return;
        }
        $result = $this->getResult();
        if(empty($result)) {
            $player->sendMessage(Translation::getMessage("errorOccurred"));
            return;
        }
        $player->setCheckingForVote(false);
        if($result[self::VOTED] === true) {
            if($result[self::CLAIMED] === true) {
                $player->setVoted();
                $player->sendMessage(Translation::getMessage("alreadyVoted"));
                return;
            }
            $player->setVoted();
            $server->broadcastMessage(Translation::getMessage("voteBroadcast", [
                "name" => $player->getDisplayName()
            ]));
            $player->getInventory()->addItem((new CrateKey($player->getCore()->getCrateManager()->getCrate(Crate::REWARD)))->setCount(1));
            return;
        }
        $player->sendMessage(Translation::getMessage("haveNotVoted"));
        $player->setVoted(false);
    }
}