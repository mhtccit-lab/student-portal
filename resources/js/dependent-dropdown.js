document.addEventListener("DOMContentLoaded", function () {
    const institute = document.getElementById("institute");
    const trade = document.getElementById("trade");
    const course = document.getElementById("course");

    // ==============================
    // Institute → Trade
    // ==============================
    if (institute && trade) {
        institute.addEventListener("change", function () {
            trade.innerHTML = "<option>Loading...</option>";
            if (course) {
                course.innerHTML = '<option value="">Select Course</option>';
            }

            if (!this.value) {
                trade.innerHTML = '<option value="">Select Trade</option>';
                return;
            }

            fetch("/get-trades/" + this.value)
                .then((res) => res.json())
                .then((data) => {
                    trade.innerHTML = '<option value="">Select Trade</option>';

                    data.forEach((item) => {
                        trade.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                    });
                });
        });
    }

    // ==============================
    // Trade → Course
    // ==============================
    if (trade && course) {
        trade.addEventListener("change", function () {
            course.innerHTML = "<option>Loading...</option>";

            if (!this.value) {
                course.innerHTML = '<option value="">Select Course</option>';
                return;
            }

            fetch("/get-courses/" + this.value)
                .then((res) => res.json())
                .then((data) => {
                    course.innerHTML =
                        '<option value="">Select Course</option>';

                    data.forEach((item) => {
                        course.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                    });
                });
        });
    }
});
