<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facades\Pdf;
use Illuminate\Support\Facades\Storage;

class CarteAbonnement extends Model
{
    protected $fillable = [
        'abonne_id', 'bibliotheque_id', 'nom', 'prenom', 'adresse', 'contact',
        'photo', 'qr_code_path', 'logo_path', 'numero_abonnement',
        'date_abonnement', 'date_expiration'
    ];

    // Relations
    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }

    public function bibliotheque()
    {
        return $this->belongsTo(Bibliotheque::class);
    }

    // Génération du QR Code
    public function generateQrCode()
    {
        $qrCode = QrCode::format('png')->size(200)->generate($this->numero_abonnement);
        $qrPath = "qrcodes/{$this->numero_abonnement}.png";
        Storage::put($qrPath, $qrCode);
        $this->qr_code_path = $qrPath;
        $this->save();
    } 

    // Génération du PDF de la carte
    public function generatePdf()
    { 
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('cartes_abonnement.pdf', compact('abonne'));
    
        $pdfPath = "cartes/{$this->numero_abonnement}.pdf";
        Storage::put($pdfPath, $pdf->output());
        return $pdfPath;
    }
    
}
