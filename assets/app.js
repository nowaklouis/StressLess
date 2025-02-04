import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".favori-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const contenuId = this.dataset.contenuId;
      const isFavorited = this.dataset.favorited === "true";
      const url = `/contenu/${contenuId}/favori`;

      fetch(url, {
        method: "POST",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "Content-Type": "application/json",
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.isFavorited) {
            this.innerText = "❤️";
            this.dataset.favorited = "true";
          } else {
            this.innerText = "🤍";
            this.dataset.favorited = "false";
          }
        })
        .catch((error) => console.error("Erreur:", error));
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".favori-btn-compte").forEach((button) => {
    button.addEventListener("click", function () {
      const contenuId = this.dataset.contenuId;
      const isFavorited = this.dataset.favorited === "true";
      const url = `/contenu/${contenuId}/favori`;

      fetch(url, {
        method: "POST",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "Content-Type": "application/json",
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.isFavorited) {
            this.innerText = "❤️";
            this.dataset.favorited = "true";
          } else {
            this.innerText = "🤍";
            this.dataset.favorited = "false";
          }
          window.location.reload();
        })
        .catch((error) => console.error("Erreur:", error));
    });
  });
});
