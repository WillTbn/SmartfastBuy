<?php
namespace App\Services;

use App\DataTransferObject\Apartment\FloorsDTO;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ApartmentServices
{
    public function sendCreate( int $block, int $number, int $condominia_id, $floor = null): Apartment
    {
        $apartment = new Apartment();
        $apartment->condominia_id = $condominia_id;
        $apartment->number = $number;
        $apartment->block_id = $block;
        $apartment->floor = $floor;
        $apartment->saveOrFail();
        return $apartment;
    }
    public function getFloors(FloorsDTO $dto): bool
    {
        $verify = Apartment::where('block_id', $dto->block_id)
            ->whereBetween('number', [$dto->apartment_start, $dto->apartment_finally])
        ->exists();

        return $verify;

    }
    public function getAptCond(int $condomonia): Collection
    {
        $apt = Apartment::where('condominia_id', $condomonia)->get();
        return $apt;
    }
    public function countApartaments()
    {
        return DB::table('apartments')->count();
    }
    public function existsAp(int $block, int $number)
    {
        $exist = Apartment::where('block_id', $block)->where('number', $number)->first();

        return $exist;
    }
}
