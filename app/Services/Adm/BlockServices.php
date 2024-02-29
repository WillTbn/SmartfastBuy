<?php

namespace App\Services\Adm;

use App\Models\Block;

class BlockServices {
    public function deleted(Block $block){
        $block->delete();
    }

    public function getOne(int $id){
        return Block::find($id);
    }
}
