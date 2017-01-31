<?php
namespace BoxOfDevs\WorldPainter;

use pocketmine\Player;
use pocketmine\block\Block


// THis file is very hard to understand (for me too !) so if you're not sure at 100% of what it does, don't modify it
class GetEmptyBlock {
    
    public function __construct(Player $player, Block $fillblock) {
        if($fillblock->x < $player->x) { // x++
         
         
         if($fillblock->x < 0) {
                     $x = $fillblock->x - $fillblock->x;
         } else {
                     $x = $fillblock->x;
         }
         
         
         
         if($fillblock->z < $player->z) { // x++ z++
             
             
             if($fillblock->z < 0) {
                     $z = $fillblock->z - $fillblock->z;
             } else {
                     $z = $fillblock->z;
             }
             
             
             if($fillblock->y < $player->y) { // x++ y++ z++
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x++ y-- z++
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } else { // x++ y z++
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                 }
                 
             }
             
             
             
         } elseif($fillblock->z > $player->z) { // x++ z--
             
             
             if($fillblock->z < 0) {
                     $z = $fillblock->z - $fillblock->z;
             } else {
                     $z = $fillblock->z;
             }

             
             if($fillblock->y < $player->y) { // x++ y++ z--
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x++ y-- z--
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                     } else {
                         $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
             } else { // x++ y z--
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                 }
                 
             }
             
             
             
             
         } else { // z
                 
                 
             
             if($fillblock->y < $player->y) { // x++ y++ z
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($x < $y) {
                     $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 }
                 
             } elseif($fillblock->y > $player->y) {// x++ y-- z
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 if($x < $y) {
                     $block = new Vector3($fillblock->x + 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y -1, $fillblock->z);
                 }
                 
                 
             } else { // x-- y z
                 
                 $block = new Vector3($fillblock->x +1, $fillblock->y, $fillblock->z);
                 
             }
         }
         
         
         
     } elseif($fillblock->x > $player->x) { // x--
     
     
         if($fillblock->x < 0) {
                     $x = $fillblock->x - $fillblock->x;
         } else {
                     $x = $fillblock->x;
         }
         
         
         
         if($fillblock->z < $player->z) { // x-- z++
         
         
             if($fillblock->z < 0) {
                     $z = $fillblock->z - $fillblock->z;
             } else {
                     $z = $fillblock->z;
             }
             
             
             if($fillblock->y < $player->y) { // x-- y++ z++
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
                 
             } elseif($fillblock->y > $player->y) {// x-- y-- z++
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } else { // x-- y z++
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                 }
                 
             }
             
             
             
         } elseif($fillblock->z > $player->z) { // x-- z--
             
             
             
             if($fillblock->y < $player->y) { // x-- y++ z--
             
             
                if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x-- y-- z--
                 
                 
                 if($y < $z) {
                     if($y < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 } else {
                     if($z < $x) {
                         $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                     } else {
                         $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                     }
                 }
                 
                 
             } else { // x-- y z--
                 
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                 }
                 
                 
             }
             
             
             
             
         } else {
             
             
             
             if($fillblock->y < $player->y) { // x-- y++ z
                 
                 
                 if($x < $y) {
                     $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x-- y-- z
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 }
                 
             } else { // x-- y z
                 
                 $block = new Vector3($fillblock->x - 1, $fillblock->y, $fillblock->z);
                 
             }
         }
         
         
         
         
     } else { // x
         
         
         
         
         if($fillblock->z < $player->z) { //z++
             
             
             if($fillblock->z < 0) {
                     $z = $fillblock->z - $fillblock->z;
             } else {
                     $z = $fillblock->z;
             }
             
             
             if($fillblock->y < $player->y) { // x y++ z++
             
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x y-- z++
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($x < $z) {
                     $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
                 }
                 
                 
             } else { // x y z++
                 $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z + 1);
             }
             
             
             
         } elseif($fillblock->z > $player->z) { // x z--
             
             
             if($fillblock->z < 0) {
                     $z = $fillblock->z - $fillblock->z;
             } else {
                     $z = $fillblock->z;
             }
             
             
             if($fillblock->y < $player->y) { // x y++ z--
             
             
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                 }
                 
                 
             } elseif($fillblock->y > $player->y) {// x y-- z--
                 
                 
                 if($fillblock->y < 0) {
                     $y = $fillblock->y - $fillblock->y;
                 } else {
                     $y = $fillblock->y;
                 }
                 
                 
                 if($y < $z) {
                     $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 } else {
                     $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                 }
                 
                 
             } else { // x y z--
                 
                 $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z - 1);
                 
             }
             
             
             
             
         } else {
             
             
             
             if($fillblock->y < $player->y) { // x y++ z
                 
                 $block = new Vector3($fillblock->x, $fillblock->y + 1, $fillblock->z);
                 
             } elseif($fillblock->y > $player->y) {// x y-- z
                 
                 $block = new Vector3($fillblock->x, $fillblock->y - 1, $fillblock->z);
                 
             } else { // x y z
                 
                 $block = new Vector3($fillblock->x, $fillblock->y, $fillblock->z);
                 
             }
         }
     }
     $this->block = $block;
    }
}