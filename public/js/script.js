document.querySelector("#collapse").addEventListener("click", function () {
  var x = document.getElementById("newMessage");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
});
