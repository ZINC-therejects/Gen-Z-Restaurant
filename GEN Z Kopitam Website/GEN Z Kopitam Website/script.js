const swiper = new Swiper('.card-wrapper', {
    loop: true,
    spaceBetween: 30,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },

    // Responsive breakpoints
    breakpoints: {
        0: {
            slidesPerView:1
        },
        768: {
            slidesPerView:2
        },
        1024: {
            slidesPerView:3
        },
    }
  });

  // Get all the tab links and tab content elements
const tabLinks = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');

// Function to handle tab switching
function switchTab(event) {
    // Remove the 'active' class from all tabs and content
    tabLinks.forEach(tab => tab.classList.remove('active'));
    tabContents.forEach(content => content.classList.remove('active'));

    // Add 'active' class to the clicked tab and corresponding content
    const tabId = event.target.getAttribute('data-tab');
    document.getElementById(tabId).classList.add('active');
    event.target.classList.add('active');
}

// Add click event listener to each tab
tabLinks.forEach(tab => {
    tab.addEventListener('click', switchTab);
});