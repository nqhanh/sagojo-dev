<?php
/**
 * Description of Helper
 *
 * @author greg
 * @package 
 */

class Daq_Helper
{
    public static function registerAll()
    {
        self::registerHtml();
        self::registerDate();
    }

    public static function registerHtml()
    {
        if(!function_exists("daq_escape")) {
            function daq_escape($text)
            {
                return esc_html($text);
            }
        }
    }

    public static function registerDate()
    {
        if(function_exists("daq_distance_of_time_in_words") || function_exists("daq_time_ago_in_words")) {
            return;
        }

        /**
         * Ripped from symfony DateHelper
         * http://trac.symfony-project.org/browser/branches/1.0/lib/helper/DateHelper.php
         *
         * @param <type> $from_time
         * @param <type> $to_time
         * @param <type> $include_seconds
         * @return <type>
         */
        function daq_distance_of_time_in_words($from_time, $to_time = null, $include_seconds = false)
        {
          $to_time = $to_time? $to_time: time();

          $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
          $distance_in_seconds = floor(abs($to_time - $from_time));

          $string = '';
          $parameters = array();

          if ($distance_in_minutes <= 1)
          {
            if (!$include_seconds)
            {
              $string = $distance_in_minutes == 0 ? __('less than a minute', WPJB_DOMAIN) : __('1 minute', WPJB_DOMAIN);
            }
            else
            {
              if ($distance_in_seconds <= 5)
              {
                $string = __('less than 5 seconds', WPJB_DOMAIN);
              }
              else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
              {
                $string = __('less than 10 seconds', WPJB_DOMAIN);
              }
              else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
              {
                $string = __('less than 20 seconds', WPJB_DOMAIN);
              }
              else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
              {
                $string = __('half a minute', WPJB_DOMAIN);
              }
              else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
              {
                $string = __('less than a minute', WPJB_DOMAIN);
              }
              else
              {
                $string = __('1 minute', WPJB_DOMAIN);
              }
            }
          }
          else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
          {
            $string = __('%minutes% minutes', WPJB_DOMAIN);
            $parameters['%minutes%'] = $distance_in_minutes;
          }
          else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
          {
            $string = __('about 1 hour', WPJB_DOMAIN);
          }
          else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
          {
            $string = __('about %hours% hours', WPJB_DOMAIN);
            $parameters['%hours%'] = round($distance_in_minutes / 60);
          }
          else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
          {
            $string = __('1 day', WPJB_DOMAIN);
          }
          else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
          {
            $string = __('%days%x days', WPJB_DOMAIN);
            $parameters['%days%x'] = round($distance_in_minutes / 1440);
          }
          else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
          {
            $string = __('about 1 month', WPJB_DOMAIN);
          }
          else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
          {
            $string = __('%months% months', WPJB_DOMAIN);
            $parameters['%months%'] = round($distance_in_minutes / 43200);
          }
          else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
          {
            $string = __('about 1 year', WPJB_DOMAIN);
          }
          else
          {
            $string = __('over %years% years', WPJB_DOMAIN);
            $parameters['%years%'] = floor($distance_in_minutes / 525960);
          }

          return strtr($string, $parameters);
        }

        // Like distance_of_time_in_words, but where to_time is fixed to time()
        function daq_time_ago_in_words($from_time, $include_seconds = false)
        {
            return daq_distance_of_time_in_words($from_time, time(), $include_seconds);
        }

    }
}

?>