class CurrentYear {
  constructor() {
    this.year = new Date().getFullYear();
  }

  getYear() {
    return this.year;
  }
}

export default CurrentYear;
