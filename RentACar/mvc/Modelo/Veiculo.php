<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Veiculo extends Modelo
{
    const INSERIR = 'INSERT INTO veiculos(chassi, montadora, modelo, id_categoria, preco_diaria,
    status_oficina, status_locacao) VALUES (?, ?, ?, ?, ?, ?, ?)';
    const ATUALIZAR = 'UPDATE veiculos SET montadora = ?, modelo = ?, id_categoria = ?, preco_diaria = ? WHERE id = ?';
    const BUSCAR_NOME_CATEGORIA = 'SELECT nome from categorias where categorias.id = ?';
    const BUSCAR_ID = 'SELECT id, chassi FROM veiculos WHERE id = ?';
    const BUSCAR_REGISTRO = 'SELECT * FROM veiculos WHERE chassi= ?';

    private $chassi;
    private $montadora;
    private $modelo;
    private $idCategoria;
    private $precoDiaria;
    private $foto;
    private $statusOficina;
    private $statusLocacao;
    private $id;


    public function __construct(
        $chassi,
        $montadora,
        $modelo,
        $idCategoria = 1,
        $precoDiaria,
        $foto = null,
        $statusOficina = 0,
        $statusLocacao = 0,
        $id = null
    ) {
        $this->chassi =  $chassi;
        $this->montadora = $montadora;
        $this->modelo = $modelo;
        $this->idCategoria = $idCategoria;
        $this->precoDiaria = $precoDiaria;
        $this->statusOficina = $statusOficina;
        $this->statusLocacao =  $statusLocacao;
        $this->id = $id;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getChassi()
    {
        return $this->chassi;
    }

    public function setChassi($chassi)
    {
        $this->chassi = $chassi;
    }

    public function getMontadora()
    {
        return $this->montadora;
    }

    public function setMontadora($montadora)
    {
        $this->montadora = $montadora;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function getPrecoDiaria()
    {
        return $this->precoDiaria;
    }

    public function setPrecoDiaria($precoDiaria)
    {
        $this->precoDiaria = $precoDiaria;
    }

    public function getStatusOficina()
    {
        return $this->statusOficina;
    }

    public function setStatusOficina($statusOficina)
    {
        $this->statusOficina = $statusOficina;
    }

    public function getStatusLocacao()
    {
        return $this->statusLocacao;
    }

    public function setStatusLocacao($statusLocacao)
    {
        $this->statusLocacao = $statusLocacao;
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
            $this->salvarImagem();
        } else {
            $this->atualizar();
        }
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->chassi);
        $comando->bindValue(2, $this->montadora);
        $comando->bindValue(3, $this->modelo);
        $comando->bindValue(4, $this->idCategoria);
        $comando->bindValue(5, $this->precoDiaria);
        $comando->bindValue(6, $this->statusOficina);
        $comando->bindValue(7, $this->statusLocacao);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->montadora);
        $comando->bindValue(2, $this->modelo);
        $comando->bindValue(3, $this->idCategoria);
        $comando->bindValue(4, $this->precoDiaria);
        $comando->bindValue(5, $this->id);
        $comando->execute();
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.jpg";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.jpg';
        }
        return $imagemNome;
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.jpg";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();

        return new Veiculo(
            $registro['chassi'],
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $registro['id']
        );
    }

    public static function buscarRegistroVeiculo($chassi)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_REGISTRO);
        $comando->bindValue(1, $chassi, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        return new Veiculo(
            $registro['chassi'],
            $registro['montadora'],
            $registro['modelo'],
            $registro['id_categoria'],
            $registro['preco_diaria'],
            null,
            $registro['status_oficina'],
            $registro['status_locacao'],
            $registro['id']
        );
    }

    public function nomeCategoria($idCategoria)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME_CATEGORIA);
        $comando->bindValue(1, $idCategoria);
        $comando->execute();
        $registro = $comando->fetch();

        return $registro['nome'];
    }

    public function chassiExiste($veiculo)
    {
        $registroVeiculo = self::buscarRegistroVeiculo($veiculo->getChassi());

        if ($registroVeiculo->getChassi() !== null) {
            $veiculo->setErroMensagem('chassi', 'Este Chassi já consta em nossa base de dados...');
            return true;
        } else {
            return false;
        }
    }

    protected function verificarErros()
    {
        $patternChassi = "/^([0-9]|[a-z]){4,17}$/";
        $patternMontadora = "/^(([0-9]|[a-z]){2,10}\s{0,1}){1,5}$/";
        $patternModelo = "/^(([0-9]|[a-z]){1,10}\s{0,1}){1,3}$/";
        $patternPrecoDiaria = "/^[1-9]{1}([0-9]{1,2})?\.([0-9]{1,3})?$/";

        if (preg_match($patternChassi, $this->chassi) == false) {
            $this->setErroMensagem('chassi', 'Chassi não pode ser vazio. Deve conter no mínimo 4 
            e no máximo 17 carácter.');
        }


        if (preg_match($patternMontadora, $this->montadora) == false) {
            $this->setErroMensagem('montadora', 'Não pode ser vazio. Deve conter no mínimo 2
            e no máximo 60 carácter.');
        }


        if (preg_match($patternModelo, $this->modelo) == false) {
            $this->setErroMensagem('modelo', 'Não pode ser vazio. Deve conter no mínimo 32
            e no máximo 25 carácter.');
        }


        if (preg_match($patternPrecoDiaria, $this->precoDiaria) == false) {
            $this->setErroMensagem('precoDiaria', 'Valor mínimo R$1 e máximo R$999.999.
            Usar "."(ponto) para valores fracionado e não ","(vírgula).');
        }
    }
}
