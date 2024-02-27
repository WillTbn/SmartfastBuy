<?php

namespace App\Services;

use App\Models\Block;
use Illuminate\Database\Eloquent\Collection;

class BlockServices
{
    public function createdBlock(string $name, int $condominia_id)
    {
        $block = new Block();
        $block->name = $name;
        $block->condominia_id = $condominia_id;
        $block->saveOrFail();
        return $block;

    }
    public function getAllBlock(int $condominia): Collection
    {
        $blocks = Block::with('apartments')->where('condominia_id', $condominia)->get();
        return $blocks;
    }
    public function getBlock(int $block_id)
    {
        $block = Block::where('id', $block_id)->get();
        return $block;
    }
}
