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
    private CondominiaServices $servicesCondominia;
    public function __construct(
        Signature $signatureModel,
        CondominiaServices $servicesCondominia
    )
    {
        Log::alert('Estou no alert');
        $this->servicesCondominia = $servicesCondominia;
    }

    public function setCreate(ContractCondominia $contract)
    {
        Log::debug('Criando assinatura para o condominioID -> '.$contract->condominia_id);
        Log::debug('O ceo vai assianar -> '.$contract->ceo);
        try{
            DB::beginTransaction();
            $sig = Signature::create([
                    'signature_ceo' => Hash::make($contract->ceo->person.$contract->ceo->birthday),
                    'contract_condominia_id' => $contract->condominia_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            Log::info('assinatura criada '.$sig);

            /// Atualizar o status do contract
            $cond = Condominia::find($contract->condominia_id);
            // Log::info('pegando condominio'.$cond);
            $this->servicesCondominia->updatedStatus($cond,ContractStates::Pending);
            DB::commit();
        } catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Erro na criação da assinatura do ceo');
            Log::error('exception '.$e);
            return redirect()->back()->with('error', 'Problema na inserção no banco de dados!');
        }
    }
    public function updateStart(ContractCondominia $contract)
    {
        Log::debug('Criando reponsible vai assina o contrato -> '.$contract);
        Log::debug('Criando reponsible vai assina o contrato do condominioID -> '.$contract->condominia_id);

        try{
            DB::beginTransaction();
            $sig = Signature::updateOrCreate(
                ['contract_condominia_id' => $contract->condominia_id],
                [
                    'signature_responsible' => Hash::make($contract->responsible->person.$contract->responsible->birthday),
                    'updated_at' => now(),
                ]
            );
            Log::info('assinatura criada '.$sig);

            /// Atualizar o status do contract
            $cond = Condominia::find($contract->condominia_id);
            // Log::info('pegando condominio'.$cond);
            $this->servicesCondominia->updatedStatus($cond,ContractStates::Start);
            DB::commit();
        } catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Erro na criação da assinatura');
            Log::error('exception '.$e);
            return redirect()->back()->with('error', 'Problema na inserção no banco de dados!');
        }
    }

}
