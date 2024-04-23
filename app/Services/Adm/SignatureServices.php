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
use Illuminate\Support\Facades\Log;

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
        Log::debug('Criando assinatura para o condominioID -> '.$contract->condominia_id);
        try{
            DB::beginTransaction();
            $sig = $this->signatureModel->updateOrCreate(
                ['contract_condominia_id' => $contract->condominia_id],
                [
                    'signature_ceo' => Hash::make($contract->ceo->person.$contract->ceo->birthday),
                    'contract_condominia_id' => $contract->condominia_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            Log::info('assinatura criada '.$sig);

            /// Atualizar o status do contract
            $cond = Condominia::find($contract->condominia_id);
            // Log::info('pegando condominio'.$cond);
            $this->servicesCondominia->updatedStatus($cond,ContractStates::Pending);
            DB::commit();
        } catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Erro na criação da assinatura');
            return response()->json(['error' => 'Erro ao grava assinatura', 'exception'=> $e], 402);
        }
    }

}
