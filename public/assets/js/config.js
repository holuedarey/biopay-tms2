(function () {
  var primary = localStorage.getItem("primary") || "#E57B38";
  var secondary = localStorage.getItem("secondary") || "#f73164";

  window.CubaAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
  };
})();
