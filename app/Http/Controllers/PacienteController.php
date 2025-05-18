<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes=Paciente::all();
        return view ('pacientes.index',compact('pacientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pacientes.create');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function historia()
    {
        return view ('pacientes.historia');
    }


    public function imagenologia()
    {
        return view ('pacientes.imagenologia');
    }


    public function solicitud_laboratorio()
    {
        return view ('pacientes.solicitud_laboratorio');
    }


    public function anamnesis()
    {
        return view ('pacientes.anamnesis');
    }



    public function antecedentes_personales()
    {
        return view ('pacientes.antecedentes_personales');
    }
    public function antecedentes_familiares()
    {
        return view ('pacientes.antecedentes_familiares');
    }
    public function antecedentes_ginecologicos()
    {
        return view ('pacientes.antecedentes_ginecologicos');
    }

    public function examen_fisico()
    {
        return view ('pacientes.examen_fisico');
    }

    public function diagnostico_tratamiento()
    {
        return view ('pacientes.diagnostico_tratamiento');
    }
    public function egreso()
    {
        return view ('pacientes.egreso');
    }


    public function consideraciones_menor()
    {
        return view ('pacientes.consideraciones_menor');
    }


    public function informe()
    {

        return view ('pacientes.informe');
    }


    public function pre_anestesia()
    {
        return view ('pacientes.');
    }


    public function solicitud_banco_sangre()
    {
        return view ('pacientes.solicitud_banco_sangre');
    }


    public function solicitud_imagenes()
    {
        return view ('pacientes.solicitud_imagenes');
    }






    /**
     * Store a newly created resource in storage.
     */
    public function nota_operatoria()
    {
        return view ('pacientes.nota_operatoria');
    }
    public function store(StorePacienteRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }

}
