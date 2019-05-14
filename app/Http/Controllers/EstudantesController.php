<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EstudantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


      public function index()
      {

          return \App\Estudante::all();


      }


    public function estudante($id){
      $query = DB::table('estudantes');
      $query->select('*');
      $query->where('id', '=', $id);

      $rows = $query->get()->toArray();
      return json_encode($rows);
    }

    public function endereco($id)
    {
      $query = DB::table('enderecos');
      $query->select('*');
      $query->where('estudante', '=', $id);

      $rows = $query->get()->toArray();
      return json_encode($rows);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mae($id)
    {

      $query = DB::table('maes');
      $query->select('*');
      $query->where('estudante', '=', $id);

      $rows = $query->get()->toArray();

      return json_encode($rows);

    }



    public function cep($cep)
    {
      try{
        $statusCode = 400;
        $endpoint = "https://viacep.com.br/ws/$cep/json/";

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
      }

      finally{
      if($statusCode == 400)
        return "vazio";
      }

      return $content;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastra(Request $request)
    {


        DB::table('estudantes')->insert(['nome' => $request->nome,
        'nascimento' => $request->nascimento, 'serie_ingresso' => $request->serie_ingresso]);

        $id = DB::table('estudantes')->max('id');


        DB::table('enderecos')->insert(['estudante' => $request->estudante,
        'cep' => $request->cep, 'rua'=>$request->rua, 'numero'=>$request->numero, 'complemento' => $request->complemento, 'bairro' => $request->bairro, 'cidade' => $request->cidade, 'estado' => $request->estado, 'estudante' => $id]);


        DB::table('maes')->insert(['nome' => $request->nomeMae,'cpf' => $request->cpf, 'data_pagamento'=>$request->data_pagamento, 'estudante' => $id]);

        return redirect()->route('alunos', ['cod' => "sucess"]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      DB::table('estudantes')
          ->where('id', $id)
          ->update(['nome' => $request->nome,
          'nascimento' => $request->nascimento,
          'serie_ingresso' => $request->serie_ingresso]
          );

      DB::table('enderecos')
              ->where('estudante', $id)
              ->update(['estado' => $request->estado,
              'cidade' => $request->cidade,
              'cep' => $request->cep,
              'rua' => $request->rua,
              'numero' => $request->numero,
              'complemento' => $request->complemento,
              'bairro' => $request->bairro
            ]);

      DB::table('maes')
              ->where('estudante', $id)
              ->update(['nome' => $request->nomeMae,
              'cpf' => $request->cpf,
              'data_pagamento' => $request->data_pagamento]
              );

              return redirect()->route('alunos', ['cod' => "sucess"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
          DB::table('estudantes')->delete([$id]);
          return '{"resultado" : "sucesso"}';
    }

}
