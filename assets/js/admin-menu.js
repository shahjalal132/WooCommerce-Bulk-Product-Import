(function ($) {
  $(document).ready(function () {
    // handle save credentials
    $("#credential-save").on("click", function (e) {
      e.preventDefault();

      // get credentials from form
      let client_id = $("#client-id").val();
      let client_secret = $("#client-secret").val();

      // make ajax call to save credentials
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
            let successMessage = response.data;
            // Display an info toast with no title
            Toastify({
              text: successMessage,
              duration: 3000,
              newWindow: true,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
              },
              onClick: function () {}, // Callback after click
            }).showToast();
          } else {
            let errorMessage = response.data;
          }
        },
        error: function () {
          alert("An error occurred. Please try again.");
        },
      });
    });

    // handle db tables creation
    $("#create-tables").on("click", function (e) {
      e.preventDefault();
      alert("Creating tables...");

      $.ajax({
        type: "POST",
        url: bulkProductImport.ajax_url,
        data: {
          action: "create_db_tables",
          nonce: bulkProductImport.nonce,
        },
        success: function (response) {
          alert(response.data);
        },
      });
    });

    // tabs
    $("#tabs").tabs();

    // confetti effects
    let confetti = new Confetti("credential-save");

    // Edit given parameters
    confetti.setCount(75);
    confetti.setSize(1);
    confetti.setPower(25);
    confetti.setFade(false);
    confetti.destroyTarget(false);
  });
})(jQuery);
