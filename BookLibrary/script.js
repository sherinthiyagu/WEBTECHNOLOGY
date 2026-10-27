"use strict";

$(document).ready(function () {

    
    const API_URL = "https://openlibrary.org/search.json";

    
    const $searchForm = $("#searchForm");
    const $searchInput = $("#searchInput");
    const $searchButton = $("#searchButton");
    const $sortSelect = $("#sortSelect");
    const $bookList = $("#bookList");
    const $statusMessage = $("#statusMessage");
    const $loader = $("#loader");
    const $resultCount = $("#resultCount");

    let books = [];
    let currentRequest = null;

    
    function showMessage(message, type = "") {
        $statusMessage
            .removeClass("error success")
            .addClass(type)
            .text(message)
            .prop("hidden", false);
    }

    function setLoading(isLoading) {
        $loader.prop("hidden", !isLoading);
        $searchButton.prop("disabled", isLoading);
        $searchInput.prop("disabled", isLoading);

        if (isLoading) {
            $bookList.empty();
            $resultCount.text("Loading...");
            $statusMessage.prop("hidden", true);
        }
    }

   
    function formatYear(year) {
        return Number.isInteger(year)
            ? year
            : "Not available";
    }

    function createBookCard(book) {
        const title = book.title || "Untitled";

        const authors = Array.isArray(book.author_name)
            ? book.author_name.join(", ")
            : "Unknown author";

        const year = formatYear(book.first_publish_year);

        const $card = $("<article>")
            .addClass("book-card");

       
        if (book.cover_i) {
            const coverUrl =
                "https://covers.openlibrary.org/b/id/" +
                encodeURIComponent(book.cover_i) +
                "-M.jpg";

            const $cover = $("<img>")
                .addClass("book-cover")
                .attr("src", coverUrl)
                .attr("alt", "Cover of " + title)
                .attr("loading", "lazy");

            $cover.on("error", function () {
                $(this).remove();
            });

            $card.append($cover);
        }

       
        $("<h2>")
            .addClass("book-title")
            .text(title)
            .appendTo($card);

        // Author information
        $("<p>")
            .addClass("book-meta")
            .append(
                $("<strong>").text("Author: ")
            )
            .append(
                document.createTextNode(authors)
            )
            .appendTo($card);

        
        $("<p>")
            .addClass("book-meta")
            .append(
                $("<strong>").text("Published: ")
            )
            .append(
                document.createTextNode(String(year))
            )
            .appendTo($card);

        
        const workKey = typeof book.key === "string"
            ? book.key
            : "";

        if (/^\/works\/OL\d+W$/.test(workKey)) {
            $("<a>")
                .addClass("book-link")
                .attr(
                    "href",
                    "https://openlibrary.org" + workKey
                )
                .attr("target", "_blank")
                .attr("rel", "noopener noreferrer")
                .text("View Book Details →")
                .appendTo($card);
        }

        return $card;
    }

    
    function displayBooks() {
        $bookList.empty();

        const sortBy = $sortSelect.val();

        const sortedBooks = [...books].sort(function (a, b) {

            if (sortBy === "year") {
                const yearA = a.first_publish_year || 0;
                const yearB = b.first_publish_year || 0;

                return yearB - yearA;
            }

            return (a.title || "").localeCompare(
                b.title || "",
                undefined,
                { sensitivity: "base" }
            );
        });

        
        sortedBooks.forEach(function (book) {
            $bookList.append(createBookCard(book));
        });

        
        const count = sortedBooks.length;

        $resultCount.text(
            count + (count === 1
                ? " book found"
                : " books found")
        );

        if (count > 0) {
            showMessage(
                "Books retrieved successfully.",
                "success"
            );
        } else {
            showMessage(
                "No books found. Try another search."
            );
        }
    }

    
    function fetchBooks(query) {

        
        if (currentRequest) {
            currentRequest.abort();
        }

        setLoading(true);

        const request = $.ajax({
            url: API_URL,
            method: "GET",
            dataType: "json",
            timeout: 15000,

            data: {
                q: query,
                limit: 18,
                fields: [
                    "key",
                    "title",
                    "author_name",
                    "first_publish_year",
                    "cover_i"
                ].join(",")
            }
        });

        currentRequest = request;

        
        request.done(function (response) {

            books = Array.isArray(response.docs)
                ? response.docs
                : [];

            displayBooks();
        });

        
        request.fail(function (xhr, status) {

            if (status === "abort") {
                return;
            }

            books = [];
            $bookList.empty();
            $resultCount.text("0 books found");

            if (status === "timeout") {
                showMessage(
                    "Request timed out. Please try again.",
                    "error"
                );
            } else {
                showMessage(
                    "Unable to fetch books. Check your internet connection and try again.",
                    "error"
                );
            }
        });

       
        request.always(function () {

            if (currentRequest === request) {
                currentRequest = null;
                setLoading(false);
            }
        });
    }

   
    $searchForm.on("submit", function (event) {
        event.preventDefault();

        const query = $searchInput.val().trim();

        if (!query) {
            showMessage(
                "Please enter a book title or author.",
                "error"
            );

            $searchInput.trigger("focus");
            return;
        }

        fetchBooks(query);
    });

    
    $sortSelect.on("change", function () {

        if (books.length > 0) {
            displayBooks();
        }
    });

});