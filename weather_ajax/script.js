async function getWeather() {
    const city = document.getElementById("city").value.trim();
    const result = document.getElementById("result");

    if (city === "") {
        result.textContent = "Please enter a city name.";
        return;
    }

    const apiKey = "28be62ec546d43960a02c4f83ed245f5";

    const url =
        `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${apiKey}&units=metric`;

    result.textContent = "Loading weather data...";

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || "Unable to fetch weather.");
        }

        result.innerHTML = `
            <h2>${data.name}, ${data.sys.country}</h2>
            <div class="temperature">
                ${data.main.temp} &deg;C
            </div>
            <p>Condition: ${data.weather[0].description}</p>
            <p>Humidity: ${data.main.humidity}%</p>
            <p>Wind Speed: ${data.wind.speed} m/s</p>
        `;
    } catch (error) {
        result.textContent = "Error: " + error.message;
    }
}
