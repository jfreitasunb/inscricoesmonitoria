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

        $lista_disciplinas = [1 => 'Matemática (Bacharelado/Licenciatura)', 2 => 'Ciências da Computação (Bacharelado/Licenciatura)', 3 => 'Estatística', 4 => 'Física (Bacharelado/Licenciatura)', 5 => 'Química (Bacharelado/Licenciatura)', 6 => 'Geologia/Geofísica', 7 => 'Engenharia (Mecânica/Elétrica/Civil/Redes/Mecatrônica/Química/Produção)', 8 => 'Outros'];

        for ($i=1; $i < sizeof($lista_disciplinas)+1; $i++) { 
            
            $disciplina = ['id_curso_graduacao' => $i, 'nome_curso' => $lista_disciplinas[$i], 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
            $db_disciplina = DB::table('cursos_graduacao')->insert($disciplina);
        }

        $d1 = ['codigo' => 113115, 'nome' => 'Teoria dos Números', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d1);

        $d2 = ['codigo' => 117323, 'nome' => 'Teoria dos Números 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d2);

        $d3 = ['codigo' => 113263, 'nome' => 'Topologia dos Espaços Métricos', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d3);

        $d4 = ['codigo' => 117145, 'nome' => 'Álgebra 3', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d4);

        $d5 = ['codigo' => 113123, 'nome' => 'Álgebra Linear', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d5);


        $d6 = ['codigo' => 113611, 'nome' => 'Álgebra para Ensino 1 e 2', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d6);

        $d7 = ['codigo' => 113212, 'nome' => 'Análise 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d7);

        $d8 = ['codigo' => 117137, 'nome' => 'Análise 3', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d8);

        $d9 = ['codigo' => 117137, 'nome' => 'Análise Combinatória', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d9);

        $d10 = ['codigo' => 113506, 'nome' => 'Análise Numérica 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d10);


        $d10 = ['codigo' => 113034, 'nome' => 'Cálculo 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d10);

        $d11 = ['codigo' => 113042, 'nome' => 'Cálculo 2', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d11);

        $d12 = ['codigo' => 113051, 'nome' => 'Cálculo 3', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d12);

        $d13 = ['codigo' => 113824, 'nome' => 'Cálculo de Probabilidade 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d13);

        $d14 = ['codigo' => 113832, 'nome' => 'Cálculo de Probabilidade 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        
        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d14);

        $d15 = ['codigo' => 113417, 'nome' => 'Cálculo Numérico', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d15);

        $d16 = ['codigo' => 113301, 'nome' => 'Equações Diferenciais 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d16);

        $d17 = ['codigo' => 113808, 'nome' => 'Fundamentos de Matemática 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d17);

        $d18 = ['codigo' => 117161, 'nome' => 'Geometria 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d18);

        $d19 = ['codigo' => 117170, 'nome' => 'Geometria 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d19);

        $d20 = ['codigo' => 113328, 'nome' => 'Geometria Diferencial 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d20);

        $d21 = ['codigo' => 117471, 'nome' => 'Geometria para o Ensino 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d21);

        $d22 = ['codigo' => 117480, 'nome' => 'Geometria para o Ensino 2', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d22);

        $d23 = ['codigo' => 113522, 'nome' => 'Métodos Matemáticos da Física 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d23);

        $d24 = ['codigo' => 113069, 'nome' => 'Variável Complexa 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d24);

        $d25 = ['codigo' => 117421, 'nome' => 'Álgebra para o Ensino 1', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d25);

        $d26 = ['codigo' => 117501, 'nome' => 'Álgebra para o Ensino 2', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d26);

        $d27 = ['codigo' => 117412, 'nome' => 'Introdução à Teoria da Metida e Integração', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d27);

        $d28 = ['codigo' => 113093, 'nome' => 'Introdução à Álgebra Linear', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d28);

        $d29 = ['codigo' => 117358, 'nome' => 'Lógica Matemática e Computacional', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d29);

        $d30 = ['codigo' => 117102, 'nome' => 'Métodos Matemáticos da Física 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d30);

        $d31 = ['codigo' => 113107, 'nome' => 'Álgebra 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d31);

        $d32 = ['codigo' => 113131, 'nome' => 'Álgebra 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d32);

        $d33 = ['codigo' => 113204, 'nome' => 'Análise 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d33);

        $d34 = ['codigo' => 105881, 'nome' => 'Geometria Analítica para Matemática', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d34);

        $d35 = ['codigo' => 113701, 'nome' => 'Introdução à Matemática Superior', 'creditos' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d35);

        $d37 = ['codigo' => 113018, 'nome' => 'Matemática 1', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d37);

        $d38 = ['codigo' => 113026, 'nome' => 'Matemática 2', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d38);

        $d39 = ['codigo' => 117510, 'nome' => 'Regência 1', 'creditos' => 8, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d39);

        $d40 = ['codigo' => 117439, 'nome' => 'Regência 2', 'creditos' => 8, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d40);

        $d41 = ['codigo' => 113859, 'nome' => 'Análise de Algorítmos', 'creditos' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $db_disciplina_mat = DB::table('disciplinas_mat')->insert($d41);

    }
}
