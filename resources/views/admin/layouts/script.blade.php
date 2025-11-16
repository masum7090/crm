 <script>
     // Sidebar state
     let sidebarCollapsed = false;

     // Theme Toggle
     const themeBtn = document.getElementById('themeBtn');
     const moonIcon = document.getElementById('moonIcon');
     const sunIcon = document.getElementById('sunIcon');
     const html = document.documentElement;

     // Check for saved theme or system preference
     const isDark = html.classList.contains('dark');
     if (isDark) {
         moonIcon.classList.add('hidden');
         sunIcon.classList.remove('hidden');
     }

     themeBtn.addEventListener('click', () => {
         html.classList.toggle('dark');
         const isDarkNow = html.classList.contains('dark');

         if (isDarkNow) {
             moonIcon.classList.add('hidden');
             sunIcon.classList.remove('hidden');
         } else {
             moonIcon.classList.remove('hidden');
             sunIcon.classList.add('hidden');
         }
     });

     // Sidebar Toggle
     const menuBtn = document.getElementById('menuBtn');
     const sidebar = document.getElementById('sidebar');
     const main = document.getElementById('main');
     const backdrop = document.getElementById('backdrop');

     menuBtn.addEventListener('click', () => {
         if (window.innerWidth >= 1024) {
             // Desktop: collapse/expand sidebar
             sidebarCollapsed = !sidebarCollapsed;

             if (sidebarCollapsed) {
                 sidebar.classList.add('lg:w-20');
                 sidebar.classList.remove('lg:w-64');
                 main.classList.add('lg:ml-20');
                 main.classList.remove('lg:ml-64');

                 // Hide text elements
                 document.querySelectorAll('.sidebar-text').forEach(el => {
                     el.classList.add('lg:hidden');
                 });

                 // Center icons
                 document.querySelectorAll('#sidebar .flex.items-center.gap-3').forEach(el => {
                     el.classList.add('lg:justify-center');
                 });
             } else {
                 sidebar.classList.remove('lg:w-20');
                 sidebar.classList.add('lg:w-64');
                 main.classList.remove('lg:ml-20');
                 main.classList.add('lg:ml-64');

                 // Show text elements
                 document.querySelectorAll('.sidebar-text').forEach(el => {
                     el.classList.remove('lg:hidden');
                 });

                 // Remove centering
                 document.querySelectorAll('#sidebar .flex.items-center.gap-3').forEach(el => {
                     el.classList.remove('lg:justify-center');
                 });
             }
         } else {
             // Mobile: slide in/out sidebar
             sidebar.classList.toggle('-translate-x-full');
             backdrop.classList.toggle('opacity-0');
             backdrop.classList.toggle('invisible');
         }
     });

     backdrop.addEventListener('click', () => {
         sidebar.classList.add('-translate-x-full');
         backdrop.classList.add('opacity-0', 'invisible');
     });

     // Dropdown Menus
     const notificationDropdown = document.getElementById('notificationDropdown');
     const notificationMenu = document.getElementById('notificationMenu');
     const userDropdown = document.getElementById('userDropdown');
     const userMenu = document.getElementById('userMenu');

     notificationDropdown.querySelector('button').addEventListener('click', (e) => {
         e.stopPropagation();
         notificationMenu.classList.toggle('opacity-0');
         notificationMenu.classList.toggle('invisible');
         notificationMenu.classList.toggle('translate-y-[-10px]');
         notificationMenu.classList.toggle('pointer-events-none');
         userMenu.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
     });

     userDropdown.querySelector('button').addEventListener('click', (e) => {
         e.stopPropagation();
         userMenu.classList.toggle('opacity-0');
         userMenu.classList.toggle('invisible');
         userMenu.classList.toggle('translate-y-[-10px]');
         userMenu.classList.toggle('pointer-events-none');
         notificationMenu.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
     });

     document.addEventListener('click', () => {
         notificationMenu.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
         userMenu.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
     });

     // Expandable Navigation Items
     const expandableItems = document.querySelectorAll('[data-expandable]');

     expandableItems.forEach(item => {
         const link = item.querySelector('.flex.items-center.gap-3');
         const children = item.querySelector('[data-children]');
         const arrow = link.querySelector('svg:last-child');

         link.addEventListener('click', (e) => {
             e.preventDefault();

             // Don't expand if sidebar is collapsed on desktop
             if (window.innerWidth >= 1024 && sidebarCollapsed) {
                 return;
             }

             if (children.style.maxHeight && children.style.maxHeight !== '0px') {
                 children.style.maxHeight = '0px';
                 arrow.style.transform = 'rotate(0deg)';
             } else {
                 children.style.maxHeight = children.scrollHeight + 'px';
                 arrow.style.transform = 'rotate(180deg)';
             }
         });
     });

     // Handle window resize
     window.addEventListener('resize', () => {
         if (window.innerWidth >= 1024) {
             sidebar.classList.remove('-translate-x-full');
             backdrop.classList.add('opacity-0', 'invisible');

             // Reset sidebar state on resize
             if (!sidebarCollapsed) {
                 sidebar.classList.remove('lg:w-20');
                 sidebar.classList.add('lg:w-64');
                 main.classList.remove('lg:ml-20');
                 main.classList.add('lg:ml-64');
                 document.querySelectorAll('.sidebar-text').forEach(el => {
                     el.classList.remove('lg:hidden');
                 });
             }
         } else {
             sidebar.classList.add('-translate-x-full');
             // Reset collapsed state on mobile
             sidebarCollapsed = false;
         }
     });

     // Animate progress bars on load
     window.addEventListener('load', () => {
         const progressBars = document.querySelectorAll('.h-full.bg-primary');
         progressBars.forEach(bar => {
             const width = bar.style.width;
             bar.style.width = '0';
             setTimeout(() => {
                 bar.style.width = width;
             }, 100);
         });
     });
 </script>
