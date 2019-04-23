<?php

namespace App\Exports;

use App\Asignacion;
use App\User;
use Auth;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsignacionExport implements FromCollection, WithHeadings
{
	public function collection()
	{
		$usuarioActual = Auth::user();

		$asignaciones = DB::select(DB::raw('
		SELECT CONCAT(al.name, " ", al.apellido1, " ", al.apellido2) as Alumno, p.denominacion as Practicas, t.denominacion as Titulacion,
			CONCAT(al.name, " ", al.apellido1, " ", al.apellido2) as TutorAcadémico, CONCAT(al.name, " ", al.apellido1, " ", al.apellido2) as TutorInstitucional,
			inst.denominacion, horasTotales, horasRealizadas, ROUND((100*horasRealizadas / horasTotales), 0) as Avance, e.denominacion as Estado
		FROM asignacions asig
		INNER JOIN users al on al.id = asig.alumno_id
		INNER JOIN users pra on pra.id = asig.tutorAcad_id
		INNER JOIN users pri on pri.id = asig.tutorInst_id
		INNER JOIN practicas p on asig.practica_id = p.id
		INNER JOIN titulacions t on t.id = p.titulacion_id
		INNER JOIN institucions inst on inst.id = pri.institucion_id
		INNER JOIN estadoasignacions e on e.id = asig.estado_id
		WHERE t.director_id = ' . $usuarioActual->id . ';'
		));
        return collect($asignaciones);
    }

	public function headings(): array
	{
		return ['Alumno', 'Prácticas', 'Titulación', 'Tutor Académico', 'Tutor Institucional', 'Institución',
		'Horas totales', 'Horas realiazadas', 'Avance', 'Estado'];
	}
}