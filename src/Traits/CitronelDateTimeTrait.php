<?php

namespace aliirfaan\CitronelCore\Traits;

trait CitronelDateTimeTrait
{
    public function getCitronelDateDisplayFormat()
    {
        return config('citronel.date_display_format');
    }

    public function getCitronelDateTimeDisplayFormat()
    {
        return config('citronel.date_time_display_format');
    }

    public function getCitronelDbDateFormat()
    {
        return config('citronel.db_date_format');
    }

    public function getCitronelDbDateTimeFormat()
    {
        return config('citronel.db_date_time_db_format');
    }

    public function getCitronelDisplayTimezone()
    {
        return config('citronel.display_timezone');
    }
    
    /**
     * Method convertTimezone
     *
     * @param string $date [explicite description]
     * @param string $inputDateTz [explicite description]
     * @param string $outputDateTz [explicite description]
     * @param string $inputDateFormat [explicite description]
     * @param string $outputDateFormat [explicite description]
     *
     * @return string
     */
    public function convertTimezone($date, $inputDateTz = 'UTC', $outputDateTz = null, $inputDateFormat = null, $outputDateFormat = null)
    {
        $inputDateTz = $inputDateTz ?? 'UTC';
        $outputDateTz = $outputDateTz ?? $this->getCitronelDisplayTimezone();
        $inputDateFormat = $inputDateFormat ?? $this->getCitronelDateTimeDisplayFormat();
        $outputDateFormat = $outputDateFormat ?? $this->getCitronelDateTimeDisplayFormat();
    
        $dateObj = \DateTime::createFromFormat($inputDateFormat, $date, new \DateTimeZone($inputDateTz));
        $targetTimeZone = new \DateTimeZone($outputDateTz);
        $dateObj->setTimezone($targetTimeZone);
    
        return $dateObj->format($outputDateFormat);
    }
    
    /**
     * Method convertToAppTimezone
     *
     * @param string $date [explicite description]
     * @param string $inputDateTz [explicite description]
     * @param string $inputDateFormat [explicite description]
     * @param string $outputDateFormat [explicite description]
     *
     * @return string
     */
    public function convertToAppTimezone($date, $inputDateTz = null, $inputDateFormat = null, $outputDateFormat = null)
    {
        $inputDateTz = $inputDateTz ?? $this->getCitronelDisplayTimezone();
        $outputDateTz = config('app.timezone');

        $inputDateFormat = $inputDateFormat ?? $this->getCitronelDateTimeDisplayFormat();

        $outputDateFormat = $outputDateFormat ?? $this->getCitronelDbDateTimeFormat();

        return $this->convertTimezone($date, $inputDateTz, $outputDateTz, $inputDateFormat, $outputDateFormat);
    }
    
    /**
     * Method convertToDisplayTimezone
     *
     * @param string $date [explicite description]
     * @param string $inputDateTz [explicite description]
     * @param string $inputDateFormat [explicite description]
     * @param string $outputDateFormat [explicite description]
     *
     * @return string
     */
    public function convertToDisplayTimezone($date, $inputDateTz = null, $inputDateFormat = null, $outputDateFormat = null)
    {
        $inputDateTz = $inputDateTz ?? config('app.timezone');
        $outputDateTz = $this->getCitronelDisplayTimezone();

        $inputDateFormat = $inputDateFormat ?? $this->getCitronelDbDateTimeFormat();

        $outputDateFormat = $outputDateFormat ?? $this->getCitronelDateTimeDisplayFormat();

        return $this->convertTimezone($date, $inputDateTz, $outputDateTz, $inputDateFormat, $outputDateFormat);
    }

    /**
     * formatValidDate
     *
     * Converts a valid date from one format to another
     * @param  string $dateStr
     * @param  string $inputDateFormat
     * @param  string $outputDateFormat
     * @return null|string
     */
    public function formatValidDate($date, $inputDateFormat = null, $outputDateFormat = null)
    {
        $inputDateFormat = $inputDateFormat ?? $this->getCitronelDbDateFormat();

        $outputDateFormat = $outputDateFormat ?? $this->getCitronelDateDisplayFormat();

        $dateObj = \DateTime::createFromFormat($inputDateFormat, $date);

        return $dateObj->format($outputDateFormat);
    }
}
