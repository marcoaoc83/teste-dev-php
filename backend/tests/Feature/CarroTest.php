<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarroTest extends TestCase
{
    /** @test */
    public function verifica_cadastro_carro_salva()
    {
        $numero= random_int(1,9999);
        $dados = [
            "marca_id" => 1,
            "modelo" => "Teste Carro",
            "ano" =>$numero
        ];

        $resp=$this->post('api/carros', $dados);

            $resp->assertStatus(200);


    }
}
