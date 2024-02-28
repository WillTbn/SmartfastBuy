<?php

namespace App\Services\Adm;

use App\Models\Block;

class BlockServices {
    public function deleted(Block $block){
        $block->delete();
    }
}
