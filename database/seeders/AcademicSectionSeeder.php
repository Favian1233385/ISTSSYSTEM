<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicSection;

class AcademicSectionSeeder extends Seeder
{
    public function run()
    {
        $sections = [
            [
                'title' => 'Educación Continua',
                'slug' => 'educacion-continua',
                'description' => 'Programas de capacitación y actualización profesional',
                'content' => 'El Instituto Superior Tecnológico Sucúa ofrece programas de Educación Continua diseñados para profesionales que buscan actualizar sus conocimientos y adquirir nuevas competencias. Nuestros cursos y talleres están orientados a las necesidades del mercado laboral actual y son impartidos por docentes especializados con amplia experiencia en sus áreas.',
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Modalidad Presencial',
                'slug' => 'modalidad-presencial',
                'description' => 'Formación tradicional con contacto directo docente-estudiante',
                'content' => 'Nuestra modalidad presencial ofrece una experiencia educativa completa con clases en nuestras instalaciones modernas y equipadas. Los estudiantes tienen acceso directo a laboratorios, talleres y espacios de aprendizaje colaborativo. El horario vespertino (5:00 PM - 10:00 PM) está diseñado para quienes trabajan durante el día.',
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Modalidad Dual',
                'slug' => 'modalidad-dual',
                'description' => 'Combina teoría en el instituto con práctica en empresas',
                'content' => 'La Modalidad Dual combina la formación teórica en el instituto con períodos de práctica laboral en empresas e instituciones aliadas. Este sistema permite a los estudiantes aplicar inmediatamente los conocimientos adquiridos, desarrollar competencias profesionales reales y establecer contactos en el sector productivo. Las empresas participantes supervisan y evalúan el desempeño de los estudiantes en entornos laborales reales.',
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 3
            ],
        ];

        foreach ($sections as $section) {
            AcademicSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }

        $this->command->info('Secciones académicas creadas exitosamente.');
    }
}
