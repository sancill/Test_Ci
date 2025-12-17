// Interactive functionality for the landing page

document.addEventListener('DOMContentLoaded', function() {
    // Navigation items click handlers
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            // Remove active class from all items
            navItems.forEach(nav => nav.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
        });
    });

    // Edit Profile functionality
    const editProfileBtn = document.getElementById('editProfileBtn');
    const saveProfileBtn = document.getElementById('saveProfileBtn');
    const cancelProfileBtn = document.getElementById('cancelProfileBtn');
    const fieldInputs = document.querySelectorAll('.field-input-control');
    const fieldContainers = document.querySelectorAll('.field-input');
    
    let originalValues = {};

    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Store original values
            fieldInputs.forEach(input => {
                if (input.dataset.field) {
                    originalValues[input.dataset.field] = input.value;
                }
            });
            
            // Make fields editable
            fieldInputs.forEach(input => {
                input.removeAttribute('readonly');
                input.style.cursor = 'text';
            });
            
            // Add editing class to containers
            fieldContainers.forEach(container => {
                container.classList.add('editing');
            });
            
            // Show/hide buttons
            editProfileBtn.style.display = 'none';
            saveProfileBtn.style.display = 'flex';
            cancelProfileBtn.style.display = 'flex';
        });
    }

    if (saveProfileBtn) {
        saveProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Collect new values
            const newValues = {};
            fieldInputs.forEach(input => {
                if (input.dataset.field) {
                    newValues[input.dataset.field] = input.value;
                }
            });
            
            // Here you would typically send data to server
            console.log('Saving profile data:', newValues);
            
            // Show success message (you can replace with actual notification)
            alert('Profil berhasil disimpan!');
            
            // Make fields read-only again
            fieldInputs.forEach(input => {
                input.setAttribute('readonly', 'readonly');
                input.style.cursor = 'default';
            });
            
            // Remove editing class
            fieldContainers.forEach(container => {
                container.classList.remove('editing');
            });
            
            // Show/hide buttons
            editProfileBtn.style.display = 'flex';
            saveProfileBtn.style.display = 'none';
            cancelProfileBtn.style.display = 'none';
            
            // Update original values
            originalValues = { ...newValues };
        });
    }

    if (cancelProfileBtn) {
        cancelProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Restore original values
            fieldInputs.forEach(input => {
                if (input.dataset.field && originalValues[input.dataset.field]) {
                    input.value = originalValues[input.dataset.field];
                }
                input.setAttribute('readonly', 'readonly');
                input.style.cursor = 'default';
            });
            
            // Remove editing class
            fieldContainers.forEach(container => {
                container.classList.remove('editing');
            });
            
            // Show/hide buttons
            editProfileBtn.style.display = 'flex';
            saveProfileBtn.style.display = 'none';
            cancelProfileBtn.style.display = 'none';
        });
    }

    // Wishlist scrollable functionality - always 1 row, scrollable
    const wishlistGrid = document.querySelector('.wishlist-grid');
    if (wishlistGrid) {
        // Always enable horizontal scroll for wishlist
        wishlistGrid.style.overflowX = 'auto';
        wishlistGrid.style.overflowY = 'hidden';
        wishlistGrid.style.flexWrap = 'nowrap';
    }

    // View All button
    const viewAllBtn = document.querySelector('.view-all-btn');
    if (viewAllBtn) {
        viewAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('View All clicked');
            // Add your view all functionality here
        });
    }

    // Manage Wishlist button
    const manageWishlistBtn = document.querySelector('.manage-wishlist-btn');
    if (manageWishlistBtn) {
        manageWishlistBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Manage Wishlist clicked');
            // Add your manage wishlist functionality here
        });
    }

    // Detail buttons
    const detailButtons = document.querySelectorAll('.detail-btn');
    detailButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Detail button clicked');
            // Add your detail view functionality here
        });
    });

    // Logout button
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin logout?')) {
                console.log('Logout confirmed');
                // Add your logout functionality here
            }
        });
    }

    // Settings items click handlers
    const settingItems = document.querySelectorAll('.setting-item');
    settingItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't trigger if clicking on toggle switch
            if (!e.target.closest('.toggle-switch')) {
                console.log('Setting item clicked');
                // Add your settings navigation functionality here
            }
        });
    });

    // Toggle switch handler
    const toggleSwitch = document.querySelector('.toggle-switch input');
    if (toggleSwitch) {
        toggleSwitch.addEventListener('change', function() {
            console.log('Notification toggle:', this.checked);
            // Add your notification toggle functionality here
        });
    }

    // Google connection link
    const googleLink = document.querySelector('.google-link');
    if (googleLink) {
        googleLink.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Google connection clicked');
            // Add your Google connection functionality here
        });
    }

    // Header icon buttons
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Notifications clicked');
            // Add your notifications functionality here
        });
    }

    const cartBtn = document.querySelector('.cart-btn');
    if (cartBtn) {
        cartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Cart clicked');
            // Add your cart functionality here
        });
    }

    // Handle window resize for wishlist - always keep scrollable
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const wishlistGrid = document.querySelector('.wishlist-grid');
            if (wishlistGrid) {
                wishlistGrid.style.overflowX = 'auto';
                wishlistGrid.style.overflowY = 'hidden';
                wishlistGrid.style.flexWrap = 'nowrap';
            }
        }, 250);
    });
});

