<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Citco\Carbon;

class CityController extends Controller
{
    public $jsonData;

    public $carbon;
    public $numericTime;
    public $stringTime;
    public $groupedForecastSummary;

    private function jsonData()
    {
        $data = file_get_contents('https://weather.gc.ca/api/app/en/Location/53.536,-113.494?type=city');
        if (empty($data))
            return null;

        $data = json_decode($data);
        if (json_last_error() != JSON_ERROR_NONE)
            return null;

        return $data[0];
    }

    public function isToday($date)
    {
        $formatted = $this->carbon->format('D, d M');
        return $date === $formatted;
    }

    public function isTomorrow($date)
    {
        $formatted = $this->carbon->addDay()->format('D, d M');
        $result = ($date === $formatted);
        
        $this->carbon->subDay(); // Undo what we added to our carbon time
        return $result;
    }

    public function index()
    {
        $this->jsonData = self::jsonData();

        $this->carbon = Carbon::now()->setTimezone('America/Edmonton');
        $this->numericTime = $this->carbon->format('g:ia'); // 10:00pm 
        $this->stringTime = $this->carbon->format('F j Y'); // January 28 2025

        return view('CityView', [
            'cityController' => $this,
            'cityData' => $this->jsonData,
            'numericTime' => $this->numericTime,
            'stringTime' => $this->stringTime
        ]);
    }
}
