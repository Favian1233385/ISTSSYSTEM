<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'title' => 'Secretaría General',
                'slug' => 'secretaria-general',
                'mission' => 'La Secretaría General del Instituto Superior Tecnológico Sucúa es el órgano responsable de la gestión administrativa y académica de la institución, garantizando el correcto funcionamiento de todos los procesos institucionales.',
                'functions' => json_encode([
                    'Gestión y custodia de documentos institucionales',
                    'Certificación de títulos y documentos académicos',
                    'Atención a estudiantes y público en general',
                    'Coordinación de procesos administrativos',
                    'Gestión de archivo institucional',
                    'Apoyo a la comunidad educativa en trámites administrativos',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo, Planta Baja',
                'phone' => '(07) 274-0XXX ext. 101',
                'email' => 'secretaria@istssucua.edu.ec',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Asesoría Jurídica',
                'slug' => 'asesoria-juridica',
                'mission' => 'La Asesoría Jurídica del ISTS brinda soporte legal y orientación en todos los aspectos jurídicos de la institución, garantizando el cumplimiento de la normativa vigente y velando por los derechos de la comunidad educativa.',
                'functions' => json_encode([
                    'Asesoramiento legal a autoridades y personal institucional',
                    'Revisión y elaboración de contratos y convenios',
                    'Gestión de procesos legales y administrativos',
                    'Interpretación y aplicación de normativa educativa',
                    'Orientación en derechos y deberes estudiantiles',
                    'Apoyo en procedimientos disciplinarios',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo, Segundo Piso',
                'phone' => '(07) 274-0XXX ext. 102',
                'email' => 'asesoriajuridica@istssucua.edu.ec',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bienestar Institucional',
                'slug' => 'bienestar-institucional',
                'mission' => 'El Departamento de Bienestar Institucional promueve el desarrollo integral de la comunidad educativa, ofreciendo servicios de apoyo social, psicológico y de salud que contribuyen al bienestar de estudiantes y personal del ISTS.',
                'functions' => json_encode([
                    'Atención psicológica a estudiantes',
                    'Programas de orientación vocacional',
                    'Gestión de becas y ayudas estudiantiles',
                    'Promoción de estilos de vida saludables',
                    'Apoyo en situaciones de crisis',
                    'Coordinación de actividades deportivas y culturales',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio de Servicios Estudiantiles',
                'phone' => '(07) 274-0XXX ext. 103',
                'email' => 'bienestar@istssucua.edu.ec',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Unidad Administrativa',
                'slug' => 'unidad-administrativa',
                'mission' => 'La Unidad Administrativa gestiona los recursos financieros, materiales y humanos del ISTS, garantizando la eficiencia en el uso de recursos y el cumplimiento de objetivos institucionales.',
                'functions' => json_encode([
                    'Gestión presupuestaria y financiera',
                    'Adquisiciones y contrataciones públicas',
                    'Control de activos institucionales',
                    'Administración de recursos materiales',
                    'Elaboración de informes financieros',
                    'Coordinación con proveedores',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo, Primer Piso',
                'phone' => '(07) 274-0XXX ext. 104',
                'email' => 'administrativa@istssucua.edu.ec',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Seguridad y Salud Ocupacional',
                'slug' => 'seguridad-salud-ocupacional',
                'mission' => 'Garantizar un ambiente seguro y saludable para toda la comunidad educativa mediante la prevención de riesgos y la promoción de buenas prácticas de seguridad.',
                'functions' => json_encode([
                    'Identificación y evaluación de riesgos laborales',
                    'Capacitación en seguridad y salud',
                    'Investigación de incidentes y accidentes',
                    'Elaboración de planes de emergencia',
                    'Inspecciones periódicas de seguridad',
                    'Promoción de cultura de prevención',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo',
                'phone' => '(07) 274-0XXX ext. 105',
                'email' => 'seguridadsalud@istssucua.edu.ec',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Tecnologías de la Información',
                'slug' => 'tecnologias-informacion',
                'mission' => 'Proporcionar soporte tecnológico y mantener la infraestructura de sistemas de información del ISTS, garantizando la disponibilidad y seguridad de los servicios digitales.',
                'functions' => json_encode([
                    'Mantenimiento de infraestructura tecnológica',
                    'Soporte técnico a usuarios',
                    'Administración de redes y servidores',
                    'Desarrollo y actualización de sistemas',
                    'Seguridad informática',
                    'Capacitación en herramientas digitales',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Centro de Cómputo',
                'phone' => '(07) 274-0XXX ext. 106',
                'email' => 'ti@istssucua.edu.ec',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Planificación Estratégica',
                'slug' => 'planificacion-estrategica',
                'mission' => 'Coordinar el proceso de planificación institucional, seguimiento y evaluación del cumplimiento de objetivos estratégicos del ISTS.',
                'functions' => json_encode([
                    'Elaboración del plan estratégico institucional',
                    'Seguimiento de indicadores de gestión',
                    'Evaluación de proyectos institucionales',
                    'Elaboración de informes de gestión',
                    'Coordinación con unidades académicas',
                    'Apoyo en procesos de acreditación',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo',
                'phone' => '(07) 274-0XXX ext. 107',
                'email' => 'planificacion@istssucua.edu.ec',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Unidad de Comunicación',
                'slug' => 'unidad-comunicacion',
                'mission' => 'Gestionar la comunicación institucional interna y externa, fortaleciendo la imagen del ISTS y manteniendo informada a la comunidad educativa.',
                'functions' => json_encode([
                    'Gestión de redes sociales institucionales',
                    'Elaboración de material comunicacional',
                    'Cobertura de eventos institucionales',
                    'Diseño gráfico y audiovisual',
                    'Relaciones con medios de comunicación',
                    'Actualización de sitio web institucional',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo',
                'phone' => '(07) 274-0XXX ext. 108',
                'email' => 'comunicacion@istssucua.edu.ec',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Talento Humano',
                'slug' => 'talento-humano',
                'mission' => 'Gestionar el desarrollo y bienestar del personal docente y administrativo del ISTS, promoviendo un ambiente laboral favorable y el crecimiento profesional.',
                'functions' => json_encode([
                    'Reclutamiento y selección de personal',
                    'Capacitación y desarrollo profesional',
                    'Evaluación de desempeño',
                    'Gestión de nómina y beneficios',
                    'Administración de expedientes laborales',
                    'Programas de bienestar laboral',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo',
                'phone' => '(07) 274-0XXX ext. 109',
                'email' => 'talentohumano@istssucua.edu.ec',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Relaciones Internacionales',
                'slug' => 'relaciones-internacionales',
                'mission' => 'Promover y gestionar la cooperación internacional del ISTS mediante convenios, intercambios y proyectos con instituciones extranjeras.',
                'functions' => json_encode([
                    'Gestión de convenios internacionales',
                    'Coordinación de programas de movilidad',
                    'Apoyo a estudiantes en intercambios',
                    'Búsqueda de oportunidades de cooperación',
                    'Organización de eventos internacionales',
                    'Seguimiento de proyectos de cooperación',
                ]),
                'schedule' => 'Lunes a Viernes, 08:00 - 17:00',
                'location' => 'Edificio Administrativo',
                'phone' => '(07) 274-0XXX ext. 110',
                'email' => 'internacional@istssucua.edu.ec',
                'sort_order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            DB::table('visit_sections')->insert(array_merge($section, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
