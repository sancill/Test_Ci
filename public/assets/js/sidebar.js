/**
 * ====================================================================
 * ISBCOMMERCE SIDEBAR TOGGLE SYSTEM - SIMPLE VERSION
 * ====================================================================
 * Simple sidebar toggle - hanya fokus pada fungsi buka/tutup
 * ====================================================================
 */

(function() {
    'use strict';
    
    // Prevent multiple initializations
    if (window.__ISBCOMMERCE_SIDEBAR_INIT__) {
        return;
    }
    window.__ISBCOMMERCE_SIDEBAR_INIT__ = true;
    
    function initSidebar() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const dashboardContainer = document.querySelector('.dashboard-container');

        if (!sidebar || !sidebarToggle || !sidebarOverlay || !dashboardContainer) {
            // Retry after 100ms if elements not ready
            setTimeout(initSidebar, 100);
            return;
        }

        // Simple mobile detection
        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Simple toggle function
        function toggleSidebar(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            if (isMobile()) {
                // Mobile: toggle sidebar visibility
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            } else {
                // Desktop: toggle collapsed state
                dashboardContainer.classList.toggle('sidebar-collapsed');
                sidebar.classList.toggle('collapsed');
                
                // Save state
                const isCollapsed = dashboardContainer.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
        }

        // Close sidebar when overlay clicked
        function closeSidebar(e) {
            if (e) {
                e.preventDefault();
            }
            if (isMobile()) {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        }

        // Load saved state on page load (desktop only)
        function loadSavedState() {
            if (!isMobile()) {
                const saved = localStorage.getItem('sidebarCollapsed');
                if (saved === 'true') {
                    dashboardContainer.classList.add('sidebar-collapsed');
                    sidebar.classList.add('collapsed');
                } else {
                    dashboardContainer.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('collapsed');
                }
            } else {
                // Mobile: always start collapsed
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        }

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (isMobile()) {
                    // Mobile: close sidebar
                    sidebar.classList.add('collapsed');
                    sidebarOverlay.classList.remove('active');
                    dashboardContainer.classList.remove('sidebar-collapsed');
                } else {
                    // Desktop: restore saved state
                    sidebarOverlay.classList.remove('active');
                    loadSavedState();
                }
            }, 150);
        });

        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Prevent sidebar clicks from closing it (mobile)
        sidebar.addEventListener('click', function(e) {
            if (isMobile()) {
                e.stopPropagation();
            }
        });

        // Initialize
        loadSavedState();
    }
    
    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebar);
    } else {
        initSidebar();
    }
})();
