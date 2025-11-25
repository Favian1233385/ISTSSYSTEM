<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampusItem;

class CampusItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Servicios del Campus
            [
                'title' => 'Investigación, Desarrollo Tecnológico e Innovación',
                'description' => 'Unidad encargada de promover y gestionar proyectos de investigación científica y desarrollo tecnológico',
                'url' => '/campus/investigacion-desarrollo',
                'content' => '<h2>Investigación, Desarrollo Tecnológico e Innovación</h2><p>La Unidad de Investigación, Desarrollo Tecnológico e Innovación del ISTS Sucúa promueve la generación de conocimiento científico y tecnológico mediante proyectos de investigación aplicada que contribuyen al desarrollo sostenible de la región amazónica.</p><p>Nuestras líneas de investigación se enfocan en:</p><ul><li>Desarrollo de software y aplicaciones tecnológicas</li><li>Agricultura sostenible y agroecología</li><li>Innovación educativa</li><li>Gestión empresarial y emprendimiento</li></ul>',
                'is_external' => false,
                'category' => 'servicios',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Vinculación con la Sociedad',
                'description' => 'Programas y proyectos de vinculación que conectan a la institución con la comunidad',
                'url' => '/campus/vinculacion',
                'content' => '<h2>Vinculación con la Sociedad</h2><p>La Unidad de Vinculación con la Sociedad desarrolla proyectos y programas que conectan al ISTS con la comunidad, contribuyendo al desarrollo social, económico y cultural de la región mediante la transferencia de conocimientos y servicios.</p><p>Nuestros programas incluyen:</p><ul><li>Prácticas preprofesionales en instituciones públicas y privadas</li><li>Proyectos comunitarios de desarrollo local</li><li>Capacitación y asistencia técnica a organizaciones</li><li>Servicios profesionales a la comunidad</li></ul>',
                'is_external' => false,
                'category' => 'servicios',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Centro de Formación Integral y de Servicios Especializados',
                'description' => 'Centro que brinda formación complementaria y servicios especializados a estudiantes y comunidad',
                'url' => '/campus/formacion-integral',
                'content' => '<h2>Centro de Formación Integral y de Servicios Especializados</h2><p>El Centro de Formación Integral y de Servicios Especializados ofrece programas de capacitación continua, talleres, cursos especializados y servicios profesionales a la comunidad educativa y al público en general.</p><p>Servicios que ofrecemos:</p><ul><li>Talleres de desarrollo de habilidades blandas</li><li>Cursos de actualización profesional</li><li>Programas de emprendimiento</li><li>Asesoría técnica especializada</li><li>Servicios de consultorías en diferentes áreas</li></ul>',
                'is_external' => false,
                'category' => 'servicios',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Biblioteca',
                'description' => 'Acceso a la biblioteca digital institucional',
                'url' => 'https://biblioteca.istsucua.edu.ec/',
                'content' => null,
                'is_external' => true,
                'category' => 'servicios',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Aseguramiento de la Calidad',
                'description' => 'Unidad responsable de garantizar la calidad educativa y el cumplimiento de estándares',
                'url' => '/campus/aseguramiento-calidad',
                'content' => '<h2>Aseguramiento de la Calidad</h2><p>La Unidad de Aseguramiento de la Calidad trabaja en el diseño, implementación y seguimiento de procesos de mejora continua que garantizan la calidad educativa del ISTS Sucúa, alineándose con los estándares nacionales e internacionales.</p><p>Nuestras funciones incluyen:</p><ul><li>Evaluación y seguimiento de procesos académicos</li><li>Gestión de acreditación y certificaciones</li><li>Implementación de sistemas de gestión de calidad</li><li>Análisis de indicadores de desempeño institucional</li><li>Planes de mejora continua</li></ul>',
                'is_external' => false,
                'category' => 'servicios',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Centro de Idiomas',
                'description' => 'Centro especializado en la enseñanza de idiomas extranjeros',
                'url' => '/campus/centro-idiomas',
                'content' => '<h2>Centro de Idiomas</h2><p>El Centro de Idiomas del ISTS Sucúa ofrece programas de enseñanza de inglés y otros idiomas extranjeros, con metodologías modernas y certificaciones internacionales, contribuyendo al perfil profesional de nuestros estudiantes.</p><p>Programas disponibles:</p><ul><li>Cursos de inglés por niveles (A1-C1)</li><li>Preparación para certificaciones internacionales</li><li>Inglés técnico para carreras específicas</li><li>Talleres de conversación</li><li>Cursos intensivos de verano</li><li>Otros idiomas (francés, portugués)</li></ul>',
                'is_external' => false,
                'category' => 'servicios',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            CampusItem::updateOrCreate(
                ['url' => $item['url']], // Buscar por URL para evitar duplicados
                $item
            );
        }
        
        $this->command->info('Items del Campus creados/actualizados exitosamente.');
    }
}
