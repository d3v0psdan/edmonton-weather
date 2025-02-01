<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="3600">

        <title>Edmonton Weather - Accurate & Real-Time Forecasts | Berg IT Solutions</title>

        <!-- SEO Description -->
        <meta name="description" content="Get accurate and up-to-date weather forecasts for Edmonton, Alberta. Check current weather, hourly forecast, 7-day forecast, and weather alerts on Berg IT Solutions.">
    
        <!-- Keywords for SEO -->
        <meta name="keywords" content="Edmonton weather, weather forecast Edmonton, Edmonton weather 7-day forecast, Edmonton temperature, weather in Edmonton, Edmonton weather today">
    
        <!-- Open Graph for Social Media Sharing -->
        <meta property="og:title" content="Edmonton Weather - Accurate & Real-Time Forecasts | Berg IT Solutions">
        <meta property="og:description" content="Get accurate and up-to-date weather forecasts for Edmonton, Alberta. Check current weather, hourly forecast, 7-day forecast, and weather alerts on Berg IT Solutions.">
        <meta property="og:image" content="{{ asset('img/bergit-banner.jpg') }}"> 
        <meta property="og:url" content="https://edmonton.weather.bergit.solutions">
        <meta property="og:type" content="website">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/bergit-logo.ico') }}" type="image/x-icon">
    
        <!-- Canonical URL (helps avoid duplicate content issues) -->
        <link rel="canonical" href="https://edmonton.weather.bergit.solutions">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="font-sans antialiased dark:bg-black dark:text-white/50 bg-scroll-black m-10">    
        <div class="bg-[#151515] w-full m-auto p-8 mt-8 text-center rounded-md flex flex-col justify-center">
            <div class="flex flex-col m-4 w-full">
                <h1 class="text-white font-bold text-2xl">
                    <a href="{{ route('CityView') }}" class="hover:text-green-500">{{ $cityData->displayName }} , {{ $cityData->province }}</a>
                </h1>    
                <p id="numericTime_id" class="text-green-500 tracking-[5px] animate-pulse">
                    {{ $numericTime }}
                </p>
                <p id="stringTime_id" class="tracking-[2.5px]">
                    {{ $stringTime }}
                </p>          
            </div>
        
            <div class="bg-transparent display-grid grid-cols-3 h-full rounded-lg text-center justify-center">
                <p class="text-yellow font-bold underline pt-2 text-left">
                    Observation record:
                </p>
        
                <p class="text-xs text-left">
                    {{ $cityData->observation->observedAt }}
                    <br>
                    {{ $cityData->observation->timeStampText }}
                    <br>
                    Website automatically refreshes hourly.
                </p>

            </div>
        </div>

        <div class="bg-[#151515] w-full h-[20%] m-auto p-4 mt-4 text-center justify-center rounded-md">
            <table class="w-full h-auto">
                <thead>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @php
                        $lastDate = null;
                    @endphp
                    @foreach ($cityData->dailyFcst->daily as $day)
                        @if ($day->date != $lastDate)
                            @php
                                // Determine if the date is today or tomorrow
                                $dateLabel = $day->date;
                                $isToday = ($cityController->isToday($day->date));
                                $isTomorrow = ($cityController->isTomorrow($day->date));

                                if ($isToday) 
                                    $dateLabel .= ' ~ Today ';        
                                if ($isTomorrow)
                                    $dateLabel .= ' ~ Tomorrow ';  
                            @endphp
                
                            <tr>
                                <th scope="row" class="p-6">
                         
                                    <p class="text-left {{ 
                                        $isToday ? 'text-white underline' : 
                                            ($isTomorrow ? 'text-white opacity-75 underline' : 'text-white opacity-55') }}">
                                        {{ $dateLabel }}
                                    </p>
                                   
                                    <p class="text-left text-sm"> {{ $day->text }}</p>
                                    <div class="w-full h-[2px] bg-[#333333]"></div>
                                </th>
                
                                <th scope="row">
                                    <img src="https://weather.gc.ca/weathericons/{{ $day->iconCode }}.gif" alt="Weather Icon" width="50" height="41">
                                    @if ($day->temperature->metric[0] === '-')
                                        <p class="text-red-500">{{ $day->temperature->metric }}&deg;C</p>
                                    @else
                                        <p class="text-green-500">{{ $day->temperature->metric }}&deg;C</p>
                                    @endif
                                </th>
                            </tr>
                
                            @php
                                $lastDate = $day->date;
                            @endphp
                        @endif
                    @endforeach
                </tbody>        
            </table>
        </div>

        <div class="bg-[#151515] w-full h-[20%] m-auto p-4 mt-4 rounded-md">
            <div class="bg-transparent flex w-full h-full justify-center items-center">
                <!-- First Logo (Berg IT Solutions) -->
                <div class="flex justify-center items-center w-[40%] h-full">
                    <a target="_blank" href="https://bergit.solutions" class="flex justify-center items-center w-full h-full">
                        <img class="bg-transparent w-[70%] h-[auto]" alt="Berg IT Solutions Logo" 
                        src="{{ asset('img/bergit-logo.svg') }}">
                    </a>
                </div>
        
                <!-- Second Logo (Government of Canada) -->
                <div class="flex justify-center items-center w-[40%] h-full">
                    <a target="_blank" href="https://weather.gc.ca/" class="flex justify-center items-center w-full h-full">
                        <img class="w-[70%] h-[auto]" alt="Government of Canada Logo" 
                        src="{{ asset('img/government-of-canada-logo.png') }}">
                        <!-- 
                            NOT SPONSORED BY THE Canadian Government.
                            Giving credits to the Canadian Government for accessing their backend weather API.
                        -->
                    </a>
                    
                </div>

                <p class="text-xs w-[35%]">
                    This website is <strong><u class="text-yellow-200 opacity-70">not affiliated with or endorsed by the Canadian Government.</u></strong> 
                    The Canadian Government logo is used for attribution due to the use of their weather API 
                    for displaying weather data for Edmonton, Alberta.
                </p>
                
            </div>
        </div>
    </body>

    <script>
        function updateTime() {
            const numericTimeElement = document.getElementById("numericTime_id");
            const stringTimeElement = document.getElementById("stringTime_id");

            const now = new Date();
            const numericTime = now.toLocaleTimeString();

            const options = { timeZone: 'America/Edmonton', weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const stringTime = now.toLocaleString('en-US', options);

            // Update the time in the HTML elements
            numericTimeElement.textContent = numericTime;
            stringTimeElement.textContent = stringTime;
        }

        // Update timing every second
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</html>
