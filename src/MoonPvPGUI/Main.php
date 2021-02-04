<?php

namespace MoonPvPGUI;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("Galaxy GUI launched");
  }
  public function oncommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    switch($cmd->getName()){
      case "menu":
        if($sender instanceof Player) {
          $this->openGameMenu($sender);
          return true;
        } else {
          $sender->sendMessage("Sorry, but this command can only be used in-game.");
          return true;
        }
      default:
        return false;
    }
  }
  public function openGameMenu($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function (Player $player, int $data = null){
      $result = $data;
      if($result === null){
        return true;
      }
      switch($result){
        case 0:
          $this->getServer()->dispatchCommand($player, "spawn");
          $sender->sendMessage(TextFormat::RED."Duels");
        break;
        case 1:
          $this->getServer()->dispatchCommand($player, "spawn");
          $sender->sendMessage(TextFormat::GREEN."Sumo");
        break;
        case 2:
          $this->getServer()->dispatchCommand($player, "spawn");
          $sender->sendMessage(TextFormat::BLUE."Practice");
        break;
        case 3:
          $this->getServer()->dispatchCommand($player, "spawn");
          $sender->sendMessage(TextFormat::YELLOW."KitPvP");
        break;
      }
    });
    $form->setTitle("Galaxy Network");
    $form->setContent("Games:");
    $form->addButton("Duels");
    $form->addButton("Sumo");
    $form->addButton("Practice");
    $form->addButton("KitPvP");
    $form->sendToPlayer($player);
    return $form;
  }
}

?>