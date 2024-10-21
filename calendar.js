function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
    if (!event.target.matches('.rounded-img')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


function loadTasks() {
    const month = parseInt(document.getElementById("month-dropdown").value) + 1; // Correct month indexing for PHP
    const year = document.getElementById("year-dropdown").value;

    fetch(`fetchTasks.php?month=${month}&year=${year}`)
        .then(response => response.json())
        .then(data => {
            generateCalendar(data.tasks, month - 1, year); // Zero-index month for JS
        });
}


function generateCalendar(tasks, month, year) {
    const calendarGrid = document.getElementById("calendar-grid");
    calendarGrid.innerHTML = '';  // Clear existing calendar

    const daysInMonth = new Date(year, month + 1, 0).getDate();  // Get number of days in the selected month
    const firstDay = new Date(year, month, 1).getDay();
    const today = new Date();

    // Create weekday headers
    const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    weekdays.forEach(weekday => {
        const header = document.createElement('div');
        header.className = 'weekday-header';
        header.textContent = weekday;
        calendarGrid.appendChild(header);
    });

    // Fill in blank days for the first week
    for (let i = 0; i < firstDay; i++) {
        const blankCell = document.createElement('div');
        blankCell.className = 'day-cell';
        calendarGrid.appendChild(blankCell);
    }

    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayCell = document.createElement('div');
        dayCell.className = 'day-cell';
        dayCell.textContent = day;

        // Highlight today
        if (day === today.getDate() && month === today.getMonth() && year == today.getFullYear()) {
            dayCell.classList.add('today');
        }

        // Add tasks for this day
        const taskList = tasks.filter(task => new Date(task.due_date).getDate() === day);
        taskList.forEach(task => {
            const taskItem = document.createElement('div');
            taskItem.className = 'task-item';
            taskItem.textContent = task.task_name;

            // Apply color based on task status
            if (task.status === 'Pending') {
                taskItem.style.backgroundColor = 'red';
            } else if (task.status === 'In Progress') {
                taskItem.style.backgroundColor = 'yellow';
            } else if (task.status === 'Completed') {
                taskItem.style.backgroundColor = 'green';
            }

            dayCell.appendChild(taskItem);
        });

        calendarGrid.appendChild(dayCell);
    }
}
