<?php
// Get current page's URL
$pageUrl = get_page_link(get_the_ID());

// Links for calendar years
$yearsLinks = array();

// Loop through list of years to display link for each year
foreach ($years as $yearDetails)
{
    $queryArguments = array('calendar_year' => $yearDetails->year);
    if ($category) : $queryArguments['category'] = $category; endif;
    $yearsLinks[] = '<a href="' . add_query_arg($queryArguments, $pageUrl) . '">' . $yearDetails->year . '</a>';
}

//TATE - determine which month and year to show

// Output links for calendar years
//printf(__('View calendar for year %s', 'calendar-archives'), implode(' ', $yearsLinks));

//TATE - get current month
if ($_REQUEST['calendar_month']) {
  $current_month = $_REQUEST['calendar_month'];
} else {
  $current_month = date('n');
}

if ($current_month == 12) {
  $next_calendar_month = 1;
} else {
  $next_calendar_month = $current_month+1;
}

if ($current_month == 1) {
  $prev_calendar_month = 12;
} else {
  $prev_calendar_month = $current_month-1;
}

if ($_REQUEST['calendar_year']) {
  $calendar_year = $_REQUEST['calendar_year'];
} else {
  $calendar_year = date('Y');
}

if ($current_month == 12) {
  $next_calendar_year = $calendar_year+1;
} else {
  $next_calendar_year = $calendar_year;
}

if ($current_month == 1) {
  $prev_calendar_year = $calendar_year-1;
} else {
  $prev_calendar_year = $calendar_year;
}

if ($_REQUEST['tate']) {
  //echo '<pre>';
  //var_dump($postsPerDay);
  //echo '</pre>';
}

?>

<div class="printcal">
  <a href="/ical-instructions/">Subscribe to iCal Calendar</a> | <a href="JavaScript:window.print()" class="printcalendar">Print Calendar</a>
</div>

<form name="calendarform" id="calendarform" action="/calendar" method="get">
  <select name="calendar_month" id="calendar_month">
    <option value="1"<?php if ($current_month == '1') { echo ' selected';}; if (1 < date('n')) { echo 'class="pastmonth"'; } ?>>January</option>
    <option value="2"<?php if ($current_month == '2') { echo ' selected';}; if (2 < date('n')) { echo 'class="pastmonth"'; } ?>>February</option>
    <option value="3"<?php if ($current_month == '3') { echo ' selected';}; if (3 < date('n')) { echo 'class="pastmonth"'; }  ?>>March</option>
    <option value="4"<?php if ($current_month == '4') { echo ' selected';}; if (4 < date('n')) { echo 'class="pastmonth"'; }  ?>>April</option>
    <option value="5"<?php if ($current_month == '5') { echo ' selected';}; if (5 < date('n')) { echo 'class="pastmonth"'; }  ?>>May</option>
    <option value="6"<?php if ($current_month == '6') { echo ' selected';}; if (6 < date('n')) { echo 'class="pastmonth"'; }  ?>>June</option>
    <option value="7"<?php if ($current_month == '7') { echo ' selected';}; if (7 < date('n')) { echo 'class="pastmonth"'; }  ?>>July</option>
    <option value="8"<?php if ($current_month == '8') { echo ' selected';}; if (8 < date('n')) { echo 'class="pastmonth"'; }  ?>>August</option>
    <option value="9"<?php if ($current_month == '9') { echo ' selected';}; if (9 < date('n')) { echo 'class="pastmonth"'; }  ?>>September</option>
    <option value="10"<?php if ($current_month == '10') { echo ' selected';}; if (10 < date('n')) { echo 'class="pastmonth"'; }  ?>>October</option>
    <option value="11"<?php if ($current_month == '11') { echo ' selected';}; if (11 < date('n')) { echo 'class="pastmonth"'; }  ?>>November</option>
    <option value="12"<?php if ($current_month == '12') { echo ' selected';} ?>>December</option>                
  </select>
  <select name="calendar_year" id="calendar_year">
      <?php
        $current_year = date('Y');
        $checked = null;
        for ($i = $current_year; $i <= $current_year+3; $i++) {
            if ($calendar_year == $i) {
              $checked = ' selected';
            } else {
              $checked = null;
            }
            echo '<option' . $checked . '>' . $i . '</option>';
        }
      ?>
  </select>
  <input type="submit" id="calgo" name="calgo" value="Go" />
</form>

<br class="clear" /><br class="clear" />
<?php
// First day of week to use
$firstDayOfWeek = (int)$options['first_day_of_week'];

// Setting flag 'hide no posts months'
$hideNoPostsMonths = (bool)$options['hide_no_posts_months'];

// Setting flag 'reverse months'
$reverseMonths = (bool)$options['reverse_months'];

// Weekdays
$weekdays = array
(
    __('Sunday', 'calendar-archives')
    , __('Monday', 'calendar-archives')
    , __('Tuesday', 'calendar-archives')
    , __('Wednesday', 'calendar-archives')
    , __('Thursday', 'calendar-archives')
    , __('Friday', 'calendar-archives')
    , __('Saturday', 'calendar-archives')
);

$showmonth = false;

// Loop through months to display calendar with posts
for ($month = ($reverseMonths ? 12 : 1); ($reverseMonths ? 0 < $month : 12 >= $month); ($reverseMonths ? $month-- : $month++))
{
    // If 'hide no posts months' setting flag is ON and there are no posts for current month in current year then move to next month
    if ($hideNoPostsMonths && !isset($postsPerDay[$month]))
    {
        continue;
    }

    // Time for first day of current month/year
    $timeForFirstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    if (date('n', $timeForFirstDayOfMonth) == $current_month) {
      $showmonth = ' style="display: block;"';
      $printmonth = ' printmonth';
    } else {
      $showmonth = false;
      $printmonth = false;
    }

?>

<div class="calendarmonthdiv<?php echo $printmonth; ?>" id="month_<?php echo strtolower(date('F', $timeForFirstDayOfMonth)); ?>"<?php echo $showmonth; ?>>

<div class="nextmonth">
  <a href="/calendar/?calendar_month=<?php echo $next_calendar_month; ?>&calendar_year=<?php echo $next_calendar_year; ?>">Next Month</a>
</div>
<div class="prevmonth">
  <a href="/calendar/?calendar_month=<?php echo $prev_calendar_month; ?>&calendar_year=<?php echo $prev_calendar_year; ?>">Previous Month</a>
</div>

<h1><?php echo date('F', $timeForFirstDayOfMonth); ?> <?php echo $year; ?></h1>



<ul class="weekdays">
<?php
    // Loop for seven times to output weekday names
    for ($counter = 0, $i = $firstDayOfWeek; 7 > $counter; $counter++, $i++)
    {
?>
    <li><?php echo $weekdays[$i]; ?></li>
<?php
        // If counter reached to 6, set it to -1
        if (6 == $i)
        {
            $i = -1;
        }
    }
?>
</ul><br class="clear" />
<ul class="calendar">
<?php
    // Total number of days in current month/year
    $totalDaysInMonth = date('t', $timeForFirstDayOfMonth);

    // Weekday for first day of current month/year
    $weekdayForFirstDayOfMonth = date('w', $timeForFirstDayOfMonth);

    // If 'first day of week' is not equal to weekday for first day of month then proceed further to output empty TDs
    if ($firstDayOfWeek != $weekdayForFirstDayOfMonth)
    {
        // Calculate total empty days
        $totalEmptyDays = ($weekdayForFirstDayOfMonth - $firstDayOfWeek);

        // If first day of week is greater than weekday for first day of month then add 7 days to total empty days
        if ($firstDayOfWeek > $weekdayForFirstDayOfMonth)
        {
            $totalEmptyDays += 7;
        }

        // Loop for 'total empty days' to output empty LIs if first day of current month/year doesn't start on 'first day of week'
        for ($i = 0; $i < $totalEmptyDays; $i++)
        {
?>
    <li class="empty">&nbsp;</li>
<?php
        }
    }

    // Loop for total number of days in current month/year to output calendar with posts
    for ($day = 1; $day <= $totalDaysInMonth; $day++)
    {
        // If new week started then close current UL and start new one
        if (1 < $day && $firstDayOfWeek == date('w', mktime(0, 0, 0, $month, $day, $year)))
        {
?>
</ul><br class="clear" />
<ul class="calendar">
<?php
        }

        // Initialize variable used to store background image
        $backgroundImage = false;

        // If background image set for current day in current month/year then use it
        if (isset($backgroundImages[$month][$day]) && false !== $backgroundImages[$month][$day])
        {
            $backgroundImage = $backgroundImages[$month][$day];
        }
?>
    <li class="day"<?php echo ($backgroundImage ? ' style="background-image: url(' . $this->getImageUrl($backgroundImage, $boxDimension) . ');"' : ''); ?>>
<?php
        // If background image set for current day in current month/year then display that day in black/white
        if ($backgroundImage)
        {
?>
        <div class="blackDay"><?php echo $day; ?></div>
        <div class="whiteDay"><?php echo $day; ?></div><br class="clear" />
<?php
        }
        // If background image is not set for current day in current month/year then display that day simply
        else
        {
            echo $day;
        }

        // If any post(s) for current day in current month/year then display it/them
        if (isset($postsPerDay[$month][$day]))
        {
?>
        <ul<?php echo ($backgroundImage ? ' class="invisible"' : ''); ?>>
<?php
            // Loop through post(s) for current day in current month/year to display it/them
            foreach ($postsPerDay[$month][$day] as $key => $index)
            {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $posts[$index]->ID ), 'single-post-thumbnail' );
?>

            <li>
              <a href="<?php echo get_permalink($posts[$index]->ID); ?>">
                <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&amp;h=40&amp;w=118px&amp;zc=1" alt="" />
              </a>            
              <a href="<?php echo get_permalink($posts[$index]->ID); ?>"><?php echo $posts[$index]->post_title; ?></a>
            </li>
<?php
            }
?>
        </ul>
<?php
        }
?>
    </li>
<?php
    }

    // Weekday for last day of current month/year
    $weekdayForLastDayOfMonth = date('w', mktime(0, 0, 0, $month, $totalDaysInMonth, $year));

    // Calculate total empty days
    $totalEmptyDays = ($firstDayOfWeek - $weekdayForLastDayOfMonth - 1);

    // If first day of week is less than or equals to weekday for last day of month then add 7 days to total empty days
    if ($firstDayOfWeek <= $weekdayForLastDayOfMonth)
    {
        $totalEmptyDays += 7;
    }

    // Loop for 'total empty days' to output empty TDs if last day of current month/year doesn't end on 'first day of week'
    for ($i = 0; $i < $totalEmptyDays; $i++)
    {
?>
    <li class="empty">&nbsp;</li>
<?php
    }
?>
</ul>
</div>
<?php
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
  hidePastMonths();
  
  jQuery("#calendar_year").change(function() {
      hidePastMonths();
    });
});

function hidePastMonths() {
   var cyear = jQuery("#calendar_year option:selected").val();
   if(cyear == '<?php echo date("Y") ?>') {
     jQuery(".pastmonth").attr("disabled","disabled");
   } else {
     jQuery(".pastmonth").attr("disabled","");   
   }
}
</script>
