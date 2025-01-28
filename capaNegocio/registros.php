<?php

/**
 * registro.php
 * Módulo secundario que implementa la clase Registro.
 */
/** Incluye la clase. */
include_once '../capaDatos/bdtarea.php';

/**
 * Declaración de la clase Registro
 */
class Registro {

    /**
     * 
     * @var int
     */
    private int $idUsuario;

    /**
     * 
     * @var string
     */
    private string $nombre;

    /**
     * 
     * @var string
     */
    private string $apellidos;

    /**
     * 
     * @var enum
     */
    private enum $estado;

    /**
     * 
     * @var DateTime
     */
    private DateTime $fechaNacimiento;

    /**
     * 
     * @var string
     */
    private string $sexo;

    /**
     * 
     * @param int $idUsuario
     * @return void
     */
    public function setIdUsuario(int $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    /**
     * 
     * @param string $nombre
     * @return void
     */
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * 
     * @param string $apellidos
     * @return void
     */
    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    /**
     * 
     * @param enum $estado
     * @return void
     */
    public function setEstado(enum $estado): void {
        $this->estado = $estado;
    }

    /**
     * 
     * @param DateTime $fechaNacimiento
     * @return void
     */
    public function setFechaNacimiento(DateTime $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * 
     * @param string $sexo
     * @return void
     */
    public function setSexo(string $sexo): void {
        $this->sexo = $sexo;
    }

    /**
     * 
     * @return int
     */
    public function getIdUsuario(): int {
        return $this->idUsuario;
    }

    /**
     * 
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * 
     * @return string
     */
    public function getApellidos(): string {
        return $this->apellidos;
    }

    /**
     * 
     * @return enum
     */
    public function getEstado(): enum {
        return $this->estado;
    }

    /**
     * 
     * @return DateTime
     */
    public function getFechaNacimiento(): DateTime {
        return $this->fechaNacimiento;
    }

    /**
     * 
     * @return string
     */
    public function getSexo(): string {
        return $this->sexo;
    }

    public function leeRegistros(): array {

        $arrayRegistros = array();

        $bdregistro = new BDRegistro();

        foreach ($bdregistro->leeRegistros() as $valor) {
            $this->setIdUsuario($valor['idUsuario']);
            $this->setNombre($valor['nombre']);
            $this->setApellidos($valor['apellidos']);
            $this->setEstado($valor['estado']);
            $this->setFechaNacimiento(new DateTime($valor['fechaNacimiento']));
            $this->setSexo($valor['sexo']);

            $arrayRegistros[] = clone $this;
        }
        return $arrayRegistros;
    }

    public function leeRegistro(): array {

        $arrayRegistros = array();

        $bdregistro = new BDRegistro();

        $bdregistro->setIdUsuario($this->idUsuario);

        foreach ($bdregistro->leeRegistros() as $valor) {
            $this->setIdUsuario($valor['idUsuario']);
            $this->setNombre($valor['nombre']);
            $this->setApellidos($valor['apellidos']);
            $this->setEstado($valor['estado']);
            $this->setFechaNacimiento(new DateTime($valor['fechaNacimiento']));
            $this->setSexo($valor['sexo']);

            $arrayRegistros[] = clone $this;
        }
        return $arrayRegistros;
    }

    public function insertaRegistro(): bool {

        $bdregistro = new BDRegistro();

        $bdregistro->setIdUsuario($this->idUsuario);
        $bdregistro->setNombre($this->nombre);
        $bdregistro->setApellidos($this->apellidos);
        $bdregistro->setEstado($this->estado);
        $bdregistro->setFechaNacimiento($this->fechaNacimiento);
        $bdregistro->setSexo($this->sexo);

        if ($bdregistro->insertaRegistro()) {
            return true;
        }
        return false;
    }

    public function modificaRegistro(): bool {

        $bdregistro = new BDRegistro();

        $bdregistro->setIdUsuario($this->idUsuario);
        $bdregistro->setNombre($this->nombre);
        $bdregistro->setApellidos($this->apellidos);
        $bdregistro->setEstado($this->estado);
        $bdregistro->setFechaNacimiento($this->fechaNacimiento);
        $bdregistro->setSexo($this->sexo);

        if ($bdregistro->modificaRegistro()) {
            return true;
        }
        return false;
    }

    public function eliminaRegistro(): bool {
        $bdregistro = new BDRegistro();

        $bdregistro->setIdUsuario($this->idUsuario);

        if ($bdregistro->eliminaRegistro()) {
            return true;
        }
        return false;
    }
}
