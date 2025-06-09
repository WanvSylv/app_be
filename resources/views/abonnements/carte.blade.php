<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte d'Abonnement</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 9.5px;
            width: 249pt;
            height: 354pt;
            margin: 0;
            padding: 6pt;
            background-color: #fdfdfd;
            border: 1px solid #000;
            box-sizing: border-box;
        }

        .republique {
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            color: #000;
            margin-bottom: 4pt;
        }

        .drapeau {
            display: block;
            margin: 0 auto 3pt auto;
            width: 30px;
            height: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 4pt;
        }

        .bibliotheque {
            font-weight: bold;
            font-size: 11px;
            color: #1a237e;
            text-transform: uppercase;
        }

        .logo {
            width: 35px;
            margin: 4pt auto;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            color: #000;
            text-decoration: underline;
        }

        table.carte {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4pt;
        }

        table.carte td {
            vertical-align: top;
            padding: 2pt;
        }

        .photo {
            width: 80px;
            height: 100px;
            border: 1px solid #888;
            background: #fff;
            text-align: center;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info {
            font-size: 9px;
            line-height: 1.4;
        }

        .info p {
            margin: 1.5pt 0;
        }

        .qrcode {
            width: 60px;
            height: 60px;
            border: 1px solid #aaa;
            margin-top: 6pt;
        }

        .qrcode img {
            width: 100%;
            height: 100%;
        }

        .signature-box {
            font-size: 9px;
            text-align: center;
            margin-top: 6pt;
        }

        .footer-box {
            font-size: 7px;
            color: #444;
            text-align: left;
            margin-top: 2pt;
        }

        .divider {
            border-top: 1px dashed #aaa;
            margin: 5pt 0;
        }
    </style>
</head>
<body>
    <div class="republique">
        <img class="drapeau" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/drapeau_benin.jpeg'))) }}" alt="Drapeau du Bénin">
        RÉPUBLIQUE DU BÉNIN
    </div>

    <div class="header">
        <div class="bibliotheque">{{ $nomBibliotheque }}</div>
        <img src="{{ $logoPath }}" class="logo" alt="Logo de la bibliothèque">
        <div class="title">Carte d'Abonnement</div>
    </div>

    <table class="carte">
        <tr>
            <td rowspan="2" style="width: 85px;">
                <div class="photo">
                    <img src="{{ $photoPath }}" alt="Photo abonné">
                </div>
            </td>
            <td class="info">
                <p><strong>Nom :</strong> {{ strtoupper($abonne->nom) }}</p>
                <p><strong>Prénom :</strong> {{ $abonne->prenom }}</p>
                <p><strong>Contact :</strong> {{ $abonne->contact }}</p>
                <p><strong>Adresse :</strong> {{ $abonne->adresse }}</p>
                <p><strong>Carte N° :</strong> {{ str_pad($abonne->id, 6, '0', STR_PAD_LEFT) }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <div class="qrcode">
                    <img src="{{ $qrCode }}" alt="QR Code">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="divider"></div>
                <div class="info">
                    <p><strong>Date d'émission :</strong> {{ $dateEmission }}</p>
                    <p><strong>Expiration :</strong> {{ $dateExpiration }}</p>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="signature-box">
                    <p><strong>Signature</strong></p>
                    <p>......................</p>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="footer-box">
                    Carte émise par {{ $nomBibliotheque }}
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
