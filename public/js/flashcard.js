document.querySelector(".card1").addEventListener("click", () => {
  document.querySelector(".card1 .front").classList.toggle("flipped");
  document.querySelector(".card1 .back").classList.toggle("back-flipped");
  document.querySelector(".card1").classList.add("lift-card");
  
  setTimeout(() => {
    document.querySelector(".card1").classList.remove("lift-card");
  }, 1000);
});