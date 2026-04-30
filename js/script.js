/* ==========================================
   CYBORG GAMING CLUB - MAIN JAVASCRIPT
   ========================================== */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Highlight Active Menu Items
    highlightActiveLinks();

    // 2. Mobile Hamburger Menu Toggle
    setupMobileMenu();

    // 3. Form Validation
    setupFormValidation();

    // 4. Custom Delete Confirmation Modal
    setupDeleteConfirmation();
});

/**
 * Automatically detects the current page and adds the 'active' class to navbar & sidebar links.
 */
function highlightActiveLinks() {
    const currentPath = window.location.pathname;
    const pageName = currentPath.substring(currentPath.lastIndexOf('/') + 1);

    // Main Navbar Links
    const navLinks = document.querySelectorAll('.nav-menu .nav-item a');
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === pageName || (pageName === '' && linkPath === 'index.html')) {
            link.parentElement.classList.add('active');
        } else {
            link.parentElement.classList.remove('active');
        }
    });

    // Dashboard Sidebar Links
    const sidebarLinks = document.querySelectorAll('.db-menu-item a');
    sidebarLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === pageName) {
            link.parentElement.classList.add('active');
        } else {
            link.parentElement.classList.remove('active');
        }
    });
}

/**
 * Manages hamburger menu clicking and responsive display.
 */
function setupMobileMenu() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            
            // Hamburger animation
            const spans = hamburger.querySelectorAll('span');
            if (navMenu.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }
}

/**
 * Attaches frontend form validations on forms dynamically.
 */
function setupFormValidation() {
    // Signup Form
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', (e) => {
            let isValid = true;

            const fullName = document.getElementById('fullName');
            const studentId = document.getElementById('studentId');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const favoriteGame = document.getElementById('favoriteGame');

            // Name validation
            if (!validateField(fullName, val => val.trim().length >= 3, 'Full Name must be at least 3 characters')) {
                isValid = false;
            }

            // Student ID must contain numbers only
            if (!validateField(studentId, val => /^[0-9]+$/.test(val.trim()), 'Student ID must contain numbers only')) {
                isValid = false;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!validateField(email, val => emailRegex.test(val), 'Please enter a valid email address')) {
                isValid = false;
            }

            // Phone validation
            const phoneRegex = /^[0-9+-\s]{8,15}$/;
            if (!validateField(phone, val => phoneRegex.test(val), 'Please enter a valid phone number (8-15 digits)')) {
                isValid = false;
            }

            // Password length
            if (!validateField(password, val => val.length >= 6, 'Password must be at least 6 characters')) {
                isValid = false;
            }

            // Confirm Password
            if (!validateField(confirmPassword, val => val === password.value && val !== '', 'Passwords do not match')) {
                isValid = false;
            }

            // Favorite Game
            if (!validateField(favoriteGame, val => val !== '', 'Please select or type your favorite game')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Login Form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!validateField(email, val => emailRegex.test(val), 'Please enter a valid email address')) {
                isValid = false;
            }

            if (!validateField(password, val => val.length > 0, 'Password is required')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Contact Form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            let isValid = true;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');

            if (!validateField(name, val => val.trim().length >= 3, 'Name must be at least 3 characters')) {
                isValid = false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!validateField(email, val => emailRegex.test(val), 'Please enter a valid email address')) {
                isValid = false;
            }

            if (!validateField(message, val => val.trim().length >= 10, 'Message must be at least 10 characters long')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Enroll Event Form (in details popup/card)
    const enrollForm = document.getElementById('enrollForm');
    if (enrollForm) {
        enrollForm.addEventListener('submit', (e) => {
            let isValid = true;
            const gameUsername = document.getElementById('gameUsername');
            const teamName = document.getElementById('teamName');

            if (!validateField(gameUsername, val => val.trim().length >= 2, 'Game username is required')) {
                isValid = false;
            }

            // If it is a team tournament, team name may be validated
            if (teamName && teamName.required && !validateField(teamName, val => val.trim().length >= 2, 'Team name is required')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Admin Forms (Events, Fixtures, Committee)
    const adminEventForm = document.getElementById('adminEventForm');
    if (adminEventForm) {
        adminEventForm.addEventListener('submit', (e) => {
            let isValid = true;
            const eventName = document.getElementById('eventName');
            const gameName = document.getElementById('gameName');
            const eventDate = document.getElementById('eventDate');
            const eventTime = document.getElementById('eventTime');
            const venue = document.getElementById('venue');

            if (!validateField(eventName, val => val.trim().length >= 3, 'Event Name is required (min 3 chars)')) {
                isValid = false;
            }
            if (!validateField(gameName, val => val !== '', 'Please select a game')) {
                isValid = false;
            }
            if (!validateField(eventDate, val => val !== '', 'Event Date is required')) {
                isValid = false;
            }
            if (!validateField(eventTime, val => val !== '', 'Event Time is required')) {
                isValid = false;
            }
            if (!validateField(venue, val => val.trim().length >= 3, 'Venue is required (min 3 chars)')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    const adminFixtureForm = document.getElementById('adminFixtureForm');
    if (adminFixtureForm) {
        adminFixtureForm.addEventListener('submit', (e) => {
            let isValid = true;
            const eventId = document.getElementById('eventId');
            const roundName = document.getElementById('roundName');
            const teamOne = document.getElementById('teamOne');
            const teamTwo = document.getElementById('teamTwo');
            const matchDate = document.getElementById('matchDate');
            const matchTime = document.getElementById('matchTime');

            if (!validateField(eventId, val => val !== '', 'Please select an event')) {
                isValid = false;
            }
            if (!validateField(roundName, val => val.trim().length >= 2, 'Round Name is required')) {
                isValid = false;
            }
            if (!validateField(teamOne, val => val.trim().length >= 2, 'Team One name is required')) {
                isValid = false;
            }
            if (!validateField(teamTwo, val => val.trim().length >= 2, 'Team Two name is required')) {
                isValid = false;
            }
            if (!validateField(matchDate, val => val !== '', 'Match Date is required')) {
                isValid = false;
            }
            if (!validateField(matchTime, val => val !== '', 'Match Time is required')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    const adminCommitteeForm = document.getElementById('adminCommitteeForm');
    if (adminCommitteeForm) {
        adminCommitteeForm.addEventListener('submit', (e) => {
            let isValid = true;
            const memberName = document.getElementById('memberName');
            const position = document.getElementById('position');
            const department = document.getElementById('department');

            if (!validateField(memberName, val => val.trim().length >= 3, 'Name is required (min 3 chars)')) {
                isValid = false;
            }
            if (!validateField(position, val => val !== '', 'Please select a position')) {
                isValid = false;
            }
            if (!validateField(department, val => val.trim().length >= 2, 'Department is required')) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
}

/**
 * Validates a single field using a callback function.
 * Toggles error message visibility and border classes.
 */
function validateField(element, validatorFunc, errorMessage) {
    if (!element) return true; // field doesn't exist on this page
    
    const val = element.value;
    const isValValid = validatorFunc(val);
    
    // Check if error element exists, if not create/find it
    let errorSpan = element.parentElement.querySelector('.form-error-msg');
    
    if (isValValid) {
        element.classList.remove('is-invalid');
        if (errorSpan) {
            errorSpan.style.display = 'none';
        }
    } else {
        element.classList.add('is-invalid');
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'form-error-msg';
            element.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = errorMessage;
        errorSpan.style.display = 'block';
    }
    
    return isValValid;
}

/**
 * Custom Confirmation Popup Modal system for deleting items in admin panel.
 */
function setupDeleteConfirmation() {
    // Dynamic overlay & modal creator if it doesn't exist in document
    let modalOverlay = document.getElementById('deleteConfirmModal');
    
    if (!modalOverlay) {
        modalOverlay = document.createElement('div');
        modalOverlay.id = 'deleteConfirmModal';
        modalOverlay.className = 'modal-overlay';
        modalOverlay.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <span style="color:var(--color-danger)">⚠</span> Confirm Deletion
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item? This action is permanent and cannot be undone.
                </div>
                <div class="modal-actions">
                    <button class="btn btn-secondary btn-sm" id="cancelDeleteBtn">Cancel</button>
                    <button class="btn btn-danger btn-sm" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        `;
        document.body.appendChild(modalOverlay);
    }

    const cancelBtn = modalOverlay.querySelector('#cancelDeleteBtn');
    const confirmBtn = modalOverlay.querySelector('#confirmDeleteBtn');
    let activeDeleteCallback = null;

    // Intercept delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Show custom modal
            modalOverlay.classList.add('active');
            
            // Set deletion callback
            activeDeleteCallback = () => {
                // Mock delete visual feedback for demo
                const row = btn.closest('tr');
                if (row) {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(50px)';
                    setTimeout(() => {
                        row.remove();
                    }, 500);
                }
                
                // Show floating notification (optional)
                showToast('Item deleted successfully!');
            };
        });
    });

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
            activeDeleteCallback = null;
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
            if (activeDeleteCallback) {
                activeDeleteCallback();
                activeDeleteCallback = null;
            }
        });
    }
}

/**
 * Utility function to show floating text notification
 */
function showToast(message) {
    let toast = document.getElementById('toastNotification');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toastNotification';
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.right = '20px';
        toast.style.backgroundColor = 'var(--bg-card)';
        toast.style.border = '1px solid var(--color-primary)';
        toast.style.boxShadow = 'var(--glow-cyan)';
        toast.style.color = 'var(--color-text-white)';
        toast.style.padding = '12px 24px';
        toast.style.borderRadius = '4px';
        toast.style.fontFamily = 'var(--font-heading)';
        toast.style.fontSize = '0.85rem';
        toast.style.zIndex = '9999';
        toast.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
        document.body.appendChild(toast);
    }
    
    toast.textContent = message;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
    }, 3000);
}
