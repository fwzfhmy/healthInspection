<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptom_seeds = [
            ['id'=>'1','symptom_name'=>'Mata merah'],
            ['id'=>'2','symptom_name'=>'Jalan Terhuyung hayang'],
            ['id'=>'3','symptom_name'=>'darah drugs postive'],
            ['id'=>'4','symptom_name'=>'Urine Test'],
            ['id'=>'5','symptom_name'=>'Bekas Suntikan di tangan'],
            // ['id'=>'6','symptom_name'=>'Saturday'],
            // ['id'=>'7','symptom_name'=>'Sunday'],
        ];

        foreach ($symptom_seeds as $symptom_seeds)
        {
            Symptom ::firstOrCreate($symptom_seeds);
            
        }
    }
}
