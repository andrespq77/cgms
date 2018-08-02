<?php

    use App\Canton;
    use App\Province;
    use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = $path = storage_path() . "/assets/ecuador.json";

        $provinces = json_decode(file_get_contents($path), true);


        foreach ($provinces as $province){

            $this->command->getOutput()->writeln('Adding Province: '.$province['Province SN'] . ' '.$province['Province']);
            $this->command->getOutput()->writeln('cantons count '.count($province['cantons']));

            $addProvince = new Province();
            $addProvince->name = $province['Province'];
            $addProvince->save();


            foreach ($province['cantons'] as $canton){

                $this->command->getOutput()->writeln('Adding cantons: '.$canton['Canton']);

                $addCanton = new Canton();
                $addCanton->name = $canton['Canton'];
                $addCanton->capital = $canton['Capital'];
                $addCanton->province_id = $addProvince->id;
                $addCanton->save();

            }

        }
    }
}
