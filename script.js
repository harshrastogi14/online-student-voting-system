function updateDateTime() {
    var dateTimeContainer = document.getElementById("date-time-container");
    var dateElement = document.getElementById("date");
    var timeElement = document.getElementById("time");

    var now = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = now.toLocaleDateString(undefined, options);
    var formattedTime = now.toLocaleTimeString();

    dateElement.textContent = formattedDate;
    timeElement.textContent = formattedTime;
}

// Update the date and time every second
setInterval(updateDateTime, 1000);

// Initial call to display the date and time
updateDateTime();
