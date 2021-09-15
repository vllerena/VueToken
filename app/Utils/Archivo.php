<?php

namespace App\Utils;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class Archivo
{
    private string $nombre;
    private string $carpeta;
    private $contenido;
    private bool $esVisible;

    public function __construct($file)
    {
        $this->esVisible = true;
        $this->contenido = $file;
    }

    public function setNombre(string $nombre): Archivo
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setCarpeta(string $carpeta): Archivo
    {
        $this->carpeta = $carpeta;
        return $this;
    }

    public function setEsVisible(bool $visible): Archivo
    {
        $this->esVisible = $visible;
        return $this;
    }

    public function getPath()
    {
        return $this->carpeta . '/' . $this->getNombre();
    }

    public function getNombre(): string
    {
        return $this->nombre . '.' . $this->getExtension();
    }

    public function getCarpeta(): string
    {
        return $this->carpeta;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function esVisible(): bool
    {
        return $this->esVisible;
    }

    private function getExtension($ext = 'jpg')
    {
        if ($this->contenido instanceof UploadedFile || $this->contenido instanceof File)
            return $this->contenido->getClientOriginalExtension();
        return $ext;
    }
}
