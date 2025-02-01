# Edmonton Weather Application

## A simple, modern functional project to display the current weather in Edmonton, Alberta using Laravel 11.x.

<a href="http://edmonton.weather.bergit.solutions/">🔗 This project has been published to my website. Click here to check it out!</a>

This project was created due to the inconvenience of weather websites I've tried, which do not have a live real-time weather 
display. I recently retired my old Microsoft Surface Pro 4 laptop and didn't want it to goto waste, so instead I fully stripped
the entire device of everything except the google chrome browser, and it's sole purpose was just to show the current time and weather.

 I first used the Environment Canada weather website which I loved but the only downside is it didn't have a live timer and real time
 weather updates, so every few hours I would need to refresh chrome which became inconvenient, so I made this application to use the
 Environment Canada weather API to get the exact same information I wanted but without having to refresh every few hours and I could
 actually show the time! 

You might be asking yourself, why didn't you just a script that would automatically refresh the page for you? 
Well to put it simply, that's just too boring and I wanted to make a modern looking design while looking at 
the weather everyday.

## ⚠️ Important things to mention
- In order to run this project you will need to modify the `.env` file located in the base directory of this project. Replace the file contents with the `.env.example` file an set the data inside accordingly.
  You can read more on [laravel's official documentation](https://laravel.com/docs/11.x/deployment) for deployment.
  
- Weather information obtained is through <strong>Environment Canada</strong>'s API. The <strong>Government of Canada and or Environment Canada is not a sponsor nor representitive of this project in any way shape or form.</strong> This project has been created strictly for educational purposes.

## 🗃️ Where are the main files with the code?
- Laravel uses the MVC (Model, View, Controller) architecture provideing an organized and modular framework for web application development.
  
- `app\Http\Controllers` folder you will find `CityController.php`  which contains the API backend functionality of this application.
  
- `resources\views` folder you will find `CityView.blade.php` which is the entire meat and bones of this project, containing the user interface and front-end components.

## 🌡️ Where did I get the weather information for my application?
Due to my natural curiosity, I wanted the same information on my application as the Environment Canada weather website because it would most likely be the best source for the correct 
weather information in Canada. 

Assuming the logic would be `"they probably have some API endpoint they send a request to which returns a json of weather information"`, my assumption was 
absolutely correct and I confirmed this by just opening developer tools in chrome, then going to the `Network` tab and refreshing the page while looking through the requests being made, and 
who would have guessed...

It was right there in front of my face with a simple <strong><u>plain text GET request</u></strong>!
![alt text](https://github.com/d3v0psdan/edmonton-weather/blob/main/Weather_Information.png)

## 🎉 Before vs After
![alt text](https://github.com/d3v0psdan/edmonton-weather/blob/main/OldWeather.jpg)
![alt text](https://github.com/d3v0psdan/edmonton-weather/blob/main/NewWeather.jpg)
