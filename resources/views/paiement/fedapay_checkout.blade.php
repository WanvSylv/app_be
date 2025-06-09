<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title>Paiement de l’abonnement</title>
  <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
</head>
<body>
  <button id="pay-btn">Payer {{ $abonnement->montant ?? 1000 }} FCFA</button>
<script type="text/javascript">
  window.onload = function () {
    if (typeof FedaPay === 'undefined') {
      console.error('FedaPay non chargé. Veuillez vérifier la connexion ou le script.');
      return;
    }

    FedaPay.init('#pay-btn', {
      public_key: 'pk_live_oN4r--FyQ6bb9NCvJxeV-dn8', 
      transaction: {
        amount: {{ $abonnement->montant ?? 1000 }},
        description: 'Paiement abonnement - Bibliothèque',
      },
      customer: {
        email: '{{ $abonnement->abonne->email ?? "inconnu@email.com" }}',
        lastname: '{{ $abonnement->abonne->nom ?? "nom" }}',
        firstname: '{{ $abonnement->abonne->prenom ?? "prénom"}}',
      },
      onComplete: function(transaction) {
        window.location.href = '/paiements/success?abonnement_id={{ $abonnement->id }}';
      },
      onClose: function() {
        window.location.href = '/paiements/cancel?abonnement_id={{ $abonnement->id }}';
      }
    });
  };
</script>

</body>
</html>