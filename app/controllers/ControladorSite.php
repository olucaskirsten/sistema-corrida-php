<?php
// CONTROLADOR: SITE
// Mostra as páginas públicas do sistema.

class ControladorSite
{
    public function inicio()
    {
        view('site/inicio');
    }

    public function comoFunciona()
    {
        view('site/como_funciona');
    }

    public function suporte()
    {
        view('site/suporte');
    }
}
