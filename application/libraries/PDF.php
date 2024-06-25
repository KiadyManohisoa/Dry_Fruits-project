<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/fpdf/fpdf.php';

class Pdf extends FPDF {
    
    private $order_details;

    public function __construct($order_details) {
        parent::__construct();
        $this->AddFont('century-gothic', '', 'century-gothic.php'); // Adjust path if necessary
        $this->AddFont('century-gothic', 'B', 'century-gothic-B.php'); // Adjust path if necessary
        $this->order_details = $order_details;
    }

    function Header() {
        $this->backgroundImage = base_url("assets/images/Bill.png"); // Use base_url() for proper URL
        if ($this->backgroundImage) {
            $this->Image($this->backgroundImage, 0, 0, $this->GetPageWidth(), $this->GetPageHeight());
        }
        // Logo ou titre du document
        $this->SetFont('century-gothic', '', 20);
        $this->Ln(20.5);
        $this->setX(43);
        $this->Cell(0, 10, date('Y-m-d'), 0, 1, 'L');
        $this->setX(45);
        $this->Cell(0, 10, $this->order_details[0]['order_id'], 0, 1, 'L');
    }

    function Footer() {
        // Numéro de page
        $this->SetY(-15);
        $this->SetFont('century-gothic', '', 8);
    }

    function GenerateTable() {
        // En-têtes de colonnes
        $this->Ln(15);
        $this->SetFont('century-gothic', 'B', 10);
        $this->Cell(15, 7, 'Qty', 1, 0, 'C');
        $this->Cell(70, 7, 'Product Name', 1, 0, 'C');
        $this->Cell(30, 7, 'Type Sales', 1, 0, 'C'); // Nouvelle colonne pour le type_sales
        $this->Cell(30, 7, 'Price', 1, 0, 'C');
        $this->Cell(40, 7, 'Total', 1, 1, 'C');
        
        // Données de commande
        $this->SetFont('century-gothic', '', 12);
        foreach ($this->order_details as $order) {
            $this->Cell(15, 7, number_format($order['quantity_product']), 1, 0, 'C');
            $this->Cell(70, 7, $order['product_name'], 1, 0, 'L');
            $this->Cell(30, 7, $order['type_sales'], 1, 0, 'C'); // Affichage du type_sales
            $this->Cell(30, 7, number_format($order['unit_product_price']) . ' Ar', 1, 0, 'R');
            $this->Cell(40, 7, number_format($order['price_product_with_reduction']) . ' Ar', 1, 1, 'R');
        }
    }
    
    function GenerateSummary() {
        // Descendre le tableau de 100px
        $this->Ln(10);
    
        // Sommaire des totaux
        $this->SetFont('century-gothic', 'B', 10);
        $this->Cell(130, 7, 'Subtotal:', 1, 0, 'R');
        $this->Cell(55, 7, number_format($this->order_details[0]['total_price_product'], 2, '.', ' ') . ' Ar', 1, 1, 'R');
        
        $this->Cell(130, 7, 'Reduction:', 1, 0, 'R');
        $this->Cell(55, 7, '-' . number_format($this->order_details[0]['reduction']) . '%', 1, 1, 'R');
        
        $this->SetFont('century-gothic', 'B', 14);
        $this->Cell(130, 7, 'Total:', 1, 0, 'R');
        $this->Cell(55, 7, number_format($this->order_details[0]['result'], 2, '.', ' ') . ' Ar', 1, 1, 'R');
    }

    function GenerateCustomerInfo() {
        // Informations personnelles du client
        $this->Ln(3.5);
        $this->SetFont('century-gothic', 'B', 12);
        $this->SetFont('century-gothic', '', 12);
        $this->setX(55);
        $this->Cell(0, 6, $this->order_details[0]['client_full_name'] , 0, 1, 'L');
        $this->setX(37);
        $this->Cell(0, 6, $this->order_details[0]['client_email'] , 0, 1, 'L');
        $this->setX(58);
        $this->Cell(0, 6,$this->order_details[0]['client_phone_number'], 0, 1, 'L');
        
        // Adresse de livraison
        $this->Ln(12.5);
        $this->SetFont('century-gothic', '', 12);
        $this->setX(53);
        $this->Cell(0, 6, $this->order_details[0]['delivery_date'], 0, 1, 'L');
        $this->setX(40);
        $this->Cell(0, 6, $this->order_details[0]['delivery_address'], 0, 1, 'L');
        $this->setX(46);
        $this->Cell(0, 7, $this->order_details[0]['payment_type'], 0, 1, 'L');
        $this->setX(57);
        $this->Cell(0, 5, $this->order_details[0]['payment_phone_number'], 0, 1, 'L');
    }

    function GeneratePDF() {
        $this->AddPage();
        $this->GenerateCustomerInfo();
        $this->GenerateTable();
        $this->GenerateSummary();
        
        // Headers to force download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="BILL-'.$this->order_details[0]['order_id'].'.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Output the PDF
        $this->Output('D', 'BILL-'.$this->order_details[0]['order_id'].'.pdf');
    }
}
?>
