$(document).ready(function () {

    var departmentDropdown = $("#student_department");
    var courseDropdown = $("#course");
    var studentlevelDropdown = $("#student_level");

    var departmentOptions = {
        0: ["Nursery 1", "Nursery 2", "Kinder 2"],
        1: ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"],
        2: ["Grade 7", "Grade 8", "Grade 9", "Grade 10"],
        3: ["Grade 11", "Grade 12"],
        4: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        5: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        6: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        7: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        8: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        9: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        10: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
        11: ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"],
    };

    var courseOptions = {
        4: [
            "Political Science",
            "Psychology",
            "Biology",
            "Environmental Science",
        ],
        5: [
            "Computer Technology",
            "Library in Information System",
            "Computer Science",
            "Information Technology",
        ],
        6: ["Criminology"],
        7: [
            "Physical Education",
            "Elementary Education",
            "Secondary Education Major in English",
            "Secondary Education Major in Filipino",
            "Secondary Education Major in Mathematics",
            "Secondary Education Major in Science",
            "Special Needs Education Major in Teaching Deaf And Hard-of-Hearing Learners",
            "Special Needs Education Major in Teaching Learners W/ Visual Impairment",
            "Teacher Certificate Program-MAPEH",
        ],
        8: [
            "Architecture",
            "Civil Engineering",
            "Computer Engineering",
            "Electrical Engineering",
            "Electronics Engineering",
            "Mechanical Engineering",
        ],
        9: [
            "Accountancy",
            "Accounting Information System",
            "Business Administration Major in Financial Management",
            "Business Administration Major in Marketing Management",
            "Business Administration Major in Digital Marketing",
            "Entrepreneurship",
            "Hospitality Management",
            "Tourism Management",
            "ETEEAP",
            "Business Administration Major in Human Resource Management",
            "Business Administration Major in Operation Management",
        ],
        10: ["Nursing", "Caregiving NCII (7 Months)"],
        11: ["Juris Doctor", "Master of Laws", "Refresher Course"],
    };

    departmentDropdown.on("change", function () {
        var selectedDepartment = parseInt(departmentDropdown.val());

        // Clear existing options in both dropdowns
        courseDropdown.empty();
        studentlevelDropdown.empty();

        // Show appropriate dropdown and populate options
        if (selectedDepartment in departmentOptions) {
            // Populate student level dropdown
            populateDropdown(
                studentlevelDropdown,
                departmentOptions[selectedDepartment]
            );

            // Check if the selected student level is from Kinder to Senior High School
            if ([0, 1, 2, 3].includes(selectedDepartment)) {
                // Disable the course dropdown
                courseDropdown.prop("disabled", true);
                courseDropdown.append(
                    '<option value="">Option Disabled</option>'
                );
            } else {
                // Enable the course dropdown for other options
                courseDropdown.prop("disabled", false);

                // Populate course options if available
                if (selectedDepartment in courseOptions) {
                    populateDropdown(
                        courseDropdown,
                        courseOptions[selectedDepartment]
                    );
                }
            }
        }
    });

    function populateDropdown(dropdown, options) {
        options.forEach(function (option, index) {
            dropdown.append(
                '<option value="' + (index + 1) + '">' + option + "</option>"
            );
        });
    }
    var departmentValue = "{{ $students->student_department}}";
    var studentLevelValue = "{{ $students->student_level}}";
    var courseValue = "{{ $students->course}}";

    // Set selected values to dropdowns
    departmentDropdown.val(departmentValue).trigger("change");
    studentlevelDropdown.val(studentLevelValue).trigger("change");
    courseDropdown.val(courseValue);
});
