// Get the current date as yyyy-mm-dd
const currentDate = new Date().toISOString().slice(0, 10)

// Set the value of the input to the current date
document.getElementById('doc_date').value = currentDate
