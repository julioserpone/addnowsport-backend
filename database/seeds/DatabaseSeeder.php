<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(ImagenTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermisosTableSeeder::class);
        $this->call(BancosTableSeeder::class);
        $this->call(DatosBancariosTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(MovimientosTableSeeder::class);
        $this->call(PerfilesTableSeeder::class);
        $this->call(SaldoUsuarioTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(ProductorasTableSeeder::class);
        $this->call(DetalleCuentasProductorasTableSeeder::class);
        $this->call(TransferenciasTableSeeder::class);
        $this->call(DisciplinasTableSeeder::class);
        $this->call(CircuitosTableSeeder::class);
        $this->call(CompetenciasTableSeeder::class);
        $this->call(CircuitosCompetenciasTableSeeder::class);
        $this->call(PuntajesTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(TemplateSliderTableSeeder::class);
        $this->call(TemplateImagenTableSeeder::class);
        $this->call(PremiosTableSeeder::class);
        $this->call(FechaTableSeeder::class);
        $this->call(GrupoTableSeeder::class);
        $this->call(DistanciasTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(DistanciaCategoriasTableSeeder::class);
        $this->call(DistanciaFechaTableSeeder::class);
        $this->call(MensajeTableSeeder::class);
        $this->call(CodigosTableSeeder::class);
        $this->call(CodigoUsadoSeeder::class);;
        $this->call(TeamTableSeeder::class);
        $this->call(TeamUsuarioTableSeeder::class);
        $this->call(InscriptosTableSeeder::class);
    }
}
