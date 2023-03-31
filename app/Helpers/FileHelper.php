<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile as File;

class FileHelper
{

    /**
     * @param string $type string indicara qual tipo(para video ou image) de tratamentos iremos fazer
     * @param string $url string diretorio
     * $identifier $id do usuario
     */
    public function removeFile(string $url, int $identifier)
    {
        $str = explode($identifier, $url);
        $nameFile =  end($str);
        Storage::disk('public')->delete($identifier.'/'.$nameFile);
    }
    /**
     * $type string indica qual tratamento(array) retornara
     */
    public function AllowedType(string $type):array
    {

        $res = null;

        $value = [
            'image' => ['image/jpg', 'image/jpeg', 'image/png'],
            'doc'   => ['application/pdf', 'image/jpeg', 'image/png'],
            'video' => ['video/mpg', 'video/mp4', 'video/mp2g', 'video/mkv', 'video/x-matroska']
        ];

        foreach($value as $key => $item){
            if($key === $type){
                $res = $item;
            }
        }

        if(isset($res))
            return $res;
    }
    /**
     * Destinado a retorna dados universais
     * $url da aplicação
     */
    public function url():string
    {
        $url = env('APP_URL');
        return $url;
    }
    /**
     * Destinado a retorna dados universais com storage
     * $url da aplicação
     */
    public function urlStorage():string
    {
        $url = env('APP_URL').'storage/';
        return $url;
    }

    public function createdImageProduct(
        string $product,
        File $file_one,
        //?File $file_two = null, AINDA AVALIANDO NECESSIDADE
        //?File $file_tree = null AINDA AVALIANDO NECESSIDADE
    ):string
    {

        if(in_array($file_one->getClientMimeType(), $this->AllowedType('image'))){
            $url = $file_one->store($product, 'public');
            return $url;
        }

    }
}
