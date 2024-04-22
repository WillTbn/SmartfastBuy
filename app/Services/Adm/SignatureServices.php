<?php

namespace App\Services\Adm;

use App\Enums\ContractStates;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Signature;
use App\Services\CondominiaServices;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignatureServices
{
    private Signature $signatureModel;
    private CondominiaServices $servicesCondominia;
    public function __construct(
        Signature $signatureModel,
        CondominiaServices $servicesCondominia
    )
    {
        $this->servicesCondominia = $servicesCondominia;
        $this->signatureModel = $signatureModel;
    }

    public function setCreate(ContractCondominia $contract)
    {
        logger('Criando assinatura '.__CLASS__);
        try{
            DB::beginTransaction();
            $sig = $this->signatureModel->create([
                'signature_ceo' => Hash::make($contract->ceo->person.$contract->ceo->birthday),
                'contract_condominia_id' => $contract->condominia_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            logger('assinatura criada '.$sig);

            /// Atualizar o status do contract
            $cond = Condominia::find($contract->condominia_id);
            logger('pegando condominio'.$cond);
            $this->servicesCondominia->updatedStatus($cond,ContractStates::Pending);
            DB::commit();
        } catch(Exception $e)
        {
            DB::rollBack();
            logger('Erro na criação da assinatura'.__CLASS__);
            return response()->json(['error' => 'Erro ao grava assinatura', 'exception'=> $e], 402);
        }
    }

}
