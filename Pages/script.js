// Price update function based on duration
function updatePrice() {
    const duration = parseInt(document.getElementById("duration").value);
    let price = 1099; // Default price for 30 minutes

    // Adjust price based on duration
    if (duration === 60) {
        price = 1999; // 1 hour
    } else if (duration === 90) {
        price = 2999; // 1.5 hours
    } else if (duration === 120) {
        price = 3999; // 2 hours
    } else if (duration === 150) {
        price = 4999; // 2.5 hours
    } else if (duration === 180) {
        price = 5999; // 3 hours
    }

    document.getElementById("price").textContent = price;
}

// Event listener for duration change
document.getElementById("duration").addEventListener("change", updatePrice);

// Handle Book Now button click
document.getElementById("book-now-btn").addEventListener("click", function () {
    const date = document.getElementById("meeting-date").value;
    const time = document.getElementById("meeting-time").value;
    const duration = document.getElementById("duration").value;
    const price = document.getElementById("price").textContent;

    if (date && time) {
        alert(`You have successfully booked a mentorship session for ${duration} minutes on ${date} at ${time}. Total Price: ₹${price}`);
        
        // Redirect to the thank you page after booking
        try {
            // Checking if the thankyou.html file exists in the Pages folder
            if (window.location.hostname === "localhost" || window.location.hostname === "127.0.0.1") {
                // For local development, ensure the path is correct
                window.location.href = "/Pages/thankyou.html";  // Adjust path if necessary
            } else {
                // Production or other environments
                window.location.href = "/thankyou.html";  // Make sure the file is accessible in this path
            }
        } catch (error) {
            // Handling the case if the redirect fails due to missing page or other issues
            console.error("Error while redirecting to the thank you page:", error);
            alert("Thank you page not found. Please try again later.");
        }
    } else {
        alert("Please select a valid date and time.");
    }
});
const urlParams = new URLSearchParams(window.location.search);
document.getElementById("session-duration").textContent = urlParams.get('duration') + " minutes";
document.getElementById("session-price").textContent = urlParams.get('price');
document.getElementById("session-date").textContent = urlParams.get('date');
document.getElementById("session-time").textContent = urlParams.get('time');


// Initial price setup
updatePrice();
