<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\player\Player;
use pocketmine\command\CommandSender;

class About{
  
 public function onCommand(CommandSender $player){
  $player->sendMessage("§e§lPLUGIN ACIDISLAND BY BEEAZ");
}
}
