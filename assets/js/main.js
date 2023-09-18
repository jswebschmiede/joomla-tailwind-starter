import CurrentYear from "./components/test";

window.onload = function () {
  const currentYear = new CurrentYear();
  const year = currentYear.getYear();
  console.log(year);
};
