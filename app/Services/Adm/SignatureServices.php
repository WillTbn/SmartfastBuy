<?php

namespace App\Services\Adm;

use App\Models\ContractCondominia;
use App\Models\Signature;
use Exception;
use Illuminate\Support\Facades\Hash;

class SignatureServices
{
    private Signature $signatureModel;
    public function __construct(
        Signature $signatureModel
    )
    {
        $this->signatureModel = $signatureModel;
    }

    public function setCreate(ContractCondominia $contract)
    {
        logger('Criando assinatura '.__CLASS__);
        try{
            $this->signatureModel->create([
                'signature_ceo' => Hash::make($contract->ceo->person.$contract->ceo->birthday),
                'contract_condominia_id' => $contract->condominia_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            logger('assinatura criada '.__CLASS__);
        }catch(Exception $e)
        {
            logger('Erro na criação da assinatura'.__CLASS__);
            return response()->json(['error' => 'Erro ao grava assinatura', 'exception'=> $e], 402);
        }
    }

}
