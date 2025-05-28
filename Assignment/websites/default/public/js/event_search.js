// Store all events and track current page
let allEvents = [];
let currentPage = 1;
const eventsPerPage = 8;

document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('event_grid');
    const pagination = document.getElementById('pagination_controls');
    const searchInput = document.getElementById('global_search_input');
    const categorySelect = document.getElementById('event_filter');
    const filterType = document.getElementById('filter_type')?.value || '';

    // Build API URL based on filter
    const urlParams = new URLSearchParams(window.location.search);
    const filterParam = urlParams.get('filter') || '';
    const apiUrl = `api/get_events.php?filter=${filterParam}`;

    // Fetch events from server
    fetch(apiUrl)
        .then(res => res.json())
        .then(response => {
            if (response.status !== 'success') {
                grid.innerHTML = `<p>Error loading events.</p>`;
                return;
            }

            allEvents = response.data;
            applyFilters(); // Show events
        })
        .catch(err => {
            grid.innerHTML = `<p>Failed to load events.</p>`;
            console.error(err);
        });

    // Filter on search input
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            currentPage = 1;
            applyFilters();
        });
    }

    // Filter on category change
    if (categorySelect) {
        categorySelect.addEventListener('change', () => {
            currentPage = 1;
            applyFilters();
        });
    }

    // Apply search, category, and date filters
    function applyFilters() {
        const search = searchInput?.value?.toLowerCase() || '';
        const category = categorySelect?.value?.toLowerCase() || '';
        const today = new Date().toISOString().split('T')[0];

        const filtered = allEvents.filter(ev => {
            const matchesSearch =
                ev.title.toLowerCase().includes(search) ||
                ev.description.toLowerCase().includes(search) ||
                ev.location.toLowerCase().includes(search);

            const matchesCategory = !category || ev.category.toLowerCase() === category;
            const isPast = filterType === 'past' && ev.event_date < today;
            const isUpcoming = filterType === 'upcoming' && ev.event_date >= today;
            const noTimeFilter = !filterType;
            const matchesDate = noTimeFilter || isPast || isUpcoming;

            return matchesSearch && matchesCategory && matchesDate;
        });

        renderPaginatedEvents(filtered);
    }

    // Show events for current page
    function renderPaginatedEvents(events) {
        const totalPages = Math.ceil(events.length / eventsPerPage);
        const start = (currentPage - 1) * eventsPerPage;
        const paginatedEvents = events.slice(start, start + eventsPerPage);

        renderEvents(paginatedEvents);
        renderPaginationControls(totalPages);
    }

    // Render event cards
    function renderEvents(events) {
        if (!events.length) {
            grid.innerHTML = `<p>No matching events found.</p>`;
            return;
        }

        grid.innerHTML = events.map((ev, index) => `
            <div class="event_card">
                ${ev.image_path ? `
                    <div class="event_image">
                        <img src="${ev.image_path}" alt="${ev.title}">
                    </div>` : ''
            }
                <div class="event_details">
                    <h3 class="event_title">${ev.title}</h3>
                    <p class="event_description">
                        <span id="short-${index}">${ev.description.substring(0, 100)}...</span>
                        <span id="full-${index}" class="fade-toggle" style="display:none;">${ev.description}</span>
                    </p>
                    <button class="toggle_description_btn" onclick="toggleDescription(${index})">More</button>
                    <div class="event_meta">
                        <div class="event_location">${ev.location}</div>
                        <div class="event_date">${ev.event_date}</div>
                    </div>
                    <button class="register_button">Register</button>
                </div>
            </div>
        `).join('');
    }

    // Render pagination buttons
    function renderPaginationControls(totalPages) {
        if (totalPages <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let buttons = '';

        for (let i = 1; i <= totalPages; i++) {
            buttons += `<button 
                class="pagination_btn" 
                onclick="changePage(${i})" 
                ${i === currentPage ? 'disabled' : ''}>
                ${i}
            </button>`;
        }

        pagination.innerHTML = buttons;
    }

    // Change current page
    window.changePage = function (pageNum) {
        currentPage = pageNum;
        applyFilters();
    };

    // Toggle full/short event description
    window.toggleDescription = function (index) {
        const shortText = document.getElementById(`short-${index}`);
        const fullText = document.getElementById(`full-${index}`);
        const button = document.querySelector(`.toggle_description_btn[onclick="toggleDescription(${index})"]`);

        const showingFull = fullText.style.display !== 'none';

        shortText.style.display = showingFull ? 'inline' : 'none';
        fullText.style.display = showingFull ? 'none' : 'inline';
        fullText.classList.toggle('fade-in', !showingFull);
        button.innerText = showingFull ? 'More' : 'Less';
    };
});
