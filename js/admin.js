
document.addEventListener('DOMContentLoaded', () => {
    const dashboardShell = document.getElementById('studentDashboardShell');
    const sidebarToggle = document.querySelector('.student-sidebar-toggle');
    const mobileToggle = document.querySelector('.student-mobile-toggle');
    const sidebarBackdrop = document.querySelector('.student-sidebar-backdrop');

    const setSidebarState = (open) => {
        if (!dashboardShell) return;
        dashboardShell.classList.toggle('sidebar-open', open);
        mobileToggle?.setAttribute('aria-expanded', String(open));
        sidebarToggle?.setAttribute('aria-expanded', String(open));
        sidebarToggle?.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
        mobileToggle?.setAttribute('aria-label', open ? 'Close admin navigation' : 'Open admin navigation');
    };

    sidebarToggle?.addEventListener('click', () => {
        if (window.matchMedia('(max-width: 900px)').matches) {
            setSidebarState(!dashboardShell?.classList.contains('sidebar-open'));
            return;
        }

        const collapsed = dashboardShell?.classList.toggle('sidebar-collapsed') ?? false;
        sidebarToggle.setAttribute('aria-expanded', String(!collapsed));
        sidebarToggle.setAttribute('aria-label', collapsed ? 'Expand navigation' : 'Collapse navigation');
    });

    mobileToggle?.addEventListener('click', () => {
        setSidebarState(!dashboardShell?.classList.contains('sidebar-open'));
    });
    sidebarBackdrop?.addEventListener('click', () => setSidebarState(false));

    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');

            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanels.forEach(p => p.classList.remove('active'));

            btn.classList.add('active');
            const targetPanel = document.getElementById(targetId);
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        });
    });

    const openModalBtns = document.querySelectorAll('[data-open-modal]');
    const closeModalBtns = document.querySelectorAll('[data-close-modal]');
    const modalBackdrops = document.querySelectorAll('.modal-backdrop');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-open-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
            }
        });
    });

    document.querySelectorAll('.course-schedule-edit').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('courseScheduleModal');
            if (!modal) return;

            modal.querySelector('#schedule_course_id').value = button.dataset.courseId || '';
            modal.querySelector('#schedule_course_name').textContent = button.dataset.courseName || '';
            modal.querySelector('#schedule_start_time').value = button.dataset.start || '';
            modal.querySelector('#schedule_end_time').value = button.dataset.end || '';
            modal.querySelector('#schedule_room').value = button.dataset.room || '';

            const days = (button.dataset.days || '').split(',').filter(Boolean);
            modal.querySelectorAll('input[name="meeting_days[]"]').forEach(input => {
                input.checked = days.includes(input.value);
            });
        });
    });

    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.modal-backdrop');
            if (modal) {
                modal.classList.remove('active');
            }
        });
    });

    modalBackdrops.forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    });

    const searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(input => {
        const tableId = input.getAttribute('data-table-search');
        const table = document.getElementById(tableId);
        if (!table) return;

        input.addEventListener('input', () => {
            const query = input.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    const autoAlerts = document.querySelectorAll('.alert');
    autoAlerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        }, 4500);
    });
});
