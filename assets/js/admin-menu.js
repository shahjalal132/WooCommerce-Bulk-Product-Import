(function ($) {
  $(document).ready(function () {
    $("#credential-save").on("click", function (e) {
      e.preventDefault();

      //   alert("Saving credentials...");

      let client_id = $("#client-id").val();
      let client_secret = $("#client-secret").val();

      $.ajax({
        url: bulkProductImport.ajax_url,
        method: "POST",
        data: {
          action: "save_client_credentials",
          nonce: bulkProductImport.nonce,
          client_id: client_id,
          client_secret: client_secret,
        },
        success: function (response) {
          if (response.success) {
            alert(response.data);
          } else {
            alert(response.data);
          }
        },
        error: function () {
          alert("An error occurred. Please try again.");
        },
      });
    });

    // tabs
    $("#tabs").tabs();

    // confetti effects
    // Pass in the id of an element
    let confetti = new Confetti("credential-save");

    // Edit given parameters
    confetti.setCount(75);
    confetti.setSize(1);
    confetti.setPower(25);
    confetti.setFade(false);
    confetti.destroyTarget(false);
  });
})(jQuery);
