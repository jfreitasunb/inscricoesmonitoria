<?php

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
    	$user = ['nome' => 'Coordenador','login' => 'coord', 'email' => 'coord@mat.unb.br', 'password' => bcrypt('1'), 'user_type' => '2' , 'ativo' => '1', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $db_user = DB::table('users')->insert($user);


        $configura_monitoria = ['ano_monitoria' => '2017','semestre_monitoria' => '1', 'inicio_inscricao' => '2017-04-01', 'fim_inscricao' => '2017-07-31', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $db_configura_monitoria = DB::table('configura_monitoria')->insert($configura_monitoria);

        $configura_monitoria2 = ['ano_monitoria' => '2017','semestre_monitoria' => '2', 'inicio_inscricao' => '2017-08-01', 'fim_inscricao' => '2017-08-04', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $db_configura_monitoria2 = DB::table('configura_monitoria')->insert($configura_monitoria2);
    }
}
