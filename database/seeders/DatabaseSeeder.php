<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            DaysTableSeeder::class,
            SecurityQuestionsSeeder::class,
            SettingsTableSeeder::class,
            AcademicPeriodsTableSeeder::class,
            RoomsTableSeeder::class,
            TimeslotsTableSeeder::class,
            CoursesTableSeeder::class,
            ProfessorsTableSeeder::class,
            ClassesTableSeeder::class,
            CursosTableSeeder::class,
            PerfilTableSeeder::class,
            // RestricaoClassificacaoSeeder::class,
            // BusinessHoursSeeder::class,
            // CursosTableSeeder::class,
            PessoasTableSeeder::class,
            // DisciplinasTableSeeder::class,
            // TurmasTableSeeder::class,
            // TiposSalasTableSeeder::class,
            // DiaSemanaSeeder::class,
             //TipoRestricaoSeeder::class,
            // RestricaoSeed::class,
            MenuSeeder::class
        ]);
        
    }
}
