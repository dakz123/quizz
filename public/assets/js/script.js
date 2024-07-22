$(document).ready(function () {
    const itemsPerPage = 6;
    let currentPage = 1;
    let r = [];
    let d = [];
    function fetchData() {
        $.ajax({
            url: "https://the-trivia-api.com/api/questions", // Replace with your API endpoint
            type: "GET",
            dataType: "json", // The type of data that you're expecting back from the server
            success: function (data) {
                $.each(data, function (index, item) {
                    if ($.inArray(item.category, r) === -1) {
                        r.push(item.category);
                    }
                });
                d = data || []; // Adjust this based on the actual structure of your response
                $("#timer").hide();
                renderData();
                renderPagination();
            },
            error: function (xhr, status, error) {
                // Handle errors here
                $("#data").html("<p>Error: " + error + "</p>");
            },
        });
    }

    function renderData() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedData = r.slice(start, end);

        $("#data-container").empty();
        $.each(paginatedData, function (index, category) {
            const htmlContent = `<div class="data-block" data-category="${category}">
                        <h3>${category}</h3>
                        
                    </div>`;
            $("#data-container").append(htmlContent);
        });
    }

    function renderPagination() {
        const totalPages = Math.ceil(r.length / itemsPerPage);
        $("#pagination").empty();

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = $(`<li>${i}</li>`);
            if (i === currentPage) {
                pageItem.addClass("active");
            }
            pageItem.click(function () {
                currentPage = i;
                renderData();
                renderPagination();
            });
            $("#pagination").append(pageItem);
        }
    }
    $(document).on("click", ".data-block", function () {
        $("#timer").show();
        var category = $(this).data("category");

        var question = d.find(function (item) {
            return item.category === category;
        });
        console.log(question.question);
        if (question) {
            // Construct the URL using Laravel's route name

            question.incorrectAnswers.push(question.correctAnswer);

            $("#data-container").html(`
                         
                        <div class="question-block"> ${question.question}</div>
                       <div class="answer-block"> ${$.each(
                           question.incorrectAnswers,
                           function (index, answer) {
                               `<div class="answer" >
                        <h3>${answer}</h3>
                        
                    </div>`;
                           }
                       )}</div>
                    `);
            $("#pagination").remove();
        } else {
            console.log("No question found for category:", category);
        }
    });
    var timerDuration = 60; // 60 seconds
    var timerDisplay = $("#timer");
    startTimer(timerDuration, timerDisplay);
    function startTimer(duration, display) {
        var timer = duration,
            minutes,
            seconds;
        var interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                clearInterval(interval);
                display.text("Time's up!");
            }
        }, 1000);
    }

    // Fetch data when the document is ready
    fetchData();
});
