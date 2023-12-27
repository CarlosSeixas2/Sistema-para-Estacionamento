<?php

namespace App\Http\Controllers;

use App\Models\Vaga;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class VagaController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();

        return view('welcome', ['vagas' => $vagas]);
    }

    public function show($id = null)
    {
        $vaga = Vaga::findOrFail($id);

        $dono = User::find($vaga->usuario_id);
        return view('vaga', ['vaga' => $vaga, 'dono' => $dono]);

    }

    public function exit($id = null)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $vaga = Vaga::find($id);

        if (!$vaga) {
            return redirect('/')->with('error', 'Erro ao finalizar vaga.');
        }

        $horarioSaida = Carbon::now();
        $vaga->horario_saida = $horarioSaida;
        
        $dono = User::find($vaga->usuario_id);
        
        $horarioEntrada = Carbon::parse($vaga->horario_entrada);
        $minutosEstacionado = $horarioSaida->diffInMinutes($horarioEntrada);
        $preco = $minutosEstacionado * 0.5;
        
        $vaga->preco = $preco;
        $vaga->save();
        // return redirect('/')->with('msg', $preco);
        return view('vaga', ['vaga' => $vaga, 'dono' => $dono]);
    }

    public function confirm($dono = null)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $vaga = Vaga::where('usuario_id', $dono)->first();

        if (!$vaga) {
            return redirect('/')->with('error', 'Erro ao finalizar vaga.');
        }

        $vaga->ocupada = 0;
        $vaga->usuario_id = null;
        $vaga->preco = null;
        $vaga->horario_entrada = null;
        $vaga->horario_saida = null;
        $vaga->save();

        $dono = User::find($dono);

        if (!$dono) {
            return redirect('/')->with('error', 'Usuário não encontrado para esta vaga.');
        }

        // $hora_saida = $vaga->horario_saida;

        usleep(390000);

        return redirect('/')->with('success', 'Vaga finalizada com sucesso!');
        // return view('vaga', ['vaga' => $vaga, 'dono' => $dono]);
    }



    public function store($userId, $vagaId){
        date_default_timezone_set('America/Sao_Paulo');

        $vaga = Vaga::find($vagaId);

        if(!$vaga){
            return redirect('/')->with('error', 'Vaga não encontrada.');
        } else if($vaga->ocupada == 1){
            return redirect('/')->with('error', 'Vaga ocupada.');
        }

        $vaga->ocupada = 1;
        $vaga->horario_entrada = Carbon::now();
        $vaga->horario_saida = null;
        $vaga->usuario_id = $userId;

        $vaga->save();

        return redirect('/');
    }

    public function estacionar($id = null){
        if (Auth::check()) {
            $user = Auth::user();

            $vagaExistente = Vaga::where('usuario_id', $user->id)->first();

            if($vagaExistente){
                return redirect('/')->with('error', 'Você já possui uma vaga.');
            }

            $this->store($user->id, $id);
            return redirect('/')->with('success', 'Vaga Reservada com Sucesso!');
        } else{
            return redirect('/login');
        }
    }
}
