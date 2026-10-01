// Client-side touch: trim whitespace and fade out alert messages
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('productForm');
  if (form) {
    form.addEventListener('submit', function () {
      form.querySelectorAll('input[type=text]').forEach(function (i) { i.value = i.value.trim(); });
    });
  }
  document.querySelectorAll('.alert:not(.error)').forEach(function (a) {
    setTimeout(function () { a.style.opacity = '0'; }, 3500);
  });
});
