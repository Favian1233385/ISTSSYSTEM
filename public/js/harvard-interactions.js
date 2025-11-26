/**
 * Harvard-style interactions for ISTS Sucúa
 * Modern navigation and user experience enhancements
 */

document.addEventListener("DOMContentLoaded", function () {
    // Initialize all Harvard-style interactions
    initSearchDropdown();
    initNavigationDropdowns();
    initMobileMenu();
    initSmoothScrolling();
    initFocusAnimations();
    initNewsInteractions();
    initHeaderScrollEffect(); // Añadir efecto de scroll al header
});

/**
 * Initialize search dropdown functionality
 */
function initSearchDropdown() {
    const searchToggle = document.querySelector(".search-toggle");
    const searchDropdown = document.querySelector(".search-dropdown");
    const searchInput = document.querySelector("#main-search");

    if (!searchToggle || !searchDropdown) return;

    // Toggle search dropdown
    searchToggle.addEventListener("click", function (e) {
        e.preventDefault();
        searchDropdown.classList.toggle("active");
        if (searchDropdown.classList.contains("active")) {
            searchInput.focus();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
        if (
            !searchToggle.contains(e.target) &&
            !searchDropdown.contains(e.target)
        ) {
            searchDropdown.classList.remove("active");
        }
    });

    // Handle search input
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            const query = this.value.toLowerCase();
            const suggestions = document.querySelectorAll(".suggestion");

            suggestions.forEach((suggestion) => {
                const text = suggestion.textContent.toLowerCase();
                if (text.includes(query)) {
                    suggestion.style.display = "block";
                } else {
                    suggestion.style.display = "none";
                }
            });
        });

        // Handle search submission
        searchInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                performSearch(this.value);
            }
        });
    }
}

/**
 * Initialize navigation dropdowns
 */
function initNavigationDropdowns() {
    const navItems = document.querySelectorAll(".header-menu .dropdown");

    navItems.forEach((item) => {
        const link = item.querySelector(".header-link");
        const dropdown = item.querySelector(".dropdown-content");

        if (!link || !dropdown) return;

        // Show dropdown on hover
        item.addEventListener("mouseenter", function () {
            if (window.innerWidth > 992) {
                // Only on desktop
                dropdown.style.display = "block";
            }
        });

        // Hide dropdown when mouse leaves
        item.addEventListener("mouseleave", function () {
            if (window.innerWidth > 992) {
                // Only on desktop
                dropdown.style.display = "none";
            }
        });

        // Prevent click navigation on desktop
        link.addEventListener("click", function (e) {
            if (window.innerWidth > 992) {
                // Only on desktop
                e.preventDefault();
            }

            // Handle mobile click
            if (window.innerWidth <= 992) {
                // Check if the dropdown is already open
                const isOpen = dropdown.style.display === "block";

                // Close all other open dropdowns
                document
                    .querySelectorAll(".header-menu .dropdown-content")
                    .forEach((d) => {
                        d.style.display = "none";
                    });

                // Toggle the current dropdown
                if (!isOpen) {
                    dropdown.style.display = "block";
                }
                e.preventDefault();
            }
        });

        // Handle keyboard navigation
        link.addEventListener("keydown", function (e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            }
        });
    });

    // Close dropdowns when clicking outside on mobile
    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 992) {
            let isDropdownClick = false;
            document.querySelectorAll(".header-menu .dropdown").forEach((d) => {
                if (d.contains(e.target)) {
                    isDropdownClick = true;
                }
            });

            if (!isDropdownClick) {
                document
                    .querySelectorAll(".header-menu .dropdown-content")
                    .forEach((d) => {
                        d.style.display = "none";
                    });
            }
        }
    });
}

/**
 * Initialize mobile menu functionality
 */
function initMobileMenu() {
    const menuToggle = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector(".nav-menu");

    if (!menuToggle || !navMenu) return;

    menuToggle.addEventListener("click", function () {
        navMenu.classList.toggle("mobile-active");
        this.classList.toggle("active");

        // Update aria-expanded
        const isExpanded = navMenu.classList.contains("mobile-active");
        this.setAttribute("aria-expanded", isExpanded);
    });

    // Close mobile menu when clicking outside
    document.addEventListener("click", function (e) {
        if (!menuToggle.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.remove("mobile-active");
            menuToggle.classList.remove("active");
            menuToggle.setAttribute("aria-expanded", "false");
        }
    });

    // Handle window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            navMenu.classList.remove("mobile-active");
            menuToggle.classList.remove("active");
            menuToggle.setAttribute("aria-expanded", "false");
        }
    });
}

/**
 * Initialize smooth scrolling for anchor links
 */
function initSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });
}

/**
 * Initialize focus animations for cards
 */
function initFocusAnimations() {
    const focusCards = document.querySelectorAll(".focus-card");
    const programCards = document.querySelectorAll(".program-card");
    const newsCards = document.querySelectorAll(".news-card");

    // Add intersection observer for animations
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        },
    );

    // Observe all cards
    [...focusCards, ...programCards, ...newsCards].forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        observer.observe(card);
    });
}

/**
 * Initialize news section interactions
 */
function initNewsInteractions() {
    const newsCards = document.querySelectorAll(".news-card");

    newsCards.forEach((card) => {
        // Add hover effects
        card.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-8px)";
            this.style.boxShadow = "0 12px 30px rgba(0,0,0,0.15)";
        });

        card.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
            this.style.boxShadow = "0 4px 6px rgba(0,0,0,0.1)";
        });

        // Add click tracking
        const readMoreLinks = card.querySelectorAll(".read-more");
        readMoreLinks.forEach((link) => {
            link.addEventListener("click", function (e) {
                // Track news clicks
                trackNewsClick(this.href);
            });
        });
    });
}

/**
 * Perform search functionality
 */
function performSearch(query) {
    if (!query.trim()) return;

    // Show loading state
    const searchInput = document.querySelector("#main-search");
    if (searchInput) {
        searchInput.style.opacity = "0.5";
        searchInput.disabled = true;
    }

    // Simulate search (replace with actual search implementation)
    setTimeout(() => {
        console.log("Searching for:", query);

        // Reset search input
        if (searchInput) {
            searchInput.style.opacity = "1";
            searchInput.disabled = false;
        }

        // Close search dropdown
        const searchDropdown = document.querySelector(".search-dropdown");
        if (searchDropdown) {
            searchDropdown.classList.remove("active");
        }

        // Redirect to search results (implement actual search)
        // window.location.href = `/buscar?q=${encodeURIComponent(query)}`;
    }, 500);
}

/**
 * Track news clicks for analytics
 */
function trackNewsClick(url) {
    // Implement analytics tracking
    console.log("News clicked:", url);

    // Example: Send to analytics service
    if (typeof gtag !== "undefined") {
        gtag("event", "news_click", {
            event_category: "engagement",
            event_label: url,
        });
    }
}

/**
 * Initialize program card interactions
 */
function initProgramCards() {
    const programCards = document.querySelectorAll(".program-card");

    programCards.forEach((card) => {
        const button = card.querySelector(".btn-primary");

        if (button) {
            button.addEventListener("click", function (e) {
                // Track program interest
                const programName = card.querySelector("h3").textContent;
                trackProgramInterest(programName);
            });
        }
    });
}

/**
 * Track program interest
 */
function trackProgramInterest(programName) {
    console.log("Program interest:", programName);

    // Example: Send to analytics service
    if (typeof gtag !== "undefined") {
        gtag("event", "program_interest", {
            event_category: "academic",
            event_label: programName,
        });
    }
}

/**
 * Initialize quick links interactions
 */
function initQuickLinks() {
    const quickLinks = document.querySelectorAll(".quick-link");

    quickLinks.forEach((link) => {
        link.addEventListener("click", function () {
            // Track quick link usage
            const linkText = this.textContent.trim();
            trackQuickLinkUsage(linkText);
        });
    });
}

/**
 * Track quick link usage
 */
function trackQuickLinkUsage(linkText) {
    console.log("Quick link used:", linkText);

    // Example: Send to analytics service
    if (typeof gtag !== "undefined") {
        gtag("event", "quick_link_click", {
            event_category: "navigation",
            event_label: linkText,
        });
    }
}

/**
 * Initialize keyboard navigation
 */
function initKeyboardNavigation() {
    document.addEventListener("keydown", function (e) {
        // Handle escape key
        if (e.key === "Escape") {
            // Close all dropdowns
            const dropdowns = document.querySelectorAll(".dropdown-content");
            dropdowns.forEach((dropdown) => {
                dropdown.style.display = "none";
            });

            // Close mobile menu
            const navMenu = document.querySelector(".nav-menu");
            const menuToggle = document.querySelector(".menu-toggle");
            if (navMenu && menuToggle) {
                navMenu.classList.remove("mobile-active");
                menuToggle.classList.remove("active");
                menuToggle.setAttribute("aria-expanded", "false");
            }
        }
    });
}

/**
 * Initialize accessibility features
 */
function initAccessibility() {
    // Add skip link functionality
    const skipLink = document.querySelector(".skip-link");
    if (skipLink) {
        skipLink.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.focus();
                target.scrollIntoView();
            }
        });
    }

    // Add focus indicators
    const focusableElements = document.querySelectorAll(
        "a, button, input, select, textarea",
    );
    focusableElements.forEach((element) => {
        element.addEventListener("focus", function () {
            this.style.outline = "2px solid #0066cc";
            this.style.outlineOffset = "2px";
        });

        element.addEventListener("blur", function () {
            this.style.outline = "none";
        });
    });
}

// Initialize additional features
document.addEventListener("DOMContentLoaded", function () {
    initProgramCards();
    initQuickLinks();
    initKeyboardNavigation();
    initAccessibility();
});

/**
 * Initializes the dynamic header effect (hide on scroll down, show on scroll up).
 */
function initHeaderScrollEffect() {
    const header = document.querySelector(".header");
    if (!header) return;

    let lastScrollTop = 0;
    const scrollThreshold = 100; // Pixels to scroll before anything happens

    window.addEventListener(
        "scroll",
        () => {
            let scrollTop = window.scrollY;

            // On scroll down, hide header. On scroll up, show it.
            if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
                header.classList.add("header-hidden");
            } else {
                header.classList.remove("header-hidden");
            }

            // Add/remove sticky class for background change when not at the top.
            if (scrollTop > scrollThreshold) {
                header.classList.add("header-sticky");
            } else {
                header.classList.remove("header-sticky");
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        },
        { passive: true },
    );
}

// Export functions for external use
window.HarvardInteractions = {
    performSearch,
    trackNewsClick,
    trackProgramInterest,
    trackQuickLinkUsage,
};
