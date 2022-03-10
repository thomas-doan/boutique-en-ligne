    <form method="post">
      <div id="errors"></div>
      <input id="cardholder-name" type="text" placeholder="Titulaire de la carte">
      <div id="card-elements" class="test"></div>
      <div id="card-errors" role="alert"></div>
      <button id="card-button" type="submit" data-secret="<?= $intent['client_secret'] ?>">Valider le paiement</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-2.0.2.min.js"></script>
    <script src="script.js"></script>