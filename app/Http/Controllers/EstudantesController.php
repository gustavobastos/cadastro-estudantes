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
          //
          return \App\Estudante::all();
      }


    public function estudante($id){
      $query = DB::table('estudantes');
      $query->select('*');
      $query->where('id', '=', $id);

      $rows = $query->get()->toArray();
      return json_encode($rows[0]);
    }

    public function endereco($id)
    {
      $query = DB::table('endereco');
      $query->select('*');
      $query->where('id', '=', $id);

      $rows = $query->get()->toArray();
      return json_encode($rows[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mae($id)
    {
      $query = DB::table('estudantes');
      $query->select('mae');
      $query->where('id', '=', $id);

      $rows = $query->get()->toArray();
      $mae =  $rows[0]->mae;


      $query = DB::table('maes');
      $query->select('*');
      $query->where('cpf', '=', $mae);

      $rows = $query->get()->toArray();

      return json_encode($rows[0]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return \App\Estudante::create($request->all());
        // Insert

        DB::table('enderecos')->insert(['estudante' => $request->estudante,
        'cep' => $request->cep, 'rua'=>$request->rua, 'numero'=>$request->numero, 'complemento' => $request->complemento, 'bairro' => $request->bairro, 'cidade' => $request->cidade, 'estado' => $request->estado]);

        DB::table('maes')->insert(['nome' => $request->nomeMae,'cpf' => $request->cpfMae, 'data_pagamento'=>$request->dataPagamento]);

        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

          DB::table('estudantes')->delete(["$request->id"]);
          return "sucesso";
    }
}
