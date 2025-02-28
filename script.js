// Get the toggle button and sidebar elements
let toggle = document.querySelector('.toggle');
let navbar = document.querySelector('.navbar');

// Add event listener to toggle the sidebar visibility
toggle.addEventListener('click', function () {
    navbar.classList.toggle('active');
    toggle.querySelector('.open').classList.toggle('close');
    toggle.querySelector('.close').classList.toggle('open');
});






// Initialize Swiper with Autoplay
var swiper = new Swiper(".team-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2500, // 2.5 seconds delay between slides
        disableOnInteraction: false, // Allow autoplay to continue even after user interaction
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});




function popup(popup_name) {
    var get_popup = document.getElementById(popup_name);
    if(get_popup.style.display == "flex") {
      get_popup.style.display = "none";
    } else {
      get_popup.style.display = "flex";
    }
  }






// Highlight the active link dynamically
document.querySelectorAll(".navbar ul li").forEach(item => {
    item.addEventListener("click", function () {
        document.querySelectorAll(".navbar ul li").forEach(li => li.classList.remove("active"));
        this.classList.add("active");
    });
});
