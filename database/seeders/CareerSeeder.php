<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $careers = [
            [
                'name' => 'Desarrollo de Software',
                'slug' => 'desarrollo-software',
                'description' => 'Tecnología Superior en Desarrollo de Software',
                'full_description' => 'Formar profesionales con pensamiento crítico, creativo y ético; capaz de analizar, diseñar, codificar e implementar sistemas informáticos mediante la aplicación de metodologías de software para satisfacer las necesidades del mercado; basados en la ciencia de la matemática aplicada, enfocada a fortalecer el sector de la tecnología y sus usuarios, difundiendo los avances tecnológicos y resolviendo por medio de la sistematización problemas presentados en las empresas y la sociedad en general aplicando competencias profesionales mediante la formación de talento humano que procese las aplicaciones de forma supervisada trabajando en equipos bajo estándares de codificación, aportando significativamente a la transformación social, dentro de los contextos enmarcados en la productividad nacional.',
                'professional_profile' => 'Analizar los requerimientos del usuario mediante metodologías de desarrollo de software. Desarrollar sistemas informáticos de escritorio, web y aplicaciones móviles. Codificar sistemas informáticos utilizando lenguajes de programación de última generación. Implementar el software elaborado en un ambiente de trabajo.',
                'coordinator' => 'Ing. Juan Pérez',
                'coordinator_email' => 'juan.perez@istsucua.edu.ec',
                'image_path' => null,
                'image_path_2' => null,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Contabilidad y Asesoría Tributaria',
                'slug' => 'contabilidad-asesoria-tributaria',
                'description' => 'Tecnología Superior en Contabilidad y Asesoría Tributaria',
                'full_description' => 'Formar profesionales con competencias técnicas, metodológicas y sociales para ejercer actividades de contabilidad general, costos, auditoría, tributación y gestión financiera en organizaciones públicas y privadas. El tecnólogo estará capacitado para realizar registros contables, elaborar estados financieros, interpretar información económica, asesorar en materia tributaria y contribuir a la toma de decisiones gerenciales mediante el análisis de indicadores financieros, promoviendo prácticas éticas y transparentes que fortalezcan el desarrollo económico sostenible de la región.',
                'coordinator' => null,
                'coordinator_email' => null,
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Agroecología',
                'slug' => 'agroecologia',
                'description' => 'Tecnología Superior en Agroecología',
                'full_description' => 'Formar profesionales con conocimientos técnicos, científicos y prácticos en producción agroecológica sostenible, capaces de diseñar, implementar y gestionar sistemas productivos que integren principios ecológicos, económicos y sociales. El tecnólogo estará capacitado para aplicar prácticas de agricultura orgánica, conservación de suelos, manejo integrado de plagas, agroforestería y desarrollo rural sustentable, promoviendo la seguridad alimentaria, la biodiversidad y el respeto por los conocimientos ancestrales, contribuyendo así al fortalecimiento de las comunidades rurales y al desarrollo sostenible de la región amazónica.',
                'coordinator' => null,
                'coordinator_email' => null,
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Educación Inicial',
                'slug' => 'educacion-inicial',
                'description' => 'Tecnología Superior en Educación Inicial',
                'full_description' => 'Formar profesionales con competencias pedagógicas, didácticas y humanísticas para atender integralmente el desarrollo de niños y niñas de 0 a 5 años. El tecnólogo estará capacitado para diseñar, implementar y evaluar procesos educativos basados en metodologías activas, el juego y la experimentación, promoviendo el desarrollo cognitivo, socio-afectivo, psicomotriz y del lenguaje. Con sólidos conocimientos en psicología infantil, neurociencia aplicada a la educación y atención a la diversidad, el profesional contribuirá al desarrollo integral de la primera infancia, trabajando de manera colaborativa con familias y comunidades para garantizar ambientes de aprendizaje seguros, inclusivos y estimulantes.',
                'coordinator' => null,
                'coordinator_email' => null,
                'image_path' => null,
                'is_active' => true,
                'sort_order' => 4
            ],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(
                ['slug' => $career['slug']],
                $career
            );
        }

        $this->command->info('Carreras actualizadas exitosamente.');
    }
}
