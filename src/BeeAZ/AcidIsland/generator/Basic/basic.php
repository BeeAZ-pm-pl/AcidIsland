<?php

namespace BeeAZ\AcidIsland\generator\Basic;

use pocketmine\math\Vector3;
use pocketmine\world\ChunkManager;
use pocketmine\block\BlockLegacyIds;
use pocketmine\world\generator\Generator;
use pocketmine\world\format\Chunk;

class basic extends Generator{
  
  
    public function __construct(int $seed, string $preset){
     parent::__construct($seed, $preset);
    }

    public function generateChunk(ChunkManager $world, $chunkX, $chunkZ): void{
     $chunk = $world->getChunk($chunkX, $chunkZ);
       for($Z = 0; $Z < 16; ++$Z){
         for($X = 0; $X < 16; ++$X){
           $chunk->setFullBlock($X, 0, $Z, BlockLegacyIds::BEDROCK << 4);
             for($y = 1; $y < 65; ++$y) {
               $chunk->setFullBlock($X, $y, $Z, BlockLegacyIds::WATER << 4);
      }
    }
  }
     if($chunkX == 0 && $chunkZ == 0) {
       for($x = 4; $x < 11; $x++){
         for($z = 4; $z < 11; $z++){
           $chunk->setFullBlock($x, 64, $z, BlockLegacyIds::GRASS << 4);
     }
   }
       for($x = 4; $x < 11; $x++){
         for($z = 4; $z < 11; $z++){
           $chunk->setFullBlock($x, 63, $z, BlockLegacyIds::GRASS << 4);
      }
    }
       for($x = 5; $x < 10; $x++){
         for($z = 5; $z < 10; $z++){
           $chunk->setFullBlock($x, 63, $z, BlockLegacyIds::DIRT << 4);
           $chunk->setFullBlock($x, 68, $z, BlockLegacyIds::LEAVES << 4); 
      }
    }
       for($x = 6; $x < 9; $x++){
         for($z = 6; $z < 9; $z++){
           $chunk->setFullBlock($x, 69, $z, BlockLegacyIds::LEAVES << 4);
           $chunk->setFullBlock($x, 62, $z, BlockLegacyIds::DIRT << 4);
      }
   }
        $chunk->setFullBlock(7, 60, 7, BlockLegacyIds::BEDROCK << 4);
        $chunk->setFullBlock(7, 61, 7, BlockLegacyIds::SAND << 4);
        $chunk->setFullBlock(7, 62, 7, BlockLegacyIds::SAND << 4);
        $chunk->setFullBlock(7, 63, 7, BlockLegacyIds::SAND << 4);
        $chunk->setFullBlock(8, 64, 8, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(8, 64, 9, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(8, 64, 7, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(8, 64, 6, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(9, 64, 5, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(10, 64, 8, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(10, 64, 9, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(10, 64, 7, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(10, 64, 6, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(9, 64, 8, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(9, 64, 9, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(9, 64, 7, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(9, 64, 6, BlockLegacyIds::GRASS << 4);
        $chunk->setFullBlock(4, 65, 7, BlockLegacyIds::CRAFTING_TABLE << 4);
        $chunk->setFullBlock(4, 65, 8, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(4, 65, 9, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(5, 65, 9, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(5, 65, 10, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(6, 65, 10, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(7, 65, 10, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(8, 65, 10, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(9, 65, 10, BlockLegacyIds::FENCE << 4);
        $chunk->setFullBlock(10, 65, 10, BlockLegacyIds::HAY_BALE << 4);
        $chunk->setFullBlock(10, 65, 9, BlockLegacyIds::HAY_BALE << 4);
        $chunk->setFullBlock(10, 66, 9, BlockLegacyIds::HAY_BALE << 4);
        $chunk->setFullBlock(10, 65, 8, BlockLegacyIds::HAY_BALE << 4);
        $chunk->setFullBlock(9, 65, 9, BlockLegacyIds::HAY_BALE << 4);
        $chunk->setFullBlock(7, 67, 8, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(7, 65, 7, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(7, 66, 7, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(7, 67, 7, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(7, 68, 7, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(7, 69, 7, BlockLegacyIds::LOG << 4);
        $chunk->setFullBlock(5, 69, 7, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 69, 5, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(9, 69, 7, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 69, 9, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 70, 6, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(6, 70, 7, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(8, 70, 7, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 70, 8, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 71, 7, BlockLegacyIds::LEAVES << 4);
        $chunk->setFullBlock(7, 61, 8, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(8, 61, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(7, 61, 6, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(6, 61, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(5, 62, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(7, 62, 5, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(9, 62, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(7, 62, 9, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(4, 63, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(7, 63, 4, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(7, 63, 10, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(10, 63, 7, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(10, 63, 8, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(10, 63, 9, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(10, 63, 6, BlockLegacyIds::DIRT << 4);
        $chunk->setFullBlock(10, 63, 5, BlockLegacyIds::DIRT << 4);
        }
    }
    public function populateChunk(ChunkManager $world, $chunkX, $chunkY): void{
         }
     }
