<?php

/**
 * bdtarea.php
 * Módulo secundario que implementa la clase BDTarea.
 */
/** Incluir la clase base. */
include_once 'bdgestion.php';

/**
 * Declaración de la clase BDTarea.
 */
class BDRegistro extends BDGestion {

    /**
     * 
     * @var type
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

    /**
     * Método que lee todas los Registros de la base de datos.
     *
     * @access public
     * @return array[]:array[]:string Array de registros.
     */
    public function leeRegistros(): array {
        /** @var array[]:array[]:string con los datos de las tareas. */
        $arrayRegistros = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
                 FROM Registros");
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existen tareas. */
                if ($resultado->rowCount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayRegistros = $resultado->fetchAll();
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arrayRegistros;
    }

    /**
     * Método que lee un los Registro de la base de datos.
     *
     * @access public
     * @return array[]:array[]:string Array de registros.
     */
    public function leeRegistro(): array {
        /** @var array[]:array[]:string con los datos de las tareas. */
        $arrayRegistros = array();
        //var_dump($this->email);
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM Registros
				 WHERE idUsuario = :idUsuario");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario', $this->idUsuario);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayRegistros = $resultado->fetchAll();
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arrayRegistros;
    }

    /**
     * Método que inserta una nuevo registro en la base de datos
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function insertaRegistro(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "INSERT INTO Registros (idUsuario, nombre, apellidos, estado, fechaNacimiento, sexo)
				 VALUES (:idUsuario, :nombre, :apellidos, :estado, :fechaNacimiento, :sexo)");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario', $this->idUsuario);
            $resultado->bindParam(':nombre', $this->nombre);
            $resultado->bindParam(':apellidos', $this->apellidos);
            $resultado->bindParam(':estado', $this->estado);
            $fechaNacimiento = $this->fechaNacimiento->format('Y-m-d');
            $resultado->bindParam(':fechaNacimiento', $fechaNacimiento);
            $resultado->bindParam(':sexo', $this->sexo);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Devuelve true si se ha conseguido. */
                return true;
            }
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que elimina una tarea existente de la base de datos.
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function eliminaRegistro(): bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"DELETE FROM Registros
				 WHERE idUsuario = :idUsuario");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idUsuario', $this->idUsuario);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
    }
    
 /**
	 * Método que modifica los campos de una registro de la base de datos.
	 * 
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function modificaRegistro(): bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"UPDATE Registros
				 SET idUsuario = :idUsuario,
					 nombre = :nombre,
					 apellidos = :apellidos,
					 estado = :estado,
					 fechaNacimiento = :fechaNacimiento
				 WHERE sexo = :sexo");
			/** Vincula los parámetros a los nombre de variables especificado. */
			$resultado->bindParam(':idUsuario', $this->idUsuario);
			$resultado->bindParam(':nombre', $this->nombre);
                        $resultado->bindParam(':apellidos', $this->apellidos);
                        $resultado->bindParam(':estado', $this->estado);
			$fechaNacimiento = $this->getFechaNacimiento()->format('Y-m-d');
			$resultado->bindParam(':fechaNacimiento', $fechaNacimiento);
			$resultado->bindParam(':sexo', $this->sexo);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
}
