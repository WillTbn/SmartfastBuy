<?php
namespace App\Services;

use App\DataTransferObject\Apartment\FloorsDTO;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class ApartmentServices
{
    public function sendCreate( string $block, int $number, int $id): Apartment
    {
        $apartment = new Apartment();
        $apartment->condominia_id = $id;
        $apartment->number = $number;
        $apartment->block = $block;
        $apartment->saveOrFail();
        return $apartment;
    }
    public function getFloors(FloorsDTO $dto): bool
    {
        $verify = Apartment::wher('block_id', $dto->block_id)
            ->whereBetween('number', [$dto->apartment_start, $dto->apartment_finally])
        ->exists();

        return $verify;

    }
    public function countApartaments()
    {
        return DB::table('apartments')->count();
    }
}
