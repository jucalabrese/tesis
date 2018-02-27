<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// Incluimos el archivo fpdf
require_once APPPATH . "/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class PDF extends FPDF {

    public function __construct() {
        parent::__construct();
    }

    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', '', 8);
        /* Cell(ancho, alto, txt, border, ln, alineacion)
         * ancho=0, extiende el ancho de celda hasta el margen de la derecha
         * alto=10, altura de la celda a 10
         * txt= Texto a ser impreso dentro de la celda
         * border=T Pone margen en la posición Top (arriba) de la celda
         * ln=0 Indica dónde sigue el texto después de llamada a Cell(), en este caso con 0, enseguida de nuestro texto
         * alineación=C Texto alineado al centro
         */
        $this->Cell(0, 10, utf8_decode('SEP - Sistema de Evaluación de Producto'), 'T', 0, 'C');
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Header() {
//Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial', 'B', 18);
        /* Líneas paralelas
         * Line(x1,y1,x2,y2)
         * El origen es la esquina superior izquierda
         * Cambien los parámetros y chequen las posiciones
         * */
        $this->Line(10, 10, 206, 10);
        $this->Line(10, 35.5, 206, 35.5);
        /* Explicaré el primer Cell() (Los siguientes son similares)
         * 30 : de ancho
         * 25 : de alto
         * ' ' : sin texto
         * 0 : sin borde
         * 0 : Lo siguiente en el código va a la derecha (en este caso la segunda celda)
         * 'C' : Texto Centrado
         * $this->Image('images/logo.png', 152,12, 19) Método para insertar imagen
         *     'images/logo.png' : ruta de la imagen
         *         152 : posición X (recordar que el origen es la esquina superior izquierda)
         *         12 : posición Y
         *     19 : Ancho de la imagen <span class="wp-smiley emoji emoji-wordpress" title="(w)">(w)</span>
         *     Nota: Al no especificar el alto de la imagen (h), éste se calcula automáticamente
         * */
        $this->Cell(0, 25, 'Evaluacion de producto: ' . $GLOBALS['nombreProd'], 0, 0, 'C');
//Se da un salto de línea de 25
        $this->Ln(35);
    }

    /* function FancyTableWithNItems($header, $users, $votos, $n) {
      $this->SetAutoPageBreak(false, 0);
      $arregloPartido = array_chunk($users, $n);
      $index = 0;
      $this->Cell(150, 10, 'Cantidad de votantes: ' . (count($users)), 0, 0, 'L');
      $this->SetX($this->lMargin * 3);
      $this->Cell(150, 10, 'Cantidad de votos contabilizados: ' . $votos, 0, 0, 'R');
      //agregar cantidad de votos
      foreach ($arregloPartido as $pagina) {
      $this->FancyTable($header, $pagina);
      $index++;
      if (count($arregloPartido) != $index) {
      $this->AddPage('P', 'A4');
      }
      }
      } */

    function FancyTableRigor($header, $data) {
// Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(150);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
// Cabecera
        $w = array(65, 50, 70);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
// Datos
        $fill = false;
        foreach ($data as $row) {
            $x = $this->GetX();
            $y = $this->GetY();
            $this->MultiCell($w[0], 5, $row[0], 'LR', 'L', $fill);
            $this->SetXY($x + $w[0], $y);
            $this->MultiCell($w[1], 5, $row[1], 'LR', 'L', $fill);
            $this->SetXY($x + $w[0] + $w[1], $y);
            $this->MultiCell($w[2], 5, $row[2], 'LR', 'L', $fill);
            $fill = !$fill;
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function FancyTableNivelesSubcaracteristicas($header, $data) {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(150);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
// Cabecera
        $w = array(70, 25, 30, 32, 32);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
// Datos
        $fill = false;
        foreach ($data as $row) {
            $this->CellFitSpace($w[0], 5, $row[0], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 5, $row[1], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 5, $row[2], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 5, $row[3], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 5, $row[4], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function FancyTableNivelesCaracteristicas($header, $data) {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(150);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->SetFontSize(11);
// Cabecera
        switch (count($header)) {
            case 3:
                $w = array(60, 65, 65); //190
                break;
            case 4:
                $w = array(30, 50, 50, 60); //190
                break;
            case 5:
                $w = array(40, 30, 30, 35, 55); //190
                break;
            case 6:
                $w = array(30, 32, 30, 30, 34, 34); //190
                break;
            case 7:
                $w = array(30, 25, 25, 25, 35, 25, 25); //190
                break;
        }
        for ($i = 0; $i < count($header); $i++)
            $this->CellFitSpace($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Datos
        $fill = false;
        foreach ($data as $row) {
            $this->SetFillColor(150);
            $this->SetTextColor(255);
            $this->SetDrawColor(100);
            $this->SetLineWidth(.3);
            $this->SetFont('', 'B');
            $this->SetFontSize(11);
            $this->CellFitSpace($w[0], 5, $row[0], 'LR', 0, 'C', true);
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            $this->SetFontSize(9);
            for ($i = 1; $i < count($header); $i++)
                $this->CellFitSpace($w[$i], 5, $row[$i], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
     function FancyTableCriteriosSubcaracteristicas($header, $data) {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(150);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->SetFontSize(11);
// Cabecera
        $w = array(70, 30, 30, 60);
        for ($i = 0; $i < count($header); $i++)
            $this->CellFitSpace($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Datos
        $fill = false;
        foreach ($data as $row) {
//            $this->SetFillColor(150);
//            $this->SetTextColor(255);
//            $this->SetDrawColor(100);
//            $this->SetLineWidth(.3);
//            $this->SetFont('', 'B');
//            $this->SetFontSize(11);
           // $this->CellFitSpace($w[0], 5, $row[0], 'LR', 0, 'C', true);
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            $this->SetFontSize(9);
            if ($row === end($data)){
                $this->SetFont('', 'B');   
            }
            for ($i = 0; $i < count($header); $i++)
                $this->CellFitSpace($w[$i], 5, $row[$i], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    /*   function FancyTable($header, $data) {
      if ($this->PageNo() == 1) {
      $this->SetXY(10, 45);
      } else {
      $this->SetXY(10, 40);
      }

      // Colores, ancho de línea y fuente en negrita
      $this->SetFillColor(120, 120, 120);
      $this->SetTextColor(255);
      $this->SetDrawColor(120, 120, 120);
      $this->SetLineWidth(.3);
      $this->SetFont('Arial', 'B', 10);
      // Cabecera
      $w = array(40, 40, 25, 30, 60);
      for ($i = 0; $i < count($header); $i++)
      $this->CellFitSpace($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
      $this->Ln();
      // Restauración de colores y fuentes
      $this->SetFillColor(224, 235, 255);
      $this->SetTextColor(0);
      $this->SetFont('Arial', '', 10);
      // Datos
      $fill = false;
      foreach ($data as $row) {
      $this->CellFitSpace($w[0], 6, utf8_decode($row['apellido']), 'LR', 0, 'C', $fill);
      $this->CellFitSpace($w[1], 6, utf8_decode($row['nombre']), 'LR', 0, 'C', $fill);
      $this->CellFitSpace($w[2], 6, utf8_decode($row['matricula']), 'LR', 0, 'C', $fill);
      $this->CellFitSpace($w[3], 6, utf8_decode($row['usuario']), 'LR', 0, 'C', $fill);
      $this->CellFitSpace($w[4], 6, utf8_decode($row['mail']), 'LR', 0, 'C', $fill);
      $this->Ln();
      $fill = !$fill;
      }
      // Línea de cierre
      $this->Cell(array_sum($w), 0, '', 'T');
      }
     */

//**************************************************************************************************************
    function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true) {
//Get string width
        $str_width = $this->GetStringWidth($txt);
        if ($str_width == 0) {
            $str_width = 1;
        }
//Calculate ratio to fit cell
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $ratio = ($w - $this->cMargin * 2) / $str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
//Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
//Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
//Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max($this->MBGetStringLength($txt) - 1, 1) * $this->k;
//Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
//Override user alignment (since text will fill up cell)
            $align = '';
        }

//Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

//Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
    }

    function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

//Patch to also work with CJK double-byte text
    function MBGetStringLength($s) {
        if ($this->CurrentFont['type'] == 'Type0') {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++) {
                if (ord($s[$i]) < 128)
                    $len++;
                else {
                    $len++;
                    $i++;
                }
            }
            return $len;
        } else
            return strlen($s);
    }

}

?>   