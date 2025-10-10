/*  for dashboard click minimized*/
const toggleBtn = document.getElementById("toggleBtn");     
const dashboard = document.querySelector(".dashboard");

toggleBtn.addEventListener("click", () => {
  dashboard.classList.toggle("minimized");
});
