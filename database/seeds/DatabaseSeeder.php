<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsuarioSeeder::class);
         $this->call(EstadoSeeder::class);
         $this->call(CidadeSeeder::class);
         $this->call(ServicoSeeder::class);
         $this->call(NaturezaJuridica::class);
         $this->call(PerfilSeeder::class);

    }
}

