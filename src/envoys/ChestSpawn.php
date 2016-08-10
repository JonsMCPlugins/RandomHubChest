<?php

namespace envoys;

use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\inventory\Inventory;
use pocketmine\tile\Block;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\block\Chest;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use envoys\Envoys;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\inventory\InventoryOpenEvent;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\Server;
use pocketmine\utils\Config;

class ChestSpawn extends PluginBase implements Listener
{
           public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->config = (new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
        "apply-for-world" => "FACTIONS",
        "items" => array("264")
        )));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("All has loaded");
        }
       
        public function onDisable() {
        $this->getLogger()->info("Stopped");
        $this->config->save();
        }
       
           public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
           $wname = $this->config->get("apply-for-world");
           $world = $this->getServer()->getLevelByName($wname);
           $x = mt_rand(1673,1770);
           $z = mt_rand(85,-20);
           $y = 11;
           
            if(($command->getName()) == "chest") {
            
           if($sender->hasPermission("envoys.chest")) {
           
           if($world->getBlockIdAt($x, $y, $z) === 0 && $world->getBlockIdAt($x+1, $y, $z) === 0 && $world->getBlockIdAt($x-1, $y, $z) === 0 && $world->getBlockIdAt($x, $y+1, $z) === 0 && $world->getBlockIdAt($x, $y, $z+1) === 0 && $world->$getBlockIdAt($x, $y, $z-1) === 0) {
           $pos = new Vector3($x, $y, $z, $world);
           
           $world->setBlock($pos, Block::get(54,0));
           $chest = $world->getTile($setcurrectblock);
           $slot = mt_rand(0,27);
           if($chest instanceof Chest) {
           foreach($this->config->get("items") as $item_id) {
           $item = Item::get($item_id);
             $chest->getInventory->setItem($slot, $item);
             }
             $s->sendMessage(TextFormat::GREEN ."New Chest spawn at ". $setcurrectblock);
             $this->getServer()->broadcastMessage(TextFormat::BLUE ."New Chest Spawn at Lobby, go look for it!");
           }
        }
        } else{
     $sender->sendMessage(TextFormat::RED ."You don't have permission to use this command");
    }
 }
}
    }