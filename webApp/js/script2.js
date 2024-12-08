
// Hardcoded start date - replace this with the user-selected date
const startDate = new Date('2024-05-01'); // YYYY-MM-DD format




// Handling all mid sections and left-section divs scrolling show/hide
// Initializing all the mid-sections and the left-section
// Buttons
const schdBtn = document.getElementById('schdBtn');
const taskBtn = document.getElementById('taskBtn');
const classesBtn = document.getElementById('classesBtn');
const semestersBtn = document.getElementById('semestersBtn');
const yearsBtn = document.getElementById('yearsBtn');
// Sections
const schdSection = document.querySelector('.schd-section');
const tasksSection = document.querySelector('.tasks-section');
const classesSection = document.querySelector('.classes-section');
const semestersSection = document.querySelector('.semesters-section');
const yearsSection = document.querySelector('.years-section');
const midSection = document.querySelector('.mid-section');
const leftSection = document.querySelector('.left-section');
// Definitions
let isMidSectionVisible = false;
let isScheduleSectionVisible = false;
let isTasksSectionVisible = false;
let isClassesSectionVisible = false;
let isSemestersSectionVisible = false;
let isYearsSectionVisible = false;
// Initially hide the mid-section
midSection.style.display = 'none';
schdSection.style.display = 'none';
tasksSection.style.display = 'none';
classesSection.style.display = 'none';
semestersSection.style.display = 'none';
yearsSection.style.display = 'none';
// schdSection
document.addEventListener('DOMContentLoaded', function () {
    // Code for mid-section and mid-tap behavior
    schdBtn.addEventListener('click', function () {
        if (!isScheduleSectionVisible) {
            // Show mid-section and hide left-section
            midSection.style.display = 'block';
            midSection.style.marginLeft = '0'; // Slide in
            schdSection.style.display = 'block';
            schdSection.style.marginLeft = '0'; // Slide in
            leftSection.style.display = 'none';
        } else {
            // Hide mid-section and show left-section
            midSection.style.marginLeft = '-100%'; // Slide out
            schdSection.style.marginLeft = '-100%'; // Slide out
            setTimeout(function () {
                midSection.style.display = 'none';
                schdSection.style.display = 'none';
                leftSection.style.display = 'block';
            }, 300); // Delay to match the sliding animation duration
        }
        isMidSectionVisible = !isMidSectionVisible;
        isScheduleSectionVisible = !isScheduleSectionVisible;
    });
    // Code to scroll grids to a week before the current date
    scrollToWeekBefore();
});
// tasksSection
document.addEventListener('DOMContentLoaded', function () {
    // Code for mid-section and mid-tap behavior
    taskBtn.addEventListener('click', function () {
        if (!isTasksSectionVisible) {
            // Show mid-section and hide left-section
            midSection.style.display = 'block';
            midSection.style.marginLeft = '0'; // Slide in
            tasksSection.style.display = 'block';
            tasksSection.style.marginLeft = '0'; // Slide in
            leftSection.style.display = 'none';
        } else {
            // Hide mid-section and show left-section
            midSection.style.marginLeft = '-100%'; // Slide out
            tasksSection.style.marginLeft = '-100%'; // Slide out
            setTimeout(function () {
                midSection.style.display = 'none';
                tasksSection.style.display = 'none';
                leftSection.style.display = 'block';
            }, 300); // Delay to match the sliding animation duration
        }
        isMidSectionVisible = !isMidSectionVisible;
        isTasksSectionVisible = !isTasksSectionVisible;
    });
    // Code to scroll grids to a week before the current date
    scrollToWeekBefore();
});
// classesSection
document.addEventListener('DOMContentLoaded', function () {
    // Code for mid-section and mid-tap behavior
    classesBtn.addEventListener('click', function () {
        if (!isClassesSectionVisible) {
            // Show mid-section and hide left-section
            midSection.style.display = 'block';
            midSection.style.marginLeft = '0'; // Slide in
            classesSection.style.display = 'block';
            classesSection.style.marginLeft = '0'; // Slide in
            leftSection.style.display = 'none';
        } else {
            // Hide mid-section and show left-section
            midSection.style.marginLeft = '-100%'; // Slide out
            classesSection.style.marginLeft = '-100%'; // Slide out
            setTimeout(function () {
                midSection.style.display = 'none';
                classesSection.style.display = 'none';
                leftSection.style.display = 'block';
            }, 300); // Delay to match the sliding animation duration
        }
        isMidSectionVisible = !isMidSectionVisible;
        isClassesSectionVisible = !isClassesSectionVisible;
    });
    // Code to scroll grids to a week before the current date
    scrollToWeekBefore();
});
// semestersSection
document.addEventListener('DOMContentLoaded', function () {
    // Code for mid-section and mid-tap behavior
    semestersBtn.addEventListener('click', function () {
        yearsSection.style.display = 'none';
        if (!isSemestersSectionVisible) {
            // Show mid-section and hide left-section
            midSection.style.display = 'block';
            midSection.style.marginLeft = '0'; // Slide in
            semestersSection.style.display = 'block';
            semestersSection.style.marginLeft = '0'; // Slide in
            leftSection.style.display = 'none';
        } else {
            // Hide mid-section and show left-section
            midSection.style.marginLeft = '-100%'; // Slide out
            semestersSection.style.marginLeft = '-100%'; // Slide out
            setTimeout(function () {
                midSection.style.display = 'none';
                semestersSection.style.display = 'none';
                leftSection.style.display = 'block';
            }, 300); // Delay to match the sliding animation duration
        }
        isMidSectionVisible = !isMidSectionVisible;
        isSemestersSectionVisible = !isSemestersSectionVisible;
    });
    // Code to scroll grids to a week before the current date
    scrollToWeekBefore();
});
// yearsSection
document.addEventListener('DOMContentLoaded', async function () {
    let isYearsSectionVisible = false;
    const yearsBtn = document.getElementById('yearsBtn');
    const leftSection = document.querySelector('.left-section');
    const midSection = document.querySelector('.mid-section');
    const yearsSection = document.querySelector('.years-section');

    yearsBtn.addEventListener('click', function () {
        if (!isYearsSectionVisible) {
            // Show mid-section and hide left-section
            midSection.style.display = 'block';
            midSection.style.marginLeft = '0'; // Slide in
            yearsSection.style.display = 'block';
            yearsSection.style.marginLeft = '0'; // Slide in
            leftSection.style.display = 'none';

            // Load and display years data only if it has not been loaded before
            if (!isYearsSectionVisible) {
                loadAndDisplayYearsData();
                // Code to scroll grids to a week before the current date
                scrollToWeekBefore();
            }
        } else {
            // Hide mid-section and show left-section
            midSection.style.marginLeft = '-100%'; // Slide out
            yearsSection.style.marginLeft = '-100%'; // Slide out
            setTimeout(function () {
                midSection.style.display = 'none';
                yearsSection.style.display = 'none';
                leftSection.style.display = 'block';
            }, 300); // Delay to match the sliding animation duration
            // Code to scroll grids to a week before the current date
            scrollToWeekBefore();
        }
        isYearsSectionVisible = !isYearsSectionVisible;
        semestersSection.style.display = 'none';
    });


});

function loadAndDisplayYearsData() {
    fetch('fetchYears.php')
        .then(response => response.json())
        .then(data => {
            const yearsList = document.querySelector('.yearsList');
            const fragment = document.createDocumentFragment();

            data.forEach(yearObj => {
                const li = createYearListItem(yearObj);
                fragment.appendChild(li);
            });

            yearsList.innerHTML = '';
            yearsList.appendChild(fragment);
        })
        .catch(error => console.error('Error:', error));
}

function createYearListItem(yearObj) {
    const li = document.createElement('li');
    li.innerHTML = `
        <div class="yearDiv">
            <input type="text" class="yearValue" id="year-${yearObj.y_id}" disabled value="${yearObj.year}" />
            <button class="editSaveBtn">Edit</button>
            <button class="delBtn">Delete</button>
        </div>`;
    return li;
}
// Adding new year
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('yearsForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var yearInput = document.getElementById('yearInput');
        var yearValue = yearInput.value;

        // AJAX request to addYear.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'home.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.includes('already exists')) {
                    alert(this.responseText); // Or handle this message in another way
                } else if (this.responseText !== "exists") {
                    var newLi = '<li><div class="yearDiv"><input type="text" class="yearValue" id="year-' + this.responseText + '" disabled value="' + yearValue + '" /><button class="editSaveBtn">Edit</button><button class="delBtn">Delete</button></div></li>';
                    document.querySelector('.yearsList').innerHTML += newLi;
                }
                yearInput.value = ''; // Clear the input field
                yearInput.focus(); // Focus the input field
            }
        };

        xhr.send('year=' + encodeURIComponent(yearValue));
    });
});


// Function to add days to a date
function addDays(date, days) {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

// Create the header grid
const schdHeader = document.querySelector('.schd-header');
const totalColumns = 121;
const headerRows = Array.from({ length: 4 }, () => []);

for (let row = 0; row < 4; row++) {
    const rowDiv = document.createElement('div');
    rowDiv.classList.add('matrix-row');
    for (let col = 1; col < totalColumns; col++) {
        const cell = document.createElement('div');
        cell.classList.add('header-cell');

        // Filling the second row (row index 1) with numbers
        if (row === 1) {
            cell.textContent = col + 1; // Adding 1 because col starts from 0
        }

        // Filling the third and fourth rows with day names and day numbers
        if (row === 2 || row === 3) {
            const currentDate = addDays(startDate, col);
            cell.textContent = row === 2 ? currentDate.toLocaleDateString('en-US', { weekday: 'short' }) : currentDate.getDate();
        }

        // Special text for the last cell of each row
        if (col === 120) {
            const firstRowTexts = ["M&W#", "Num", "D.N", "D.#"];
            cell.textContent = firstRowTexts[row];
        } else {
            if (row === 1) {
                cell.textContent = col; // Adding column numbers for the second row
            } else if (row === 2 || row === 3) {
                const currentDate = addDays(startDate, col); // Subtract 1 because col starts from 0
                cell.textContent = row === 2 ? currentDate.toLocaleDateString('en-US', { weekday: 'short' }) : currentDate.getDate();
            }
        }


        // Update first row cell's value (month number) based on fourth row
        headerRows[3].forEach((cell, index) => {
            if (cell.textContent === "1") {
                const date = addDays(startDate, index - 1);
                headerRows[0][index].textContent = (date.getMonth() + 2); // Month number
            }
        });

        // function: get week number
        function getWeekNumber(date) {
            const startOfYear = new Date(date.getFullYear(), 0, 1);
            const days = Math.floor((date - startOfYear) / (24 * 60 * 60 * 1000)) + ((startOfYear.getDay() + 6) % 7);
            return Math.ceil(days / 7);
        }

        // Update first row cell's value (week number) based on fourth row
        headerRows[2].forEach((cell, index) => {
            if (cell.textContent === "Sun") {  // Assuming you want to update the week number when the day is the first of the month
                const date = addDays(startDate, index);
                headerRows[0][index].textContent = "W " + (getWeekNumber(date));
            }
        });

        // Highlighting weekends
        // Function to update header and matrix grid colors
        function updateGridColors() {
            headerRows[2].forEach((cell, index) => {
                if (cell.textContent === "Sat" || cell.textContent === "Sun") {
                    // Update header rows
                    headerRows.forEach(row => {
                        if (row[index]) { // Check if the cell exists to avoid errors
                            row[index].style.backgroundColor = 'rgba(45, 45, 45)';
                        }
                    });

                    // Update corresponding matrix grid columns
                    const matrixRows = document.querySelectorAll('.schd-matrix .matrix-row');
                    matrixRows.forEach(matrixRow => {
                        const matrixCell = matrixRow.children[index];
                        if (matrixCell) {
                            matrixCell.style.backgroundColor = 'rgba(45, 45, 45)';
                        }
                    });
                }
            });
        }
        // Ensure that the update function is called after the matrix grid is fully created
        document.addEventListener('DOMContentLoaded', function () {
            updateGridColors();
        });

        // Highlighting the current month
        // Function that changes the background color of cells in the first row of the header grid based on whether the date in the fourth row belongs to the current month
        function highlightCurrentMonth() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth();

            headerRows[3].forEach((cell, index) => {
                // Calculate the date of each cell based on the startDate and index
                const cellDate = new Date(startDate);
                cellDate.setDate(startDate.getDate() + index + 1);

                // Check if the year and month of the cell's date match the current year and month
                if (cellDate.getFullYear() === currentYear && cellDate.getMonth() === currentMonth) {
                    // Change the background color of the corresponding cell in the first row
                    if (headerRows[0][index]) {
                        headerRows[0][index].style.backgroundColor = 'rgba(50, 60, 31, 3)';
                        // headerRows[0][index].style.backgroundColor = 'rgba(31,31,31,10)';
                    }
                }
            });
        }
        // Ensure that the update function is called after the matrix grid is fully created
        document.addEventListener('DOMContentLoaded', function () {
            highlightCurrentMonth();
        });

        // Highlighting the current week
        // Helper function to get the week number of a given date
        function getWeekNumber(d) {
            // Copy date so don't modify original
            d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
            // Set to nearest Sunday: current date - current day number
            d.setUTCDate(d.getUTCDate() - d.getUTCDay());
            // Get first day of the year
            const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
            // Adjust if the year starts before the first Sunday
            if (yearStart.getUTCDay() !== 0) {
                yearStart.setUTCDate(yearStart.getUTCDate() - yearStart.getUTCDay());
            }
            // Calculate full weeks to nearest Sunday
            const weekNo = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
            return weekNo;
        }
        // Function that changes the background color of cells in the first row of the header grid if the date in the fourth row belongs to the current week
        function highlightCurrentWeek() {
            const currentDate = new Date();
            const currentWeekNumber = getWeekNumber(currentDate);

            headerRows[3].forEach((cell, index) => {
                // Calculate the date of each cell based on the startDate and index
                const cellDate = new Date(startDate);
                cellDate.setDate(startDate.getDate() + index + 1); // +1 to start on sunday

                // Check if the week number of the cell's date matches the current week number
                if (getWeekNumber(cellDate) === currentWeekNumber) {
                    // Change the background color of the corresponding cell in the first row
                    if (headerRows[0][index]) {
                        headerRows[0][index].style.backgroundColor = 'rgba(31, 41, 31, 0.5)';
                    }
                }
            });
        }
        // Ensure that the update function is called after the matrix grid is fully created
        document.addEventListener('DOMContentLoaded', function () {
            highlightCurrentWeek();
        });

        // Highlighting current date
        function highlightCurrentDateColumn() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth();
            const currentDay = currentDate.getDate();

            headerRows[3].forEach((cell, index) => {
                const cellDate = new Date(startDate);
                cellDate.setDate(startDate.getDate() + index + 1);

                if (cellDate.getFullYear() === currentYear && cellDate.getMonth() === currentMonth && cellDate.getDate() === currentDay) {
                    // console.log("Current date column found at index:", index); // Debug log

                    // Highlight the corresponding column in the header grid
                    headerRows.forEach(row => {
                        if (row[index]) {
                            row[index].style.borderLeft = '2px solid green';
                            row[index].style.borderRight = '2px solid green';
                        }
                    });

                    // Highlight the corresponding column in the matrix grid
                    const matrixRows = document.querySelectorAll('.schd-matrix .matrix-row');
                    matrixRows.forEach(matrixRow => {
                        const matrixCell = matrixRow.children[index];
                        if (matrixCell) {
                            matrixCell.style.borderLeft = '2px solid rgb(255, 0, 0)';
                            matrixCell.style.borderRight = '2px solid rgb(255, 0, 0)';
                            matrixCell.style.color = 'red'; // Change the font color to red
                        }
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            highlightCurrentDateColumn();
        });

        // Scrolling both grids sync
        function syncScroll(elementToScroll, sourceElement) {
            // Avoid infinite loop by checking if the scroll position is already the same
            if (elementToScroll.scrollLeft !== sourceElement.scrollLeft) {
                elementToScroll.scrollLeft = sourceElement.scrollLeft;
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const headerGridContainer = document.querySelector('.schd-header');
            const matrixGridContainer = document.querySelector('.schd-matrix');

            if (headerGridContainer && matrixGridContainer) {
                // When the header grid is scrolled, update the matrix grid's scroll position
                headerGridContainer.addEventListener('scroll', function () {
                    syncScroll(matrixGridContainer, headerGridContainer);
                });

                // When the matrix grid is scrolled, update the header grid's scroll position
                matrixGridContainer.addEventListener('scroll', function () {
                    syncScroll(headerGridContainer, matrixGridContainer);
                });
            }
        });


        // Scrolling grids over to a week before current date
        function scrollToWeekBefore() {
            // Calculate the date for one week before the current date
            const oneWeekBefore = new Date();
            oneWeekBefore.setDate(oneWeekBefore.getDate() - 8);

            // Calculate the number of days since the start date
            const daysSinceStart = Math.floor((oneWeekBefore - new Date(startDate)) / (1000 * 60 * 60 * 24));

            // Calculate the scroll position based on the width of each cell (40px)
            const columnWidth = 40; // Width of each cell
            const scrollPosition = daysSinceStart * columnWidth;

            const headerGridContainer = document.querySelector('.schd-header');
            const matrixGridContainer = document.querySelector('.schd-matrix');

            if (headerGridContainer && matrixGridContainer) {
                headerGridContainer.scrollLeft = scrollPosition;
                matrixGridContainer.scrollLeft = scrollPosition;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            scrollToWeekBefore();
        });



        rowDiv.appendChild(cell);
        headerRows[row].push(cell); // Store the cell for later access
    }
    schdHeader.appendChild(rowDiv);
}

// Create the matrix grid
const matrix = document.querySelector('.schd-matrix');
for (let row = 0; row < 50; row++) {
    const rowDiv = document.createElement('div');
    rowDiv.classList.add('matrix-row');
    for (let col = 0; col < 120; col++) {
        const cell = document.createElement('div');
        cell.classList.add('matrix-cell');
        cell.dataset.row = row;
        cell.dataset.col = col;
        rowDiv.appendChild(cell);
    }
    matrix.appendChild(rowDiv);
}
